<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609172139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE concorso_article (id CHAR(36) NOT NULL COMMENT \'(DC2Type:concorso_article_id)\', title VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, publication_start DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', publication_end DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_draft TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE concorso_article');
    }
}
