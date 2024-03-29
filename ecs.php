<?php declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
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
        __DIR__ . '/ecs.php',
        __DIR__ . '/rector.php',
    ]);

    $ecsConfig->skip([
        __DIR__ . '/src/Kernel.php',
        __DIR__ . '/tests/bootstrap.php',
        BlankLineAfterOpeningTagFixer::class,
    ]);

    $ecsConfig->rules([
        DeclareStrictTypesFixer::class,
        BlankLineAfterNamespaceFixer::class,
        NoUnusedImportsFixer::class,
        OrderedImportsFixer::class,
        NativeFunctionInvocationFixer::class,
        FullyQualifiedStrictTypesFixer::class,
        StrictComparisonFixer::class,

    ]);
    $ecsConfig->ruleWithConfiguration(ArraySyntaxFixer::class, [
        'syntax' => 'short',
    ]);

    $ecsConfig->sets([
        SetList::SPACES,
        SetList::ARRAY,
        SetList::CLEAN_CODE,
        SetList::PSR_12,
        SetList::DOCBLOCK,
    ]);
};
