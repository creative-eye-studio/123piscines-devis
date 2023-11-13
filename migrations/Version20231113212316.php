<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113212316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE piscine_tailles (id INT AUTO_INCREMENT NOT NULL, piscine_id INT DEFAULT NULL, taille VARCHAR(255) NOT NULL, INDEX IDX_7BA5460FE18396B7 (piscine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE piscine_tailles ADD CONSTRAINT FK_7BA5460FE18396B7 FOREIGN KEY (piscine_id) REFERENCES piscine_liste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piscine_tailles DROP FOREIGN KEY FK_7BA5460FE18396B7');
        $this->addSql('DROP TABLE piscine_tailles');
    }
}
