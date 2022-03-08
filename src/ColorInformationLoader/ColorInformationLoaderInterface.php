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
     * @return array{
     *     systems: array<int, array{
     *         system: string,
     *         prefix: string,
     *         suffix: string,
     *     }>,
     *     values?: array<int, array<string, int|float|string>>
     * }
     */
    public function requestColorSystem(ColorSystem $colorSystem): array;

    /**
     * @param ColorSystem $colorSystem Name of the requested color system.
     * @param string $colorName        Name of a specific color.
     * @return array{
     *     name_short: string,
     *     name_full: string,
     *     systems: array<int, string>,
     *     prefix: string,
     *     suffix: string,
     *     values: array<string, array<string|int, int|float|string>>
     * }
     */
    public function requestColorValue(ColorSystem $colorSystem, string $colorName): array;
}