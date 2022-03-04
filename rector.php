<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Set\ValueObject\LevelSetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    
    $parameters
        ->set(Option::PATHS, [
            __DIR__.DIRECTORY_SEPARATOR.'src',
            __DIR__.DIRECTORY_SEPARATOR.'tests',
        ])
        ->set(Option::AUTO_IMPORT_NAMES, true)
        ->set(Option::IMPORT_DOC_BLOCKS, false)
    ;
    
    $containerConfigurator->import(LevelSetList::UP_TO_PHP_74);
};
