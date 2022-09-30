<?php

namespace WhatColorIs\APIClient\PHPStan;

use PHPStan\Reflection\ConstantReflection;
use PHPStan\Rules\Constants\AlwaysUsedClassConstantsExtension;

class ConstantsExtension implements AlwaysUsedClassConstantsExtension
{
    public function isAlwaysUsed(ConstantReflection $constant): bool
    {
        return true;
    }
}
