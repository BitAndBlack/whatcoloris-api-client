<?php

/**
 * WhatColorIs API Client.
 *
 * @author Tobias Köngeter
 * @copyright Copyright © Bit&Black
 * @link https://www.bitandblack.com
 * @license MIT
 */

namespace WhatColorIs\APIClient;

/**
 * Class Exception
 * 
 * @package Color
 */
class Exception extends \Exception
{
    /**
     * Exception constructor.
     * 
     * @param string $message
     */
    public function __construct(string $message) 
    {
        parent::__construct($message);
    }
}
