<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Infrastructure;

use Ingesting\PublicJob\Application\PublicJobContextInterface;
use Ingesting\PublicJob\Application\PublicJobModule;

abstract class ServiceContainer
{
    protected ?PublicJobContextInterface $module = null;

    public function module(): PublicJobContextInterface
    {
        if ($this->module === null) {
            $this->module = new PublicJobModule();
        }
        return $this->module;
    }
}
