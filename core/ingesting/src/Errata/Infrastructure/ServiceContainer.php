<?php declare(strict_types=1);

namespace Ingesting\Errata\Infrastructure;

use Ingesting\Errata\Application\Domain\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Domain\Model\Service\ErrataUniqueService;
use Ingesting\Errata\Application\ErrataContextInterface;
use Ingesting\Errata\Application\ErrataModule;
use Ingesting\Errata\Application\Usecase\CreateErrataFeedItem;
use Ingesting\Errata\Application\Usecase\CreateErrataFeedItemUsecase;

abstract class ServiceContainer
{
    protected ?ErrataContextInterface $module = null;

    protected ?CreateErrataFeedItem $createErrataFeedItem = null;

    protected ?ErrataFeedRepository $errataFeedRepository = null;

    protected ?ErrataUniqueService $uniqueErrataIdentity = null;

    public function module(): ErrataContextInterface
    {
        if ($this->module === null) {
            $this->module = new ErrataModule(
                $this->createErrataFeedItem()
            );
        }

        return $this->module;
    }

    protected function errataFeedRepository(): ErrataFeedRepository
    {
        if ($this->errataFeedRepository === null) {
            // Todo use a real implementation
            throw new \RuntimeException('ErrataFeed repository not yet implemented!');
        }

        return $this->errataFeedRepository;
    }

    protected function uniqueErrataIdentity(): ErrataUniqueService
    {
        if ($this->uniqueErrataIdentity === null) {
            $this->uniqueErrataIdentity = new ErrataUniqueService(
                $this->errataFeedRepository()
            );
        }

        return $this->uniqueErrataIdentity;
    }

    protected function createErrataFeedItem(): CreateErrataFeedItem
    {
        if ($this->createErrataFeedItem === null) {
            $this->createErrataFeedItem = new CreateErrataFeedItemUsecase(
                $this->errataFeedRepository(),
                $this->uniqueErrataIdentity()
            );
        }

        return $this->createErrataFeedItem;
    }
}
