<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206083536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite_equipment DROP FOREIGN KEY FK_CA2C1081652CAE9B');
        $this->addSql('ALTER TABLE gite_equipment DROP FOREIGN KEY FK_CA2C1081517FE9FE');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE gite_equipment');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, extra_cost NUMERIC(10, 0) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE gite_equipment (gite_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_CA2C1081652CAE9B (gite_id), INDEX IDX_CA2C1081517FE9FE (equipment_id), PRIMARY KEY(gite_id, equipment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE gite_equipment ADD CONSTRAINT FK_CA2C1081652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipment ADD CONSTRAINT FK_CA2C1081517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
    }
}
