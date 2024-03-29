<?php

/**
 * WhatColorIs API Client.
 *
 * @author Tobias Köngeter
 * @copyright Copyright © Bit&Black
 * @link https://www.bitandblack.com
 * @license MIT
 */

namespace WhatColorIs\APIClient\Tests\ColorInformationLoader;

use PHPUnit\Framework\TestCase;
use WhatColorIs\APIClient\ColorInformationLoader\WhatColorIsAPI;
use WhatColorIs\APIClient\Enum\ColorSystem;
use WhatColorIs\APIClient\Exception\APIKeyMissingException;

class WhatColorIsAPITest extends TestCase
{
    public function testRequestColorSystem(): void
    {
        $this->expectException(APIKeyMissingException::class);
        
        $whatColorIsAPI = new WhatColorIsAPI();
        $whatColorIsAPI->requestColorSystem(ColorSystem::PANTONE());
    }
}
