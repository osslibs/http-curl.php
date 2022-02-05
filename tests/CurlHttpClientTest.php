<?php

namespace osslibs\HTTP;

use Mockery;
use osslibs\Curl\CurlFacade;
use osslibs\Curl\CurlResponse;
use osslibs\HTTP\Curl\CurlFactory;
use osslibs\HTTP\Curl\CurlHttpClient;
use PHPUnit\Framework\TestCase;

class CurlHttpClientTest extends TestCase
{
    protected function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    public function dataSend()
    {
        return [
            "GET" => [
                new HttpRequest("GET", "http://someurl/somepath", ['a' => 'A'], null),
                new CurlResponse(200, [['b', 'B']], "response data"),
                new HttpResponse(200, ['b' => 'B'], "response data"),
            ],
            "POST" => [
                new HttpRequest("POST", "http://someurl/somepath", ['a' => 'A'], "some data"),
                new CurlResponse(200, [['b', 'B']], "response data"),
                new HttpResponse(200, ['b' => 'B'], "response data"),
            ],
            "PUT" => [
                new HttpRequest("PUT", "http://someurl/somepath", ['a' => 'A'], "some data"),
                new CurlResponse(200, [['b', 'B']], "response data"),
                new HttpResponse(200, ['b' => 'B'], "response data"),
            ],
            "DELETE" => [
                new HttpRequest("DELETE", "http://someurl/somepath", ['a' => 'A'], null),
                new CurlResponse(200, [['b', 'B']], "response data"),
                new HttpResponse(200, ['b' => 'B'], "response data"),
            ],
        ];
    }

    /**
     * @dataProvider dataSend
     * @param HttpRequest $httpRequest
     * @param CurlResponse $curlResponse
     * @param HttpResponse $expect
     * @throws ConnectionException
     */
    public function testSend(HttpRequest $httpRequest, CurlResponse $curlResponse, HttpResponse $expect)
    {
        $curl = Mockery::mock(CurlFacade::class);
        $curl->shouldReceive('method')->once()->with($httpRequest->method());
        $curl->shouldReceive('uri')->once()->with($httpRequest->uri());
        $curl->shouldReceive('headersAssoc')->once()->with($httpRequest->headers());
        $curl->shouldReceive('data')->once()->with($httpRequest->data());
        $curl->shouldReceive('execute')->once()->andReturn($curlResponse);

        $factory = Mockery::mock(CurlFactory::class);
        $factory->shouldReceive('makeCurl')->once()->andReturn($curl);

        $client = new CurlHttpClient($factory);
        $httpResponse = $client->send($httpRequest);

        $this->assertSame($expect->status(), $httpResponse->status());
        $this->assertSame($expect->headers(), $httpResponse->headers());
        $this->assertSame($expect->data(), $httpResponse->data());
    }
}