<?php declare(strict_types=1);

namespace Ingesting\Analyzer\Infrastructure;

use Ingesting\Analyzer\Application\AnalyzerContextInterface;
use Ingesting\Analyzer\Application\AnalyzerModule;

abstract class ServiceContainer
{
    protected ?AnalyzerContextInterface $module = null;

    public function module(): AnalyzerContextInterface
    {
        if ($this->module === null) {
            $this->module = new AnalyzerModule();
        }

        return $this->module;
    }
}
