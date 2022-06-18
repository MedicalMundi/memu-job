<?php declare(strict_types=1);

namespace Ingesting\PublicJob\AclAdapter;

interface DistributableJobFeed
{
    public function identity(): string;

    public function title(): string;

    public function description(): string;

    public function link(): string;
}
