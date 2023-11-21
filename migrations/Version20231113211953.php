<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113211953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE piscine_liste (id INT AUTO_INCREMENT NOT NULL, forme_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_764C66E1BCE84E7C (forme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE piscine_liste ADD CONSTRAINT FK_764C66E1BCE84E7C FOREIGN KEY (forme_id) REFERENCES piscine_forme (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piscine_liste DROP FOREIGN KEY FK_764C66E1BCE84E7C');
        $this->addSql('DROP TABLE piscine_liste');
    }
}
