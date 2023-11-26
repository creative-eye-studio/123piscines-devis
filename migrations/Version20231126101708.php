<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126101708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filtrations_piscine_tailles (filtrations_id INT NOT NULL, piscine_tailles_id INT NOT NULL, INDEX IDX_B201882FFDB5CFB (filtrations_id), INDEX IDX_B2018826D823D92 (piscine_tailles_id), PRIMARY KEY(filtrations_id, piscine_tailles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filtrations_piscine_tailles ADD CONSTRAINT FK_B201882FFDB5CFB FOREIGN KEY (filtrations_id) REFERENCES filtrations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filtrations_piscine_tailles ADD CONSTRAINT FK_B2018826D823D92 FOREIGN KEY (piscine_tailles_id) REFERENCES piscine_tailles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filtrations DROP FOREIGN KEY FK_EF83263E1AEC613E');
        $this->addSql('DROP INDEX IDX_EF83263E1AEC613E ON filtrations');
        $this->addSql('ALTER TABLE filtrations DROP tailles_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filtrations_piscine_tailles DROP FOREIGN KEY FK_B201882FFDB5CFB');
        $this->addSql('ALTER TABLE filtrations_piscine_tailles DROP FOREIGN KEY FK_B2018826D823D92');
        $this->addSql('DROP TABLE filtrations_piscine_tailles');
        $this->addSql('ALTER TABLE filtrations ADD tailles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filtrations ADD CONSTRAINT FK_EF83263E1AEC613E FOREIGN KEY (tailles_id) REFERENCES piscine_tailles (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EF83263E1AEC613E ON filtrations (tailles_id)');
    }
}
