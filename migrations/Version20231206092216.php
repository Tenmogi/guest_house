<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206092216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipment_feature (equipment_id INT NOT NULL, feature_id INT NOT NULL, INDEX IDX_69ACBA89517FE9FE (equipment_id), INDEX IDX_69ACBA8960E4B879 (feature_id), PRIMARY KEY(equipment_id, feature_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipment_feature ADD CONSTRAINT FK_69ACBA89517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipment_feature ADD CONSTRAINT FK_69ACBA8960E4B879 FOREIGN KEY (feature_id) REFERENCES feature (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipment_feature DROP FOREIGN KEY FK_69ACBA89517FE9FE');
        $this->addSql('ALTER TABLE equipment_feature DROP FOREIGN KEY FK_69ACBA8960E4B879');
        $this->addSql('DROP TABLE equipment_feature');
    }
}
