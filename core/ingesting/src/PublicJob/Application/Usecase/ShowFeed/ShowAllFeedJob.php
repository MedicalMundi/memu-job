<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Usecase\ShowFeed;

use Ingesting\PublicJob\Application\Model\Iso\ApplicationPort;

interface ShowAllFeedJob extends ApplicationPort
{
    public function showFeedJob(): array;
}
