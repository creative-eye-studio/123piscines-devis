<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127195902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filtrations ADD nom_id INT DEFAULT NULL, DROP nom');
        $this->addSql('ALTER TABLE filtrations ADD CONSTRAINT FK_EF83263EC8121CE9 FOREIGN KEY (nom_id) REFERENCES piscine_liste (id)');
        $this->addSql('CREATE INDEX IDX_EF83263EC8121CE9 ON filtrations (nom_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filtrations DROP FOREIGN KEY FK_EF83263EC8121CE9');
        $this->addSql('DROP INDEX IDX_EF83263EC8121CE9 ON filtrations');
        $this->addSql('ALTER TABLE filtrations ADD nom VARCHAR(255) NOT NULL, DROP nom_id');
    }
}
