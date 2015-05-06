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
 * @copyright   Copyright (c) 2009-2015 Uni Alteri (http://agence.net.ua)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 *
 * @link        http://teknoo.it/curl Project website
 *
 * @license     http://teknoo.it/curl/license/mit         MIT License
 * @license     http://teknoo.it/curl/license/gpl-3.0     GPL v3 License
 * @author      Richard Déloge <r.deloge@uni-alteri.com>
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 *
 * @version     0.8.1
 */

namespace UniAlteri\Tests\Curl;

use UniAlteri\Curl\Options;

/**
 * Class OptionsTest.
 *
 * @copyright   Copyright (c) 2009-2015 Uni Alteri (http://agence.net.ua)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 *
 * @link        http://teknoo.it/curl Project website
 *
 * @license     http://teknoo.it/curl/license/mit         MIT License
 * @license     http://teknoo.it/curl/license/gpl-3.0     GPL v3 License
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 */
class CurlOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var resource cUrl
     */
    protected $handle;

    protected function setUp()
    {
        parent::setUp();
        $this->handle = curl_init();
    }

    protected function tearDown()
    {
        parent::tearDown();
        curl_close($this->handle);
    }

    protected function buildOptions()
    {
        return new Options();
    }

    public function testIsValidOption()
    {
        $this->assertTrue($this->buildOptions()->isValidOption(CURLOPT_RETURNTRANSFER));
        $this->assertFalse($this->buildOptions()->isValidOption('herp derpity'));
    }

    /**
     * @dataProvider badOptions
     * @expectedException \InvalidArgumentException
     */
    public function testCheckOptionValueInvalidOptions($option, $value)
    {
        $this->buildOptions()->checkOptionValue($option, $value);
    }

    /**
     * @dataProvider badOptionsName
     * @expectedException \InvalidArgumentException
     */
    public function testCheckOptionValueInvalidOptionsBadName($option, $value)
    {
        $this->buildOptions()->checkOptionValue($option, $value);
    }

    /**
     * @dataProvider badOptions
     */
    public function testCheckOptionValueInvalidOptionsNotThrows($option, $value)
    {
        $this->assertFalse($this->buildOptions()->checkOptionValue($option, $value, false));
    }

    /**
     * @dataProvider goodOptions
     */
    public function testCheckOptionValueValidOptionsValue($option, $value)
    {
        $this->assertTrue($this->buildOptions()->checkOptionValue($option, $value));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetOptionValueBadOptionValue()
    {
        $this->buildOptions()->setOptionValue($this->handle, CURLOPT_AUTOREFERER, 'bar');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetOptionValueBadOptionName()
    {
        $this->buildOptions()->setOptionValue($this->handle, 'foo', 'bar');
    }

    public function testSetOptionValueGood()
    {
        $this->assertTrue($this->buildOptions()->setOptionValue($this->handle, CURLOPT_AUTOREFERER, true));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetOptionsValuesArrayBadOptionValue()
    {
        $this->buildOptions()->setOptionsValuesArray($this->handle, $this->badOptions());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetOptionsValuesArrayBadOptionName()
    {
        $this->buildOptions()->setOptionsValuesArray($this->handle, $this->badOptionsName());
    }

    public function testSetOptionsValuesArrayGood()
    {
        $this->assertTrue(
            $this->buildOptions()->setOptionsValuesArray(
                $this->handle,
                array(
                    CURLOPT_AUTOREFERER => true,
                    CURLOPT_BUFFERSIZE => 10,
                    CURLOPT_CAINFO => 'a string',
                    CURLOPT_HTTP200ALIASES => array(200, 404, 401),
                    CURLOPT_POSTFIELDS => array('key' => 'value'),
                    CURLOPT_POSTFIELDS => 'key=value',
                )
            )
        );
    }

    /**
     * Data provider for testValidOptions.
     *
     * @return array
     */
    public function goodOptions()
    {
        return array(
            array(CURLOPT_AUTOREFERER,true),
            array(CURLOPT_BUFFERSIZE,10),
            array(CURLOPT_CAINFO,'a string'),
            array(CURLOPT_HTTP200ALIASES,array(200,404,401)),
            array(CURLOPT_POSTFIELDS,array('key' => 'value')),
            array(CURLOPT_POSTFIELDS,'key=value'),
        );
    }

    /**
     * Data provider for testInvalidOptions.
     *
     * @return array
     */
    public function badOptions()
    {
        return array(
            array(CURLOPT_AUTOREFERER,'derp'),
            array(CURLOPT_BUFFERSIZE,'derp'),
            array(CURLOPT_CAINFO,false),
            array(CURLOPT_HTTP200ALIASES,''),
            array(CURLOPT_HTTP200ALIASES,new \stdClass()),
        );
    }

    /**
     * Data provider for testInvalidOptions.
     *
     * @return array
     */
    public function badOptionsName()
    {
        return array(
            array('Bad','derp'),
            array(CURLOPT_BUFFERSIZE,'derp'),
            array(CURLOPT_CAINFO,false),
            array(CURLOPT_HTTP200ALIASES,''),
        );
    }
}
