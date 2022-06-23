<?php declare(strict_types=1);

namespace Ingesting\PublicJob\AclAdapter\Repository;

use Doctrine\DBAL\Statement;
use Doctrine\ORM\EntityManagerInterface;

class DistributableJobFeedRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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
        /** @var Statement $stmt */
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'today_date' => $todayDate-> format(\DateTimeInterface::ATOM),
        ]);

        return $resultSet->fetchAllAssociative();
    }
}
