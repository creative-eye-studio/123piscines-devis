<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126100134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filtrations DROP FOREIGN KEY FK_EF83263E1AEC613E');
        $this->addSql('DROP INDEX IDX_EF83263E1AEC613E ON filtrations');
        $this->addSql('ALTER TABLE filtrations DROP tailles_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filtrations ADD tailles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filtrations ADD CONSTRAINT FK_EF83263E1AEC613E FOREIGN KEY (tailles_id) REFERENCES piscine_tailles (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EF83263E1AEC613E ON filtrations (tailles_id)');
    }
}
