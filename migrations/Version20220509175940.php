<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509175940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Seo (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, url VARCHAR(255) NOT NULL, username VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, response SMALLINT NOT NULL, response_url VARCHAR(255) DEFAULT NULL, observations VARCHAR(500) DEFAULT NULL, edit_date DATETIME DEFAULT NULL, INDEX IDX_85751C7CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Seo_site (Seo_id INT NOT NULL, site_id INT NOT NULL, INDEX IDX_6455AA3FDB28C6F (Seo_id), INDEX IDX_6455AA3F6BD1646 (site_id), PRIMARY KEY(Seo_id, site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, url VARCHAR(255) NOT NULL, edit_date DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, keywords LONGTEXT DEFAULT NULL, INDEX IDX_694309E4F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Seo ADD CONSTRAINT FK_85751C7CF675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE Seo_site ADD CONSTRAINT FK_6455AA3FDB28C6F FOREIGN KEY (Seo_id) REFERENCES Seo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Seo_site ADD CONSTRAINT FK_6455AA3F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4F675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Seo_site DROP FOREIGN KEY FK_6455AA3FDB28C6F');
        $this->addSql('ALTER TABLE Seo_site DROP FOREIGN KEY FK_6455AA3F6BD1646');
        $this->addSql('DROP TABLE Seo');
        $this->addSql('DROP TABLE Seo_site');
        $this->addSql('DROP TABLE site');
    }
}
