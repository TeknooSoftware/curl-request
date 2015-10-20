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
 * @copyright   Copyright (c) 2009-2016 Uni Alteri (http://uni-alteri.com)
 * @copyright   Copyright (c) 2009-2016 Richard Déloge (r.deloge@uni-alteri.com)
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
 * Class ErrorException
 * Default exception used in this library throwed when an error is encountered by Curl.
 *
 * @copyright   Copyright (c) 2009-2016 Uni Alteri (http://uni-alteri.com)
 * @copyright   Copyright (c) 2009-2016 Richard Déloge (r.deloge@uni-alteri.com)
 * @copyright   Copyright (c) Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 *
 * @link        http://teknoo.it/curl Project website
 *
 * @license     http://teknoo.it/curl/license/mit         MIT License
 * @license     http://teknoo.it/curl/license/gpl-3.0     GPL v3 License
 * @author      Darrell Hamilton <darrell.noice@gmail.com> (initial developer)
 */
class ErrorException extends \RuntimeException
{
}
