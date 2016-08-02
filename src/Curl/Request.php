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
 * to richarddeloge@gmail.com so we can send you a copy immediately.
 *
 *
 * @copyright   Copyright (c) 2009-2016 Richard Déloge (richarddeloge@gmail.com)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 *
 * @link        http://teknoo.software/curl Project website
 *
 * @license     http://teknoo.software/curl/license/mit         MIT License
 *
 * @author      Richard Déloge <richarddeloge@gmail.com>
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 *
 * @version     0.8.1
 */
namespace Teknoo\Curl;

/**
 * Class Request
 * An OO wrapper on the curl_* functions in PHP to manage and execute HTTP request via cUrl.
 *
 *
 * @copyright   Copyright (c) 2009-2016 Richard Déloge (richarddeloge@gmail.com)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 *
 * @link        http://teknoo.software/curl Project website
 *
 * @license     http://teknoo.software/curl/license/mit         MIT License
 *
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 */
class Request implements RequestInterface
{
    /**
     * the cURL handle resource for this request.
     *
     * @var resource
     */
    protected $handle;

    /**
     * @var Options
     */
    protected $options;

    /*
     * Map specific HTTP requests to their appropriate CURLOPT_* constant
     *
     * @var array
     */
    protected static $methodOptionMap = array(
        'GET' => CURLOPT_HTTPGET,
        'POST' => CURLOPT_POST,
        'HEAD' => CURLOPT_NOBODY,
        'PUT' => CURLOPT_PUT,
    );

    /**
     * Instantiate a new cURL Request object.
     *
     * @param Options $Options Validator to check option used to perform the request
     * @param string  $url     string URL to initialize the cURL handle with
     */
    public function __construct(Options $Options, $url = null)
    {
        $this->options = $Options;

        $this->handle = curl_init();

        if (isset($url)) {
            $this->setUrl($url);
        }
    }

    /**
     * Getter for the internal curl handle resource.
     *
     * @return resource the curl handle
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Alias of the curl_setopt function.
     *
     * @link http://php.net/manual/function.curl-setopt.php
     *
     * @param int   $option Option defined in http://php.net/manual/function.curl-setopt.php
     * @param mixed $value
     *
     * @return $this
     *
     * @throws \InvalidArgumentException if the option does not exist or if it is invalid
     */
    public function setOption($option, $value)
    {
        $this->options->setOptionValue($this->getHandle(), $option, $value);

        return $this;
    }

    /**
     * Alias of the curl_setopt_array function.
     *
     * @link http://php.net/manual/function.curl-setopt-array.php
     *
     * @param array $options defined in http://php.net/manual/function.curl-setopt-array.php
     *
     * @return $this
     */
    public function setOptionArray(array $options)
    {
        $this->options->setOptionsValuesArray($this->getHandle(), $options);

        return $this;
    }

    /**
     * To free the resource at destruction.
     */
    public function __destruct()
    {
        curl_close($this->handle);
    }

    /**
     * Execute the cURL request.
     *
     * @link http://php.net/manual/function.curl-exec.php
     *
     * @return mixed the results of curl_exec
     *
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
     * To return the transfer as a string of the return value of execute() instead of outputting it out directly.
     *
     * @param bool $enable
     *
     * @return $this
     */
    public function setReturnValue($enable)
    {
        if (!empty($enable)) {
            $this->setOption(CURLOPT_RETURNTRANSFER, true);
        } else {
            $this->setOption(CURLOPT_RETURNTRANSFER, false);
        }

        return $this;
    }

    /**
     * Method to define url to call.
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->setOption(CURLOPT_URL, $url);

        return $this;
    }

    /**
     * Alias of the curl_getinfo function.
     *
     * @link http://php.net/manual/function.curl-getinfo.php
     *
     * @param int $flag defined in http://php.net/manual/function.curl-getinfo.php
     *
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
     * HTTP request method.
     *
     * @param string $method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        if (isset(static::$methodOptionMap[$method])) {
            $this->setOption(static::$methodOptionMap[$method], true);
        } else {
            $this->setOption(CURLOPT_CUSTOMREQUEST, $method);
        }

        return $this;
    }

    /**
     * To support cloning and clone the resource and not use the same.
     */
    public function __clone()
    {
        $this->handle = curl_copy_handle($this->handle);
    }
}
