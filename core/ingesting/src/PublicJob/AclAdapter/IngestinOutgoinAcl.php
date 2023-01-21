<?php declare(strict_types=1);

namespace Ingesting\PublicJob\AclAdapter;

use Ingesting\PublicJob\Application\Model\GenericAclService;

interface IngestinOutgoinAcl extends GenericAclService
{
    /**
     * Return jobFeed items with
     * date equals today
     */
    public function getPublishedToday(): array;

    //
    //    /**
    //     * Return jobPost items with
    //     * date between last N days
    //     */
    //    public function lastDays(int $days = 2): array;
    //
    //    /**
    //     * Return jobPost items with
    //     * date start from a day
    //     */
    //    public function sinceDate(\DateTimeImmutable $since): array;
}
