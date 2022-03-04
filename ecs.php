<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters
        ->set(Option::PATHS, [
            __DIR__.DIRECTORY_SEPARATOR.'src',
            __DIR__.DIRECTORY_SEPARATOR.'tests',
        ])
    ;

    $services = $containerConfigurator->services();

    $services
        ->set(NoUnusedImportsFixer::class)
    ;
};