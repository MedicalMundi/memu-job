<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Usecase;

use Ingesting\Errata\Application\Domain\Model\ErrataId;

interface CreateErrataFeedItem
{
    public function createErrataFeed(string $title, string $description, string $link, string $pubDate, ?ErrataId $uuidIdentifier): void;
}
