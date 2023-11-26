<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126100343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piscine_tailles ADD filtrations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE piscine_tailles ADD CONSTRAINT FK_7BA5460FFFDB5CFB FOREIGN KEY (filtrations_id) REFERENCES filtrations (id)');
        $this->addSql('CREATE INDEX IDX_7BA5460FFFDB5CFB ON piscine_tailles (filtrations_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piscine_tailles DROP FOREIGN KEY FK_7BA5460FFFDB5CFB');
        $this->addSql('DROP INDEX IDX_7BA5460FFFDB5CFB ON piscine_tailles');
        $this->addSql('ALTER TABLE piscine_tailles DROP filtrations_id');
    }
}
