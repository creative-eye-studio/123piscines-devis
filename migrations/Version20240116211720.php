<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240116211720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piscine_tailles ADD secu_alarme TINYINT(1) NOT NULL, ADD secu_alarme_prix DOUBLE PRECISION DEFAULT NULL, ADD secu_cover TINYINT(1) NOT NULL, ADD secu_cover_prix DOUBLE PRECISION DEFAULT NULL, ADD secu_barrier TINYINT(1) NOT NULL, ADD secu_barrier_prix DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piscine_tailles DROP secu_alarme, DROP secu_alarme_prix, DROP secu_cover, DROP secu_cover_prix, DROP secu_barrier, DROP secu_barrier_prix');
    }
}
