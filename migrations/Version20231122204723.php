<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122204723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE piscine_colors (id INT AUTO_INCREMENT NOT NULL, piscine_id INT DEFAULT NULL, color VARCHAR(255) NOT NULL, INDEX IDX_AFE99938E18396B7 (piscine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE piscine_colors ADD CONSTRAINT FK_AFE99938E18396B7 FOREIGN KEY (piscine_id) REFERENCES piscine_liste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piscine_colors DROP FOREIGN KEY FK_AFE99938E18396B7');
        $this->addSql('DROP TABLE piscine_colors');
    }
}
