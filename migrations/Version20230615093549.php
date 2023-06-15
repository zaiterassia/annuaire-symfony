<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615093549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_85751C7CF47645AE ON annuary (url)');
        $this->addSql('ALTER TABLE seo CHANGE response response enum(\'oui\', \'non\', \'en attente\')');
        $this->addSql('ALTER TABLE seo ADD CONSTRAINT FK_6C71EC30F675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE seo ADD CONSTRAINT FK_6C71EC30F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE seo ADD CONSTRAINT FK_6C71EC30FDB28C6F FOREIGN KEY (annuary_id) REFERENCES annuary (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_85751C7CF47645AE ON annuary');
        $this->addSql('ALTER TABLE seo DROP FOREIGN KEY FK_6C71EC30F675F31B');
        $this->addSql('ALTER TABLE seo DROP FOREIGN KEY FK_6C71EC30F6BD1646');
        $this->addSql('ALTER TABLE seo DROP FOREIGN KEY FK_6C71EC30FDB28C6F');
        $this->addSql('ALTER TABLE seo CHANGE response response VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles VARCHAR(180) NOT NULL');
    }
}
