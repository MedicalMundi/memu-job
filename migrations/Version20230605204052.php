<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230605204052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE backoffice_user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CDBB2BF5E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingestion_erratafeed (errata_id CHAR(36) NOT NULL COMMENT \'(DC2Type:errata_id)\', title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, link VARCHAR(255) NOT NULL, publication_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(errata_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingestion_jobfeed (job_id CHAR(36) NOT NULL COMMENT \'(DC2Type:job_id)\', title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, link VARCHAR(255) NOT NULL, publication_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE backoffice_user');
        $this->addSql('DROP TABLE ingestion_erratafeed');
        $this->addSql('DROP TABLE ingestion_jobfeed');
    }
}
