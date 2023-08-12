<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230812180715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'EventStore and Projection table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `event_streams` (
  `no` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `real_stream_name` VARCHAR(150) NOT NULL,
  `stream_name` CHAR(41) NOT NULL,
  `metadata` JSON,
  `category` VARCHAR(150),
  PRIMARY KEY (`no`),
  UNIQUE KEY `ix_rsn` (`real_stream_name`),
  KEY `ix_cat` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;');

        $this->addSql('CREATE TABLE `projections` (
  `no` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `position` JSON,
  `state` JSON,
  `status` VARCHAR(28) NOT NULL,
  `locked_until` CHAR(26),
  PRIMARY KEY (`no`),
  UNIQUE KEY `ix_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE event_streams');
        $this->addSql('DROP TABLE projections');
    }
}
