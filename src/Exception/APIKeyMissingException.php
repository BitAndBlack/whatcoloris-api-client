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

use WhatColorIs\APIClient\Exception;

/**
 * Class APIKeyMissingException.
 */
class APIKeyMissingException extends Exception
{
    public function __construct()
    {
        parent::__construct('The API token for the WhatColorIs REST API is missing. See more under https://www.whatcolor.is/rest-api.html');
    }
}
