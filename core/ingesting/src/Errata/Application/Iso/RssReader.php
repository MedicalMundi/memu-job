<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Iso;

interface RssReader
{
    public function readRssFeed(): array;
}
