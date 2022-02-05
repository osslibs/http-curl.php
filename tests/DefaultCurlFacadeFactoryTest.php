<?php

namespace osslibs\HTTP;

use Mockery;
use osslibs\Curl\CurlFacade;
use osslibs\Curl\CurlResponse;
use osslibs\HTTP\Curl\CurlFactory;
use osslibs\HTTP\Curl\CurlHttpClient;
use osslibs\HTTP\Curl\HttpCurlFactory;
use PHPUnit\Framework\TestCase;

class DefaultCurlFacadeFactoryTest extends TestCase
{
    public function testMakeCurlClient() {
        $factory = new HttpCurlFactory();
        $this->assertInstanceOf(CurlFacade::class, $factory->makeCurl());
    }
}