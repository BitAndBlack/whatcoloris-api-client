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
    /** @phpstan-ignore-next-line */
    private const CIELAB = 'cielab';

    /** @phpstan-ignore-next-line */
    private const CMYK = 'cmyk';

    /** @phpstan-ignore-next-line */
    private const HEX = 'hex';

    /** @phpstan-ignore-next-line */
    private const HKS = 'hks';

    /** @phpstan-ignore-next-line */
    private const HSL = 'hsl';

    /** @phpstan-ignore-next-line */
    private const PANTONE = 'pantone';

    /** @phpstan-ignore-next-line */
    private const RAL = 'ral';

    /** @phpstan-ignore-next-line */
    private const RGB = 'rgb';
}