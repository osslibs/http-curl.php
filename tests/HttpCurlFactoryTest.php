<?php

namespace osslibs\HTTP;

use Mockery;
use osslibs\Curl\Curl;
use osslibs\Curl\CurlFacade;
use osslibs\Curl\CurlResponse;
use osslibs\HTTP\Curl\CurlFactory;
use osslibs\HTTP\Curl\CurlHttpClient;
use osslibs\HTTP\Curl\HttpCurlFactory;
use PHPUnit\Framework\TestCase;

class HttpCurlFactoryTest extends TestCase
{
    public function testMakeCurlGenerator()
    {
        $factory = new HttpCurlFactory();
        $this->assertInstanceOf(CurlFacade::class, $factory->makeCurl());
        $this->assertNotSame($factory->makeCurl(), $factory->makeCurl());
    }

    public function testMakeCurlInject()
    {
        $curl = Mockery::mock(Curl::class);
        $factory = new HttpCurlFactory($curl);
        $this->assertSame($curl, $factory->makeCurl());
        $this->assertSame($factory->makeCurl(), $factory->makeCurl());
    }
}