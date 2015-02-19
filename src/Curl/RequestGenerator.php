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

namespace UniAlteri\Curl;

/**
 * Class RequestGenerator
 * A service class for generating Curl\Request objects with an initial
 * set of CURLOPT_* options set.
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
     * @var null|string
     */
    protected $startArgs = null;

    /**
     * @param OptionsInterface $options
     * @param string           $args
     */
    public function __construct(OptionsInterface $options = null, $args = '')
    {
        //Build a default options manager
        if (!$options instanceof OptionsInterface) {
            $this->options = new Options();
        } else {
            $this->options = $options;
        }

        if (is_string($args)) {
            if (!empty($args)) {
                //Service is started with initial configuration, register it to pass it when the first request
                // will be required. Not create request object now to avoid to reserve unused resources
                $this->startArgs = $args;
            }
        } elseif ($args instanceof RequestInterface) {
            //Service is started with an existent request
            $this->request = clone $args;
        } else {
            if (is_object($args)) {
                $type = get_class($args);
            } else {
                $type = gettype($args);
            }

            throw new \LogicException(
                'Unsupported argument type.  Expected array instance of Request. Got '.$type.'.'
            );
        }
    }

    /**
     * To define the original request to use as "model" in the service. It will be cloned at each call of getRequest().
     *
     * @param RequestInterface $request
     *
     * @return $this
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Generate a Request object with preset options.
     *
     * @return Request a cURL Request object
     */
    public function getRequest()
    {
        if (!$this->request instanceof RequestInterface) {
            //Check if it is the first, call, create the request if needd
            $this->request = new Request($this->getOptions());
            $this->request->setReturnValue(true);

            if (!empty($this->startArgs)) {
                //Apply initial configuration
                $this->request->setUrl($this->startArgs);
            }
        }

        //Return a clone to avoid update locale options
        return clone $this->request;
    }

    /**
     * Return the options manager user here.
     *
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * To change the options manager to use in this service.
     *
     * @param OptionsInterface $options
     *
     * @return $this
     */
    public function setOptions(OptionsInterface $options)
    {
        $this->options = $options;

        return $this;
    }
}
