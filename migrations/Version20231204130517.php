<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204130517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gite (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, location VARCHAR(255) NOT NULL, region VARCHAR(255) DEFAULT NULL, department VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, latitude NUMERIC(10, 8) DEFAULT NULL, longitude NUMERIC(11, 8) DEFAULT NULL, hab_surface INT NOT NULL, no_bedrooms INT NOT NULL, no_beds INT NOT NULL, pet_friendly TINYINT(1) NOT NULL, pet_fee NUMERIC(10, 0) DEFAULT NULL, INDEX IDX_B638C92C7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92C7E3C61F9');
        $this->addSql('DROP TABLE gite');
    }
}
