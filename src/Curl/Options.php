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

namespace Teknoo\Curl;

/**
 * Class Options
 * Class to manage cUrl Options and the valid type(s) for each and define them in a request context.
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
class Options implements OptionsInterface
{
    /**
     * List of available CURL Option in this execution.
     *
     * @var array
     */
    protected $optionValueTypesList = array();

    /**
     * Initialize curl options
     * Checks which cURL constants is defined and loads them as valid options.
     */
    public function __construct()
    {
        //Defined CURL options in PHP
        $options = array(
            'CURLOPT_AUTOREFERER' => 'bool',
            'CURLOPT_BINARYTRANSFER' => 'bool',
            'CURLOPT_COOKIESESSION' => 'bool',
            'CURLOPT_CERTINFO' => 'bool',
            'CURLOPT_CRLF' => 'bool',
            'CURLOPT_DNS_USE_GLOBAL_CACHE' => 'bool',
            'CURLOPT_FAILONERROR' => 'bool',
            'CURLOPT_FILETIME' => 'bool',
            'CURLOPT_FOLLOWLOCATION' => 'bool',
            'CURLOPT_FORBID_REUSE' => 'bool',
            'CURLOPT_FRESH_CONNECT' => 'bool',
            'CURLOPT_FTP_USE_EPRT' => 'bool',
            'CURLOPT_FTP_USE_EPSV' => 'bool',
            'CURLOPT_FTP_CREATE_MISSING_DIRS' => 'bool',
            'CURLOPT_FTPAPPEND' => 'bool',
            'CURLOPT_FTPASCII' => 'bool',
            'CURLOPT_FTPLISTONLY' => 'bool',
            'CURLOPT_HEADER' => 'bool',
            'CURLINFO_HEADER_OUT' => 'bool',
            'CURLOPT_HTTPGET' => 'bool',
            'CURLOPT_HTTPPROXYTUNNEL' => 'bool',
            'CURLOPT_MUTE' => 'bool',
            'CURLOPT_NETRC' => 'bool',
            'CURLOPT_NOBODY' => 'bool',
            'CURLOPT_NOPROGRESS' => 'bool',
            'CURLOPT_NOSIGNAL' => 'bool',
            'CURLOPT_POST' => 'bool',
            'CURLOPT_PUT' => 'bool',
            'CURLOPT_RETURNTRANSFER' => 'bool',
            'CURLOPT_SSL_VERIFYPEER' => 'bool',
            'CURLOPT_TRANSFERTEXT' => 'bool',
            'CURLOPT_UNRESTRICTED_AUTH' => 'bool',
            'CURLOPT_UPLOAD' => 'bool',
            'CURLOPT_VERBOSE' => 'bool',
            'CURLOPT_BUFFERSIZE' => 'int',
            'CURLOPT_CLOSEPOLICY' => 'int',
            'CURLOPT_CONNECTTIMEOUT' => 'int',
            'CURLOPT_CONNECTTIMEOUT_MS' => 'int',
            'CURLOPT_DNS_CACHE_TIMEOUT' => 'int',
            'CURLOPT_FTPSSLAUTH' => 'int',
            'CURLOPT_HTTP_VERSION' => 'int',
            'CURLOPT_HTTPAUTH' => 'int',
            'CURLOPT_INFILESIZE' => 'int',
            'CURLOPT_LOW_SPEED_LIMIT' => 'int',
            'CURLOPT_LOW_SPEED_TIME' => 'int',
            'CURLOPT_MAXCONNECTS' => 'int',
            'CURLOPT_MAXREDIRS' => 'int',
            'CURLOPT_PORT' => 'int',
            'CURLOPT_PROTOCOLS' => 'int',
            'CURLOPT_PROXYAUTH' => 'int',
            'CURLOPT_PROXYPORT' => 'int',
            'CURLOPT_PROXYTYPE' => 'int',
            'CURLOPT_REDIR_PROTOCOLS' => 'int',
            'CURLOPT_RESUME_FROM' => 'int',
            'CURLOPT_SSL_VERIFYHOST' => 'int',
            'CURLOPT_SSLVERSION' => 'int',
            'CURLOPT_TIMECONDITION' => 'int',
            'CURLOPT_TIMEOUT' => 'int',
            'CURLOPT_TIMEOUT_MS' => 'int',
            'CURLOPT_TIMEVALUE' => 'int',
            'CURLOPT_MAX_RECV_SPEED_LARGE' => 'int',
            'CURLOPT_MAX_SEND_SPEED_LARGE' => 'int',
            'CURLOPT_SSH_AUTH_TYPES' => 'int',
            'CURLOPT_CAINFO' => 'string',
            'CURLOPT_CAPATH' => 'string',
            'CURLOPT_COOKIE' => 'string',
            'CURLOPT_COOKIEFILE' => 'string',
            'CURLOPT_COOKIEJAR' => 'string',
            'CURLOPT_CUSTOMREQUEST' => 'string',
            'CURLOPT_EGDSOCKET' => 'string',
            'CURLOPT_ENCODING' => 'string',
            'CURLOPT_FTPPORT' => 'string',
            'CURLOPT_INTERFACE' => 'string',
            'CURLOPT_KEYPASSWD' => 'string',
            'CURLOPT_KRB4LEVEL' => 'string',
            'CURLOPT_POSTFIELDS' => array('string','array'),
            'CURLOPT_PROXY' => 'string',
            'CURLOPT_PROXYUSERPWD' => 'string',
            'CURLOPT_RANDOM_FILE' => 'string',
            'CURLOPT_RANGE' => 'string',
            'CURLOPT_REFERER' => 'string',
            'CURLOPT_SSH_HOST_PUBLIC_KEY_MD5' => 'string',
            'CURLOPT_SSH_PUBLIC_KEYFILE' => 'string',
            'CURLOPT_SSH_PRIVATE_KEYFILE' => 'string',
            'CURLOPT_SSL_CIPHER_LIST' => 'string',
            'CURLOPT_SSLCERT' => 'string',
            'CURLOPT_SSLCERTPASSWD' => 'string',
            'CURLOPT_SSLCERTTYPE' => 'string',
            'CURLOPT_SSLENGINE' => 'string',
            'CURLOPT_SSLENGINE_DEFAULT' => 'string',
            'CURLOPT_SSLKEY' => 'string',
            'CURLOPT_SSLKEYPASSWD' => 'string',
            'CURLOPT_SSLKEYTYPE' => 'string',
            'CURLOPT_URL' => 'string',
            'CURLOPT_USERAGENT' => 'string',
            'CURLOPT_USERPWD' => 'string',
            'CURLOPT_HTTP200ALIASES' => 'array',
            'CURLOPT_HTTPHEADER' => 'array',
            'CURLOPT_POSTQUOTE' => 'array',
            'CURLOPT_QUOTE' => 'array',
            'CURLOPT_FILE' => 'resource',
            'CURLOPT_INFILE' => 'resource',
            'CURLOPT_STDERR' => 'resource',
            'CURLOPT_WRITEHEADER' => 'resource',
            'CURLOPT_HEADERFUNCTION' => 'callable',
            'CURLOPT_PASSWDFUNCTION' => 'callable',
            'CURLOPT_PROGRESSFUNCTION' => 'callable',
            'CURLOPT_READFUNCTION' => 'callable',
            'CURLOPT_WRITEFUNCTION' => 'callable',
        );

        //Browse each constant to check if there are available here
        foreach ($options as $option => $type) {
            if (defined($option)) {
                $this->optionValueTypesList[constant($option)] = $type;
            }
        }
    }

    /**
     * Determine whether or not the value passed is a valid cURL option.
     *
     * @param int $option An Integer Flag
     *
     * @return bool Whether or not the flag is a valid cURL option
     */
    public function isValidOption($option)
    {
        return isset($this->optionValueTypesList[$option]);
    }

    /**
     * Check whether or not the value is a valid type for the given option.
     *
     * @param int   $option An integer flag
     * @param mixed $value  the value to be set to the integer flag
     *
     * @return bool $throw  Whether or not the value is of the correct type
     *
     * @throws \InvalidArgumentException if the $option _is_not_ a valid cURL option
     */
    public function checkOptionValue($option, $value, $throw = true)
    {
        if ($this->isValidOption($option)) {
            $result = $this->checkType($value, $this->optionValueTypesList[$option]);

            if (!$result && true === $throw) {
                throw new \InvalidArgumentException('Invalid value for the given cURL option');
            }

            return $result;
        } else {
            throw new \InvalidArgumentException('Not a valid cURL option');
        }
    }

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
    public function setOptionValue($resource, $option, $value)
    {
        $this->checkOptionValue($option, $value);

        return curl_setopt($resource, $option, $value);
    }

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
    public function setOptionsValuesArray($resource, $options)
    {
        foreach ($options as $option => $value) {
            $this->checkOptionValue($option, $value);
        }

        return curl_setopt_array($resource, $options);
    }

    /**
     * Check if the type of $value is the attempted type by the option.
     *
     * @param mixed  $value
     * @param string $type
     *
     * @return bool
     */
    protected function checkType($value, $type)
    {
        $result = false;

        if (is_array($type)) {
            //Several types are available
            foreach ($type as $item) {
                //Check each type
                $result = $this->checkType($value, $item);
                if (!empty($result)) {
                    //Good type found
                    break;
                }
            }
        } else {
            //Scalar type
            $func = 'is_'.$type;

            if (is_callable($func)) {
                //Execute the php method to perform the check
                $result = $func($value);
            }
        }

        return $result;
    }
}
