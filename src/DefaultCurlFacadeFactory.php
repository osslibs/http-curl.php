<?php

namespace osslibs\HTTP\Curl;

use osslibs\Curl\Curl;
use osslibs\Curl\CurlFacade;

class DefaultCurlFacadeFactory implements CurlFacadeFactory
{
    public function makeCurlFacade(?Curl $curl = null): CurlFacade
    {
        return new CurlFacade($curl);
    }
}
