<?php declare(strict_types=1);

namespace Ingesting\Errata\Application;

use Ingesting\Errata\Application\Domain\Model\ErrataId;
use Ingesting\Errata\Application\Usecase\CreateErrataFeedItem;

final class ErrataModule implements ErrataContextInterface
{
    private CreateErrataFeedItem $createErrataFeedItemUsecase;

    public function __construct(CreateErrataFeedItem $createErrataFeedItemUsecase)
    {
        $this->createErrataFeedItemUsecase = $createErrataFeedItemUsecase;
    }

    public function createErrataFeed(string $title, string $description, string $link, string $pubDate, ?ErrataId $uuidIdentifier): void
    {
        $this->createErrataFeed($title, $description, $link, $pubDate, $uuidIdentifier);
    }
}
