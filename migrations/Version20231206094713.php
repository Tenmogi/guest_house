<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206094713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service ADD gite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2652CAE9B ON service (gite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2652CAE9B');
        $this->addSql('DROP INDEX IDX_E19D9AD2652CAE9B ON service');
        $this->addSql('ALTER TABLE service DROP gite_id');
    }
}
