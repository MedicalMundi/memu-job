<?php declare(strict_types=1);

namespace Ingesting\Errata\Infrastructure;

use FeedIo\Factory;
use Ingesting\Errata\Adapter\Rss\FeedIoRssReader;
use Ingesting\Errata\Application\ErrataContextInterface;
use Ingesting\Errata\Application\ErrataModule;
use Ingesting\Errata\Application\Iso\RssReader;
use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\Service\ErrataUniqueService;
use Ingesting\Errata\Application\Usecase\ErrataRssDataSoureChecker;
use Ingesting\Errata\Application\Usecase\ReadErrataRssUsecase;
use Psr\Log\LoggerInterface;

abstract class ServiceContainer
{
    protected ?ErrataContextInterface $module = null;

    protected ?ErrataRssDataSoureChecker $readErrataRssUsecase = null;

    protected ?ErrataFeedRepository $errataFeedRepository = null;

    protected ?ErrataUniqueService $uniqueErrataIdentity = null;

    protected ?RssReader $rssReader = null;

    public function module(): ErrataContextInterface
    {
        if ($this->module === null) {
            $this->module = new ErrataModule(
                $this->readErrataRssUsecase()
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

    protected function readErrataRssUsecase(): ErrataRssDataSoureChecker
    {
        if ($this->readErrataRssUsecase === null) {
            $this->readErrataRssUsecase = new ReadErrataRssUsecase(
                $this->errataFeedRepository(),
                $this->uniqueErrataIdentity(),
                $this->rssReader()
            );
        }

        return $this->readErrataRssUsecase;
    }

    protected function rssReader(): RssReader
    {
        if ($this->rssReader === null) {
            $this->rssReader = new FeedIoRssReader(Factory::create()->getFeedIo());
        }

        return $this->rssReader;
    }

    abstract protected function logger(): LoggerInterface;
}
