<?php

/**
 * Curl Request.
 *
 * LICENSE
 *
 * This source file is subject to the MIT license and the version 3 of the GPL3
 * license that are bundled with this package in the folder licences
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@uni-alteri.com so we can send you a copy immediately.
 *
 *
 * @copyright   Copyright (c) 2009-2016 Richard Déloge (richarddeloge@gmail.com)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 *
 * @link        http://teknoo.software/curl Project website
 *
 * @license     http://teknoo.software/curl/license/mit         MIT License
 * @license     http://teknoo.software/curl/license/gpl-3.0     GPL v3 License
 * @author      Richard Déloge <richarddeloge@gmail.com>
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 *
 * @version     0.8.1
 */

namespace Teknoo\tests\Curl;

use Teknoo\Curl\Request;
use Teknoo\Curl\RequestGenerator;

/**
 * Class RequestGeneratorTest.
 *
 *
 * @copyright   Copyright (c) 2009-2016 Richard Déloge (richarddeloge@gmail.com)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 *
 * @link        http://teknoo.software/curl Project website
 *
 * @license     http://teknoo.software/curl/license/mit         MIT License
 * @license     http://teknoo.software/curl/license/gpl-3.0     GPL v3 License
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 */
class RequestGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \LogicException
     */
    public function testConstructBadObject()
    {
        $options = $this->getMock('Teknoo\Curl\Options');
        new RequestGenerator($options, new \stdClass());
    }

    /**
     * @expectedException \LogicException
     */
    public function testConstructBadType()
    {
        $options = $this->getMock('Teknoo\Curl\Options');
        new RequestGenerator($options, false);
    }

    public function testGetRequest()
    {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'Teknoo\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('Teknoo\Curl\Options');

        $generator = new RequestGenerator($options);

        $request1 = $generator->getRequest();

        $this->assertInstanceOf(
            'Teknoo\Curl\Request',
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
            'Teknoo\Curl\Request',
            $generator->getRequest()
        );

        $generator = new RequestGenerator();

        $request1 = $generator->getRequest();

        $this->assertInstanceOf(
            'Teknoo\Curl\Request',
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
            'Teknoo\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('Teknoo\Curl\Options');

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
                        $this->assertEquals('http://teknoo.software', $value);
                    }
                }
            );

        $generator = new RequestGenerator($options, 'http://teknoo.software');

        $request1 = $generator->getRequest();

        $this->assertInstanceOf(
            'Teknoo\Curl\Request',
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
            'Teknoo\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('Teknoo\Curl\Options');

        $request = new Request($options);
        $generator = new RequestGenerator($options, $request);

        $this->assertInstanceOf(
            'Teknoo\Curl\Request',
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
            'Teknoo\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('Teknoo\Curl\Options');

        $request = new Request($options);
        $generator = new RequestGenerator($options, $request);

        $this->assertInstanceOf(
            'Teknoo\Curl\Request',
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
            'Teknoo\Curl\Request',
            $generator->getRequest()
        );

        $generator = new RequestGenerator();
        $this->assertInstanceOf('Teknoo\Curl\Options', $generator->getOptions());
    }

    public function testGetOptions()
    {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'Teknoo\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('Teknoo\Curl\Options');

        $generator = new RequestGenerator($options);
        $this->assertSame($options, $generator->getOptions());
    }

    public function testSetOptions()
    {
        $generator = new RequestGenerator();

        $this->assertInstanceOf(
            'Teknoo\Curl\Request',
            $generator->getRequest()
        );

        $options = $this->getMock('Teknoo\Curl\Options');

        $generator = new RequestGenerator($options);
        $this->assertSame($options, $generator->getOptions());

        $options2 = $this->getMock('Teknoo\Curl\Options');
        $generator->setOptions($options2);
        $this->assertSame($options2, $generator->getOptions());
    }
}
