<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220512144116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annuary (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(500) NOT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE seo_site');
        $this->addSql('ALTER TABLE seo ADD site_id INT DEFAULT NULL, ADD annuary_id INT NOT NULL');
        $this->addSql('ALTER TABLE seo ADD CONSTRAINT FK_6C71EC30F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE seo ADD CONSTRAINT FK_6C71EC30FDB28C6F FOREIGN KEY (annuary_id) REFERENCES annuary (id)');
        $this->addSql('CREATE INDEX IDX_6C71EC30F6BD1646 ON seo (site_id)');
        $this->addSql('CREATE INDEX IDX_6C71EC30FDB28C6F ON seo (annuary_id)');
        $this->addSql('ALTER TABLE seo RENAME INDEX idx_85751c7cf675f31b TO IDX_6C71EC30F675F31B');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seo DROP FOREIGN KEY FK_6C71EC30FDB28C6F');
        $this->addSql('CREATE TABLE seo_site (site_id INT NOT NULL, Seo_id INT NOT NULL, INDEX IDX_6455AA3FDB28C6F (Seo_id), INDEX IDX_6455AA3F6BD1646 (site_id), PRIMARY KEY(Seo_id, site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE seo_site ADD CONSTRAINT FK_6455AA3F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seo_site ADD CONSTRAINT FK_6455AA3FDB28C6F FOREIGN KEY (Seo_id) REFERENCES seo (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE annuary');
        $this->addSql('ALTER TABLE seo DROP FOREIGN KEY FK_6C71EC30F6BD1646');
        $this->addSql('DROP INDEX IDX_6C71EC30F6BD1646 ON seo');
        $this->addSql('DROP INDEX IDX_6C71EC30FDB28C6F ON seo');
        $this->addSql('ALTER TABLE seo DROP site_id, DROP annuary_id');
        $this->addSql('ALTER TABLE seo RENAME INDEX idx_6c71ec30f675f31b TO IDX_85751C7CF675F31B');
    }
}
