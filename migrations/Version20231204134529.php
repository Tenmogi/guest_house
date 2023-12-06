<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204134529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gite_equipment (gite_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_CA2C1081652CAE9B (gite_id), INDEX IDX_CA2C1081517FE9FE (equipment_id), PRIMARY KEY(gite_id, equipment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_service (gite_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_1527AE9A652CAE9B (gite_id), INDEX IDX_1527AE9AED5CA9E6 (service_id), PRIMARY KEY(gite_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gite_equipment ADD CONSTRAINT FK_CA2C1081652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipment ADD CONSTRAINT FK_CA2C1081517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9A652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9AED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE weekly_rate ADD gite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE weekly_rate ADD CONSTRAINT FK_34F58309652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id)');
        $this->addSql('CREATE INDEX IDX_34F58309652CAE9B ON weekly_rate (gite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite_equipment DROP FOREIGN KEY FK_CA2C1081652CAE9B');
        $this->addSql('ALTER TABLE gite_equipment DROP FOREIGN KEY FK_CA2C1081517FE9FE');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9A652CAE9B');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9AED5CA9E6');
        $this->addSql('DROP TABLE gite_equipment');
        $this->addSql('DROP TABLE gite_service');
        $this->addSql('ALTER TABLE weekly_rate DROP FOREIGN KEY FK_34F58309652CAE9B');
        $this->addSql('DROP INDEX IDX_34F58309652CAE9B ON weekly_rate');
        $this->addSql('ALTER TABLE weekly_rate DROP gite_id');
    }
}
