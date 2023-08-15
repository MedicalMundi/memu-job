<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230815065759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ecotone deduplication';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `ecotone_deduplication` (
  `message_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `consumer_endpoint_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `routing_slip` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `handled_at` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
');
        $this->addSql('ALTER TABLE `ecotone_deduplication`
  ADD PRIMARY KEY (`message_id`,`consumer_endpoint_id`,`routing_slip`),
  ADD KEY `IDX_4FEBE3E36F4B26C` (`handled_at`);');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ecotone_deduplication');
    }
}

