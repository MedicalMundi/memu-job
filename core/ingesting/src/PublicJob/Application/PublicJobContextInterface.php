<?php declare(strict_types=1);


namespace Ingesting\PublicJob\Application;

use Ingesting\PublicJob\Application\Usecase\JobRssDataSourceChecker;

interface PublicJobContextInterface extends JobRssDataSourceChecker
{
}
