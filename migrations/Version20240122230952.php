<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122230952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piscine_esc ADD taille_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE piscine_esc ADD CONSTRAINT FK_5FC40724FF25611A FOREIGN KEY (taille_id) REFERENCES piscine_tailles (id)');
        $this->addSql('CREATE INDEX IDX_5FC40724FF25611A ON piscine_esc (taille_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piscine_esc DROP FOREIGN KEY FK_5FC40724FF25611A');
        $this->addSql('DROP INDEX IDX_5FC40724FF25611A ON piscine_esc');
        $this->addSql('ALTER TABLE piscine_esc DROP taille_id');
    }
}
