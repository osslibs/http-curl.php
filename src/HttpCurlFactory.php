<?php

namespace osslibs\HTTP\Curl;

use osslibs\Curl\Curl;
use osslibs\Curl\CurlFacade;

class HttpCurlFactory implements CurlFactory
{
    /**
     * @var Curl|null
     */
    private $curl;

    public function __construct(?Curl $curl = null)
    {
        $this->curl = $curl;
    }

    public function makeCurl(): Curl
    {
        return $this->curl ?? new CurlFacade();
    }
}
