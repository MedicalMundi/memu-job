<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230815065122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ecotone error messages';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('
        CREATE TABLE `ecotone_error_messages` (
  `message_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` datetime NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
        ');

        $this->addSql('
            ALTER TABLE `ecotone_error_messages` ADD PRIMARY KEY (`message_id`), ADD KEY `IDX_F9FBCA7B1DD19495` (`failed_at`);
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ecotone_error_messages ');
    }
}

