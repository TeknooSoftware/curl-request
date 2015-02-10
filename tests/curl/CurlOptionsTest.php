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

use UniAlteri\Curl\Options;

/**
 * Class OptionsTest
 *
 * @package     CurlRequest
 * @copyright   Copyright (c) 2009-2015 Uni Alteri (http://agence.net.ua)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 * @link        http://teknoo.it/curl Project website
 * @license     http://teknoo.it/curl/license/mit         MIT License
 * @license     http://teknoo.it/curl/license/gpl-3.0     GPL v3 License
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 */
class OptionsTest extends \PHPUnit_Framework_TestCase
{
    public function testIsValidOption() {
        $this->assertTrue(Options::isValidOption(CURLOPT_RETURNTRANSFER));
        $this->assertFalse(Options::isValidOption("herp derpity"));
    }

    /**
     * @dataProvider badOptions
     * @expectedException InvalidArgumentException
     */
    public function testInvalidOptions($option, $value) {
        Options::checkOptionValue($option, $value);
    }

    /**
     * @dataProvider goodOptions
     */
    public function testValidOptions($option, $value) {
        $this->assertTrue(Options::checkOptionValue($option,$value));
    }

    public function goodOptions() {
        return array(
            array(CURLOPT_AUTOREFERER,true),
            array(CURLOPT_BUFFERSIZE,10),
            array(CURLOPT_CAINFO,"a string"),
            array(CURLOPT_HTTP200ALIASES,array(200,404,401)),
            array(CURLOPT_POSTFIELDS,array("key"=>"value")),
            array(CURLOPT_POSTFIELDS,"key=value")
        );
    }

    public function badOptions() {
        return array(
            array(CURLOPT_AUTOREFERER,"derp"),
            array(CURLOPT_BUFFERSIZE,"derp"),
            array(CURLOPT_CAINFO,false),
            array(CURLOPT_HTTP200ALIASES,""),
        );
    }
}
