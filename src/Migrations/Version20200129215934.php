<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129215934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F176DE5EFD14');
        $this->addSql('DROP TABLE region_type');
        $this->addSql('DROP INDEX IDX_F62F176DE5EFD14 ON region');
        $this->addSql('ALTER TABLE region CHANGE region_type_id type_region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F1762CE04045 FOREIGN KEY (type_region_id) REFERENCES type_region (id)');
        $this->addSql('CREATE INDEX IDX_F62F1762CE04045 ON region (type_region_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE region_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, max_building INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F1762CE04045');
        $this->addSql('DROP INDEX IDX_F62F1762CE04045 ON region');
        $this->addSql('ALTER TABLE region CHANGE type_region_id region_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176DE5EFD14 FOREIGN KEY (region_type_id) REFERENCES region_type (id)');
        $this->addSql('CREATE INDEX IDX_F62F176DE5EFD14 ON region (region_type_id)');
    }
}
