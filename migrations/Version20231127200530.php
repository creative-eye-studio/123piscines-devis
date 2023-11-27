<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127200530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filtrations_piscine_tailles DROP FOREIGN KEY FK_B2018826D823D92');
        $this->addSql('ALTER TABLE filtrations_piscine_tailles DROP FOREIGN KEY FK_B201882FFDB5CFB');
        $this->addSql('DROP TABLE filtrations_piscine_tailles');
        $this->addSql('ALTER TABLE filtrations ADD tailles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filtrations ADD CONSTRAINT FK_EF83263E1AEC613E FOREIGN KEY (tailles_id) REFERENCES piscine_tailles (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF83263E1AEC613E ON filtrations (tailles_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filtrations_piscine_tailles (filtrations_id INT NOT NULL, piscine_tailles_id INT NOT NULL, INDEX IDX_B2018826D823D92 (piscine_tailles_id), INDEX IDX_B201882FFDB5CFB (filtrations_id), PRIMARY KEY(filtrations_id, piscine_tailles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE filtrations_piscine_tailles ADD CONSTRAINT FK_B2018826D823D92 FOREIGN KEY (piscine_tailles_id) REFERENCES piscine_tailles (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filtrations_piscine_tailles ADD CONSTRAINT FK_B201882FFDB5CFB FOREIGN KEY (filtrations_id) REFERENCES filtrations (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filtrations DROP FOREIGN KEY FK_EF83263E1AEC613E');
        $this->addSql('DROP INDEX UNIQ_EF83263E1AEC613E ON filtrations');
        $this->addSql('ALTER TABLE filtrations DROP tailles_id');
    }
}
