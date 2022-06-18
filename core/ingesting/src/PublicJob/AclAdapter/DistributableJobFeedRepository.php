<?php declare(strict_types=1);

namespace Ingesting\PublicJob\AclAdapter;

use Doctrine\ORM\EntityManagerInterface;

class DistributableJobFeedRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getTodayData(): array
    {
        $todayDate = new \DateTimeImmutable('now');
        $conn = $this->entityManager->getConnection();
        $sql = '
            SELECT * FROM ingestion_jobfeed p
            WHERE CAST(p.publication_date AS DATE) = :today_date
            ORDER BY p.publication_date ASC
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'today_date' => $todayDate-> format(\DateTimeInterface::ATOM),
        ]);

        return $resultSet->fetchAllAssociative();
    }
}
