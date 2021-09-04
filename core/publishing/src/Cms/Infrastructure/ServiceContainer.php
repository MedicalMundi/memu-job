<?php declare(strict_types=1);

namespace Publishing\Cms\Infrastructure;

use Publishing\Cms\Application\CmsContext;
use Publishing\Cms\Application\CmsModule;

abstract class ServiceContainer
{
    protected ?CmsContext $module = null;

    public function module(): CmsContext
    {
        if ($this->module === null) {
            $this->module = new CmsModule();
        }

        return $this->module;
    }
}
