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
 * @license     http://teknoo.software/curl/license/gpl-3.0     GPL v3 License
 * @author      Richard Déloge <richarddeloge@gmail.com>
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 *
 * @version     0.8.1
 */
namespace Teknoo\Curl;

/**
 * Interface OptionsInterface
 * Interface to define class to manage cUrl's options in a request's context.
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
interface OptionsInterface
{
    /**
     * Determine whether or not the value passed is a valid cURL option.
     *
     * @param int $option An Integer Flag
     *
     * @return bool Whether or not the flag is a valid cURL option
     */
    public function isValidOption($option);

    /**
     * Check whether or not the value is a valid type for the given option.
     *
     * @param int   $option An integer flag
     * @param mixed $value  the value to be set to the integer flag
     *
     * @return bool Whether or not the value is of the correct type
     *
     * @throws \InvalidArgumentException if the $option _is_not_ a valid cURL option
     */
    public function checkOptionValue($option, $value, $throw = true);

    /**
     * Alias of the curl_setopt function.
     *
     * @link http://php.net/manual/function.curl-setopt.php
     *
     * @param resource $resource cUrl resource
     * @param int      $option   Option defined in http://php.net/manual/function.curl-setopt.php
     * @param mixed    $value
     *
     * @return bool
     *
     * @throws \InvalidArgumentException if the option does not exist or if it is invalid
     */
    public function setOptionValue($resource, $option, $value);

    /**
     * Alias of the curl_setopt_array function.
     *
     * @link http://php.net/manual/function.curl-setopt-array.php
     *
     * @param resource $resource curl resource
     * @param array    $options  defined in http://php.net/manual/function.curl-setopt-array.php
     *
     * @return bool
     */
    public function setOptionsValuesArray($resource, $options);
}
