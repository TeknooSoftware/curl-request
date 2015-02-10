<?php
/**
 * Curl Request
 *
 * LICENSE
 *
 * This source file is subject to the MIT license and the version 3 of the GPL3
 * license that are bundled with this package in the folder licences
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@uni-alteri.com so we can send you a copy immediately.
 *
 * @subpackage  Tests
 * @copyright   Copyright (c) 2009-2015 Uni Alteri (http://agence.net.ua)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 * @link        http://teknoo.it/curl Project website
 * @license     http://teknoo.it/curl/license/mit         MIT License
 * @license     http://teknoo.it/curl/license/gpl-3.0     GPL v3 License
 * @author      Richard Déloge <r.deloge@uni-alteri.com>
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 * @version     0.8.0
 */

namespace UniAlteri\Tests\Curl;

use UniAlteri\Curl\Request;

/**
 * Class RequestTest
 *
 * @package     CurlRequest
 * @copyright   Copyright (c) 2009-2015 Uni Alteri (http://agence.net.ua)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 * @link        http://teknoo.it/curl Project website
 * @license     http://teknoo.it/curl/license/mit         MIT License
 * @license     http://teknoo.it/curl/license/gpl-3.0     GPL v3 License
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInfoAll()
    {
        $options = $this->getMock('UniAlteri\Curl\Options');
        $request = new Request($options);
        $this->assertTrue(is_array($request->getInfo()));
    }

    public function testGetInfoFlag()
    {
        $options = $this->getMock('UniAlteri\Curl\Options');
        $request = new Request($options);
        $this->assertTrue(is_int($request->getInfo(CURLINFO_REDIRECT_COUNT)));
    }

    public function testSetMethodGet()
    {
        $options = $this->getMock('UniAlteri\Curl\Options');
        $request = new Request($options);

        $options->expects($this->once())
            ->method('setOptionValue')
            ->with(
                $this->equalTo($request->getHandle()),
                $this->equalTo(CURLOPT_HTTPGET),
                $this->equalTo(true)
            );

        $request->setMethod('GET');
    }

    public function testSetMethodHead()
    {
        $options = $this->getMock('UniAlteri\Curl\Options');
        $request = new Request($options);

        $options->expects($this->once())
            ->method('setOptionValue')
            ->with(
                $this->equalTo($request->getHandle()),
                $this->equalTo(CURLOPT_NOBODY),
                $this->equalTo(true)
            );

        $request->setMethod('HEAD');
    }

    public function testSetMethodPost()
    {
        $options = $this->getMock('UniAlteri\Curl\Options');
        $request = new Request($options);

        $options->expects($this->once())
            ->method('setOptionValue')
            ->with(
                $this->equalTo($request->getHandle()),
                $this->equalTo(CURLOPT_POST),
                $this->equalTo(true)
            );

        $request->setMethod('POST');
    }

    public function testSetMethodPut()
    {
        $options = $this->getMock('UniAlteri\Curl\Options');
        $request = new Request($options);

        $options->expects($this->once())
            ->method('setOptionValue')
            ->with(
                $this->equalTo($request->getHandle()),
                $this->equalTo(CURLOPT_PUT),
                $this->equalTo(true)
            );

        $request->setMethod('PUT');
    }

    public function testSetMethodCustom()
    {
        $options = $this->getMock('UniAlteri\Curl\Options');
        $request = new Request($options);

        $options->expects($this->once())
            ->method('setOptionValue')
            ->with(
                $this->equalTo($request->getHandle()),
                $this->equalTo(CURLOPT_CUSTOMREQUEST),
                $this->equalTo('fooBar')
            );

        $request->setMethod('fooBar');
    }

    public function testClone()
    {
        $options = $this->getMock('UniAlteri\Curl\Options');

        $request = new Request($options);
        $clone = clone $request;

        $this->assertThat(
            $request->getHandle(),
            $this->logicalNot(
                $this->equalTo($clone->getHandle())
            )
        );
    }
}

