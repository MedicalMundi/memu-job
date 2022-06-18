<?php declare(strict_types=1);

namespace Ingesting\PublicJob\AclAdapter;

use Ingesting\PublicJob\Application\Model\GenericAclService;

interface JobFeedOutgoinAcl extends GenericAclService
{
    /**
     * Return jobPost items with
     * date equals today
     */
    public function lastDay(): array;
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
