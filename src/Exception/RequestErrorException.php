<?php

/**
 * WhatColorIs API Client.
 *
 * @author Tobias Köngeter
 * @copyright Copyright © Bit&Black
 * @link https://www.bitandblack.com
 * @license MIT
 */

namespace WhatColorIs\APIClient\Exception;

use Throwable;
use WhatColorIs\APIClient\Exception;

/**
 * Class RequestErrorException.
 */
class RequestErrorException extends Exception
{
    public function __construct(Throwable $exception)
    {
        parent::__construct($exception->getMessage());
    }
}
