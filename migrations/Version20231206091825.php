<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206091825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipment ADD gite_id INT NOT NULL');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id)');
        $this->addSql('CREATE INDEX IDX_D338D583652CAE9B ON equipment (gite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583652CAE9B');
        $this->addSql('DROP INDEX IDX_D338D583652CAE9B ON equipment');
        $this->addSql('ALTER TABLE equipment DROP gite_id');
    }
}
