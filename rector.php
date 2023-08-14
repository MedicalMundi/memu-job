<?php declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/core/backoffice/src',
        __DIR__ . '/core/backoffice/tests',
        __DIR__ . '/core/ingesting/src',
        __DIR__ . '/core/ingesting/tests',
        __DIR__ . '/core/publishing/src',
        __DIR__ . '/core/publishing/tests',
        __DIR__ . '/core/websiteBFF/src',
        __DIR__ . '/core/websiteBFF/tests',
    ]);

    $rectorConfig->skip([
        __DIR__ . '/tests/Behat/DemoContext.php',
        __DIR__ . '/tests/Behat/OtherDemoContext.php',
    ]);

    $rectorConfig->symfonyContainerXml(__DIR__ . '/var/cache/dev/App_KernelDevDebugContainer.xml');

    // define PHP sets of rules
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_80,
    ]);

    // define PHP sets of rules
    $rectorConfig->sets([
        SymfonySetList::SYMFONY_54,
        SymfonySetList::SYMFONY_CODE_QUALITY,
        SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION,
    ]);

    // register a single rule
    // $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);
};
