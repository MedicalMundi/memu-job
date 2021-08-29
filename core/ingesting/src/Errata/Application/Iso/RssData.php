<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Iso;

interface RssData
{
    public function title(): string;

    public function description(): string;

    public function link(): string;

    public function publicationDate(): string;
}
