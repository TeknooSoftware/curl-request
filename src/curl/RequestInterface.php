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
 * @copyright   Copyright (c) 2009-2015 Uni Alteri (http://agence.net.ua)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 * @link        http://teknoo.it/curl Project website
 * @license     http://teknoo.it/curl/license/mit         MIT License
 * @license     http://teknoo.it/curl/license/gpl-3.0     GPL v3 License
 * @author      Richard Déloge <r.deloge@uni-alteri.com>
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 * @version     0.8.0
 */
namespace UniAlteri\curl;

/**
 * Interface RequestInterface
 * Interface to define class to represent a request, aka a curl instance
 *
 * @package     CurlRequest
 * @copyright   Copyright (c) 2009-2015 Uni Alteri (http://agence.net.ua)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 * @link        http://teknoo.it/curl Project website
 * @license     http://teknoo.it/curl/license/mit         MIT License
 * @license     http://teknoo.it/curl/license/gpl-3.0     GPL v3 License
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 */
interface RequestInterface
{
    /**
     * Getter for the internal curl handle resource
     *
     * @return resource the curl handle
     */
    public function getHandle();

    /**
     * Alias of the curl_setopt function
     * @link http://php.net/manual/function.curl-setopt.php
     * @param  int                       $option Option defined in http://php.net/manual/function.curl-setopt.php
     * @param  mixed                     $value
     * @return boolean
     * @throws \InvalidArgumentException if the option does not exist or if it is invalid
     */
    public function setOption($option, $value);

    /**
     * Alias of the curl_setopt_array function
     * @link http://php.net/manual/function.curl-setopt-array.php
     * @param  array   $options defined in http://php.net/manual/function.curl-setopt-array.php
     * @return boolean
     */
    public function setOptionArray(array $options);

    /**
     * Execute the cURL request
     *
     * @link http://php.net/manual/function.curl-exec.php
     * @return mixed          the results of curl_exec
     * @throws ErrorException
     */
    public function execute();

    /**
     * Alias of the curl_getinfo function
     * @link http://php.net/manual/function.curl-getinfo.php
     * @param  int          $flag defined in http://php.net/manual/function.curl-getinfo.php
     * @return string|array the results of curl_getinfo
     */
    public function getInfo($flag = null);

    /**
     * Convenience method for setting the appropriate cURL options based on the desired
     * HTTP request method
     *
     * @param  string  $method
     * @return boolean
     */
    public function setMethod($method);
}
