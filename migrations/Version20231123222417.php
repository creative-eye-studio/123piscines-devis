<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123222417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filtrations (id INT AUTO_INCREMENT NOT NULL, tailles_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_EF83263E1AEC613E (tailles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filtrations ADD CONSTRAINT FK_EF83263E1AEC613E FOREIGN KEY (tailles_id) REFERENCES piscine_tailles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filtrations DROP FOREIGN KEY FK_EF83263E1AEC613E');
        $this->addSql('DROP TABLE filtrations');
    }
}
