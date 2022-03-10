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
     * Requests information about a color system, for example all libraries of `PANTONE`.
     *
     * @param ColorSystem $colorSystem Name of the requested color system.
     * @return array{
     *     systems: array<int, array{
     *         system: string,
     *         prefix: string,
     *         suffix: string,
     *     }>,
     * }
     */
    public function requestColorSystem(ColorSystem $colorSystem): array;

    /**
     * Requests all available colors of a color system, for example all colors of `PANTONE`.
     *
     * @param ColorSystem $colorSystem Name of the requested color system.
     * @return array{
     *     values?: array<int, array{
     *         name_short: string,
     *         name_full: string,
     *         values: array<string, array<string, int|float|string>>
     *     }>
     * }
     */
    public function requestColorSystemValues(ColorSystem $colorSystem): array;

    /**
     * Requests a specific color value, for example `PANTONE 215 C`.
     * 
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