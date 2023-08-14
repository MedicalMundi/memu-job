<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Adapter\Persistence\Doctrine;

use Doctrine\DBAL\Statement;
use Doctrine\ORM\EntityManagerInterface;
use Ingesting\PublicJob\Application\Usecase\ReadableJobFeedRepository;

class DoctrineReadableJobFeedRepository implements ReadableJobFeedRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function listAvailableJobFeed(): array
    {
        $conn = $this->entityManager->getConnection();
        $sql = '
            SELECT * FROM ingestion_jobfeed p
            ORDER BY p.publication_date ASC
            ';
        try {
            /** @var Statement $stmt */
            $stmt = $conn->prepare($sql);
            $resultSet = $stmt->executeQuery();
            return $resultSet->fetchAllAssociative();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
