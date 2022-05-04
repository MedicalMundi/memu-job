<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;

/**
 * La configurazione rimane volutamente incompiuta, Rector viene usato solo manualmente in locale
 * e non tramite CI.
 *
 * Data la natura specifica del tool sono distribuiti dei file di conf. specicifici per il tipo di
 * refactoring o upgrade.
 *
 * Usare o aggiungere i file di configurazione presenti nella directory in tools/rector/config
 *
 *
 */


return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src'
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // define sets of rules
    //    $rectorConfig->sets([
    //        LevelSetList::UP_TO_PHP_74
    //    ]);
};
