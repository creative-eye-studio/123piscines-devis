<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116050809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piscine_tailles ADD forme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE piscine_tailles ADD CONSTRAINT FK_7BA5460FBCE84E7C FOREIGN KEY (forme_id) REFERENCES piscine_forme (id)');
        $this->addSql('CREATE INDEX IDX_7BA5460FBCE84E7C ON piscine_tailles (forme_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piscine_tailles DROP FOREIGN KEY FK_7BA5460FBCE84E7C');
        $this->addSql('DROP INDEX IDX_7BA5460FBCE84E7C ON piscine_tailles');
        $this->addSql('ALTER TABLE piscine_tailles DROP forme_id');
    }
}
