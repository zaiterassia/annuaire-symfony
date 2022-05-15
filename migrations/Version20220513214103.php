<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220513214103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seo CHANGE response response enum(\'oui\', \'non\', \'en attente\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annuary DROP FOREIGN KEY FK_85751C7CF675F31B');
        $this->addSql('DROP INDEX IDX_85751C7CF675F31B ON annuary');
        $this->addSql('ALTER TABLE seo CHANGE site_id site_id INT DEFAULT NULL, CHANGE response response VARCHAR(20) NOT NULL');
    }
}
