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
use UniAlteri\Curl\RequestGenerator;

/**
 * Class RequestGeneratorTest
 *
 * @package     CurlRequest
 * @copyright   Copyright (c) 2009-2015 Uni Alteri (http://agence.net.ua)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 * @link        http://teknoo.it/curl Project website
 * @license     http://teknoo.it/curl/license/mit         MIT License
 * @license     http://teknoo.it/curl/license/gpl-3.0     GPL v3 License
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 */
class RequestGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \LogicException
     */
    public function testConstructBadObject()
    {
        $options = $this->getMock('UniAlteri\Curl\Options');
        new RequestGenerator($options, new \stdClass());
    }

    /**
     * @expectedException \LogicException
     */
    public function testConstructBadType()
    {
        $options = $this->getMock('UniAlteri\Curl\Options');
        new RequestGenerator($options, false);
    }

    public function testGetRequest()
    {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('UniAlteri\Curl\Options');

        $generator = new RequestGenerator($options);

        $request1 = $generator->getRequest();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $request1
        );

        $this->assertNotEquals(
            $request1,
            $generator->getRequest()
        );
    }

    public function testGetRequestNoOption()
    {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $generator = new RequestGenerator();

        $request1 = $generator->getRequest();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $request1
        );

        $this->assertNotEquals(
            $request1,
            $generator->getRequest()
        );
    }

    public function testGetRequestWithArgs()
    {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('UniAlteri\Curl\Options');

        $counter = 0;
        $options->expects($this->exactly(2))
            ->method('setOptionValue')
            ->willReturnCallback(
                function ($resource, $name, $value) use (&$counter) {
                    $this->assertNotEmpty($resource);
                    if (0 == $counter++) {
                        $this->assertEquals(CURLOPT_RETURNTRANSFER, $name);
                        $this->assertTrue($value);
                    } else {
                        $this->assertEquals(CURLOPT_URL, $name);
                        $this->assertEquals('http://teknoo.it', $value);
                    }
                }
            );

        $generator = new RequestGenerator($options, 'http://teknoo.it');

        $request1 = $generator->getRequest();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $request1
        );

        $this->assertNotEquals(
            $request1,
            $generator->getRequest()
        );
    }

    public function testGetRequestGenerated()
    {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('UniAlteri\Curl\Options');

        $request = new Request($options);
        $generator = new RequestGenerator($options, $request);

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $this->assertNotEquals(
            $request,
            $generator->getRequest()
        );
    }

    public function testSetRequest()
    {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('UniAlteri\Curl\Options');

        $request = new Request($options);
        $generator = new RequestGenerator($options, $request);

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $request2 = new Request($options);
        $generator->setRequest($request2);

        $this->assertNotEquals(
            $request2,
            $generator->getRequest()
        );
    }

    public function testGetOptionsNotDefined()
    {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $generator = new RequestGenerator();
        $this->assertInstanceOf('UniAlteri\Curl\Options', $generator->getOptions());
    }

    public function testGetOptions()
    {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('UniAlteri\Curl\Options');

        $generator = new RequestGenerator($options);
        $this->assertSame($options, $generator->getOptions());
    }

    public function testSetOptions()
    {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'UniAlteri\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('UniAlteri\Curl\Options');

        $generator = new RequestGenerator($options);
        $this->assertSame($options, $generator->getOptions());

        $options2 = $this->getMock('UniAlteri\Curl\Options');
        $generator->setOptions($options2);
        $this->assertSame($options2, $generator->getOptions());
    }
}
