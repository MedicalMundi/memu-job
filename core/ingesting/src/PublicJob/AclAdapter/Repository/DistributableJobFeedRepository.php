<?php declare(strict_types=1);

namespace Ingesting\PublicJob\AclAdapter\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Ingesting\PublicJob\AclAdapter\Model\DistributableJobFeed;
use Ingesting\PublicJob\AclAdapter\Model\JobFeed;

class DistributableJobFeedRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function getTodayData(): array
    {
        $todayDate = new \DateTimeImmutable('now');
        $conn = $this->entityManager->getConnection();
        $sql = '
            SELECT * FROM ingestion_jobfeed p
            WHERE CAST(p.publication_date AS DATE) = :today_date
            ORDER BY p.publication_date ASC
            ';

        // TODO CATCH EXCEPTION
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'today_date' => $todayDate-> format(\DateTimeInterface::ATOM),
        ]);

        return $this->formatResult($resultSet->fetchAllAssociative());
    }

    /**
     * @return DistributableJobFeed[]
     */
    private function formatResult(array $items): array
    {
        $result = [];

        /** @var array $item */
        foreach ($items as $item) {
            $result[] = JobFeed::fromArray($item);
        }

        return $result;
    }
}
