<?php

/**
 * WhatColorIs API Client.
 *
 * @author Tobias Köngeter
 * @copyright Copyright © Bit&Black
 * @link https://www.bitandblack.com
 * @license MIT
 */

namespace WhatColorIs\APIClient\Enum;

use MyCLabs\Enum\Enum;

/**
 * Class ColorSystem
 * 
 * @package Color\System\Enum
 * @method static ColorSystem CIELAB()
 * @method static ColorSystem CMYK()
 * @method static ColorSystem HEX()
 * @method static ColorSystem HKS()
 * @method static ColorSystem HSL()
 * @method static ColorSystem PANTONE()
 * @method static ColorSystem RAL()
 * @method static ColorSystem RGB()
 * @extends Enum<string>
 */
final class ColorSystem extends Enum
{
    private const CIELAB = 'cielab';
    private const CMYK = 'cmyk';
    private const HEX = 'hex';
    private const HKS = 'hks';
    private const HSL = 'hsl';
    private const PANTONE = 'pantone';
    private const RAL = 'ral';
    private const RGB = 'rgb';
}