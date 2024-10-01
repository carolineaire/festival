<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241001094044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prog (id INT AUTO_INCREMENT NOT NULL, artist VARCHAR(100) NOT NULL, style VARCHAR(100) DEFAULT NULL, abstract LONGTEXT NOT NULL, time VARCHAR(255) DEFAULT NULL, stage VARCHAR(255) DEFAULT NULL, avatar VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE rgpd rgpd TINYINT(1) NOT NULL, CHANGE role role VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prog');
        $this->addSql('ALTER TABLE user CHANGE rgpd rgpd TINYINT(1) DEFAULT NULL, CHANGE role role VARCHAR(20) DEFAULT NULL');
    }
}
