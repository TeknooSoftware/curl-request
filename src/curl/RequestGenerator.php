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
 * Class RequestGenerator
 * A service class for generating Curl\Request objects with an initial
 * set of CURLOPT_* options set
 *
 * @package     CurlRequest
 * @copyright   Copyright (c) 2009-2015 Uni Alteri (http://agence.net.ua)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 * @link        http://teknoo.it/curl Project website
 * @license     http://teknoo.it/curl/license/mit         MIT License
 * @license     http://teknoo.it/curl/license/gpl-3.0     GPL v3 License
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 */
class RequestGenerator
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Options
     */
    protected $options;

    /**
     * @param Options $options
     * @param array   $arg
     */
    public function __construct(Options $options, $arg = array())
    {
        if (is_array($arg)) {
            $this->request = new Request($options);
            $this->request->setOptionArray($arg);
        } elseif ($arg instanceof Request) {
            $this->request = clone $arg;
        } else {
            if (is_object($arg)) {
                $type = get_class($arg);
            } else {
                $type = gettype($arg);
            }

            throw new \LogicException(
                'Unsupported argument type.  Expected array instance of Request. Got '.$type.'.'
            );
        }
    }

    /**
     * Generate a Request object with preset options
     *
     * @return Request a cURL Request object
     */
    public function getRequest()
    {
        return clone $this->request;
    }

    public function getOptions()
    {
        return $this->options;
    }
}
