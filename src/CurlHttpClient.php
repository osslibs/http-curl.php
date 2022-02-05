<?php

namespace osslibs\HTTP\Curl;

use osslibs\Curl\Curl;
use osslibs\Curl\CurlFacade;
use osslibs\HTTP\ConnectionException;
use osslibs\HTTP\HttpClient;
use osslibs\HTTP\HttpException;
use osslibs\HTTP\HttpRequest;
use osslibs\HTTP\HttpResponse;

class CurlHttpClient implements HttpClient
{
    /**
     * @var CurlFactory
     */
    private $factory;

    public function __construct(?CurlFactory $factory=null)
    {
        $this->factory = $factory ?? new HttpCurlFactory();
    }

    /**
     * @param HttpRequest $request
     * @return HttpResponse
     * @throws ConnectionException
     */
    public function send(HttpRequest $request): HttpResponse
    {
        try {
            $curl = $this->factory->makeCurl();
            $curl->method($request->method());
            $curl->uri($request->uri());
            $curl->headersAssoc($request->headers());
            $curl->data($request->data());
            $response = $curl->execute();
            return new HttpResponse($response->status(), $response->headersAssoc(), $response->data());
        } catch (CurlException $exception) {
            throw new ConnectionException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
