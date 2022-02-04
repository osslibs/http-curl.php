<?php

namespace osslibs\HTTP\Curl;

use osslibs\Curl\Curl;
use osslibs\Curl\CurlFacade;

interface CurlFacadeFactory
{
    public function makeCurlFacade(?Curl $curl = null): CurlFacade;
}
