<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model\Iso;

interface RssReader extends ApplicationPort
{
    public function readRssFeed(): array;
}
