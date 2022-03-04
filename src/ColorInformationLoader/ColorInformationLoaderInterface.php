<?php

/**
 * WhatColorIs API Client.
 *
 * @author Tobias Köngeter
 * @copyright Copyright © Bit&Black
 * @link https://www.bitandblack.com
 * @license MIT
 */

namespace WhatColorIs\APIClient\ColorInformationLoader;

use WhatColorIs\APIClient\Enum\ColorSystem;

/**
 * Interface ColorInformationLoaderInterface.
 */
interface ColorInformationLoaderInterface
{
    /**
     * @param ColorSystem $colorSystem Name of the requested color system.
     * @param string|null $colorName   Name of a specific color.
     * @return array<mixed>
     */
    public function request(ColorSystem $colorSystem, string $colorName = null): array;
}