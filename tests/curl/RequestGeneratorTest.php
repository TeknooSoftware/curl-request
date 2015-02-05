<?php

/*
 * (c) Darrell Hamilton <darrell.noice@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UniAlteri\Tests\Curl;

use UniAlteri\Curl\Request;
use UniAlteri\Curl\RequestGenerator;

class RequestGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testSetAndUnsetOptions() {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $request = new Request();
        $generator = new RequestGenerator($request);

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $this->assertNotEquals(
            $request,
            $generator->getRequest()
        );
    }
}