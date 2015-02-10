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
namespace UniAlteri\Curl;

/**
 * Class Request
 * An OO wrapper on the curl_* functions in PHP to manage and execute HTTP request via cUrl
 *
 * @package     CurlRequest
 * @copyright   Copyright (c) 2009-2015 Uni Alteri (http://agence.net.ua)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 * @link        http://teknoo.it/curl Project website
 * @license     http://teknoo.it/curl/license/mit         MIT License
 * @license     http://teknoo.it/curl/license/gpl-3.0     GPL v3 License
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 */
class Request implements RequestInterface
{
    /**
     * the cURL handle resource for this request
     * @var resource
     */
    protected $handle;

    /**
     * @var Options
     */
    protected $Options;

    /**
     * Map specific HTTP requests to their appropriate CURLOPT_* constant
     *
     * @var array
     */
    static protected $methodOptionMap = array(
        'GET' => CURLOPT_HTTPGET,
        'POST' => CURLOPT_POST,
        'HEAD' => CURLOPT_NOBODY,
        'PUT' => CURLOPT_PUT,
    );

    /**
     * Instantiate a new cURL Request object
     *
     * @param Options $Options Validator to check option used to perform the request
     * @param string  $url     string URL to initialize the cURL handle with
     */
    public function __construct(Options $Options, $url = null)
    {
        $this->Options = $Options;

        if (isset($url)) {
            $this->handle = curl_init($url);
        } else {
            $this->handle = curl_init();
        }
    }

    /**
     * Getter for the internal curl handle resource
     *
     * @return resource the curl handle
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Alias of the curl_setopt function
     * @link http://php.net/manual/function.curl-setopt.php
     * @param  int                       $option Option defined in http://php.net/manual/function.curl-setopt.php
     * @param  mixed                     $value
     * @return boolean
     * @throws \InvalidArgumentException if the option does not exist or if it is invalid
     */
    public function setOption($option, $value)
    {
        return $this->Options->setOptionValue($this->getHandle(), $option, $value);
    }

    /**
     * Alias of the curl_setopt_array function
     * @link http://php.net/manual/function.curl-setopt-array.php
     * @param  array   $options defined in http://php.net/manual/function.curl-setopt-array.php
     * @return boolean
     */
    public function setOptionArray(array $options)
    {
        return $this->Options->setOptionsValuesArray($this->getHandle(), $options);
    }

    /**
     * To free the resource at destruction
     */
    public function __destruct()
    {
        curl_close($this->handle);
    }

    /**
     * Execute the cURL request
     *
     * @link http://php.net/manual/function.curl-exec.php
     * @return mixed          the results of curl_exec
     * @throws ErrorException
     */
    public function execute()
    {
        //Execute the request
        $value = curl_exec($this->handle);

        //Check if there are an error
        $error_no = curl_errno($this->handle);

        if (0 !== $error_no) {
            //There are an error, throw an exception
            throw new ErrorException(curl_error($this->handle), $error_no);
        }

        return $value;
    }

    /**
     * Alias of the curl_getinfo function
     * @link http://php.net/manual/function.curl-getinfo.php
     * @param  int          $flag defined in http://php.net/manual/function.curl-getinfo.php
     * @return string|array the results of curl_getinfo
     */
    public function getInfo($flag = null)
    {
        if (isset($flag)) {
            return curl_getinfo($this->handle, $flag);
        } else {
            return curl_getinfo($this->handle);
        }
    }

    /**
     * Convenience method for setting the appropriate cURL options based on the desired
     * HTTP request method
     *
     * @param  string  $method
     * @return boolean
     */
    public function setMethod($method)
    {
        if (isset(static::$methodOptionMap[$method])) {
            return $this->setOption(static::$methodOptionMap[$method], true);
        } else {
            return $this->setOption(CURLOPT_CUSTOMREQUEST, $method);
        }
    }

    /**
     * To support cloning and clone the resource and not use the same.
     */
    public function __clone()
    {
        $this->handle = curl_copy_handle($this->handle);
    }
}
