<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230815064304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ecotone document store';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `ecotone_document_store` (
  `collection` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `document_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `document_type` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `document` json NOT NULL,
  `updated_at` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
');
        $this->addSql('
        ALTER TABLE `ecotone_document_store` ADD PRIMARY KEY (`collection`,`document_id`);
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ecotone_document_store');
    }
}

