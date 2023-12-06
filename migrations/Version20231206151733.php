<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206151733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feature_equipment DROP FOREIGN KEY FK_65271511517FE9FE');
        $this->addSql('ALTER TABLE feature_equipment DROP FOREIGN KEY FK_6527151160E4B879');
        $this->addSql('DROP TABLE feature_equipment');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE feature_equipment (feature_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_6527151160E4B879 (feature_id), INDEX IDX_65271511517FE9FE (equipment_id), PRIMARY KEY(feature_id, equipment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE feature_equipment ADD CONSTRAINT FK_65271511517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE feature_equipment ADD CONSTRAINT FK_6527151160E4B879 FOREIGN KEY (feature_id) REFERENCES feature (id) ON DELETE CASCADE');
    }
}
