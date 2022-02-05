<?php

namespace osslibs\HTTP\Curl;

use osslibs\Curl\Curl;
use osslibs\Curl\CurlFacade;

interface CurlFactory
{
    public function makeCurl(): Curl;
}
