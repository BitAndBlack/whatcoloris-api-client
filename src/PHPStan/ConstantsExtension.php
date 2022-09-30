<?php

/**
 * WhatColorIs API Client.
 *
 * @author Tobias Köngeter
 * @copyright Copyright © Bit&Black
 * @link https://www.bitandblack.com
 * @license MIT
 */

namespace WhatColorIs\APIClient\PHPStan;

use PHPStan\Reflection\ConstantReflection;
use PHPStan\Rules\Constants\AlwaysUsedClassConstantsExtension;

class ConstantsExtension implements AlwaysUsedClassConstantsExtension
{
    /**
     * @var array<int, string>
     */
    private array $constantsInUse;

    public function __construct()
    {
        $this->constantsInUse = [
            'CIELAB',
            'CMYK',
            'HEX',
            'HKS',
            'HSL',
            'PANTONE',
            'RAL',
            'RGB',
        ];
    }

    public function isAlwaysUsed(ConstantReflection $constant): bool
    {
        if (in_array($constant->getName(), $this->constantsInUse)) {
            return true;
        }

        return false;
    }
}
