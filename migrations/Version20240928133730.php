<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240928133730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, abstract LONGTEXT NOT NULL, image1 VARCHAR(100) NOT NULL, content1 LONGTEXT NOT NULL, subtitle1 VARCHAR(255) DEFAULT NULL, image2 VARCHAR(100) DEFAULT NULL, content2 LONGTEXT DEFAULT NULL, subtitle2 VARCHAR(255) DEFAULT NULL, image3 VARCHAR(100) DEFAULT NULL, content3 LONGTEXT DEFAULT NULL, subtitle3 VARCHAR(255) DEFAULT NULL, image4 VARCHAR(100) DEFAULT NULL, content4 LONGTEXT DEFAULT NULL, subtitle4 VARCHAR(255) DEFAULT NULL, image5 VARCHAR(100) DEFAULT NULL, content5 LONGTEXT DEFAULT NULL, subtitle5 VARCHAR(255) DEFAULT NULL, image6 VARCHAR(100) DEFAULT NULL, content6 LONGTEXT DEFAULT NULL, subtitle6 VARCHAR(255) DEFAULT NULL, image7 VARCHAR(100) DEFAULT NULL, content7 LONGTEXT DEFAULT NULL, subtitle7 VARCHAR(255) DEFAULT NULL, image8 VARCHAR(100) DEFAULT NULL, content8 LONGTEXT DEFAULT NULL, subtitle8 VARCHAR(255) DEFAULT NULL, image9 VARCHAR(100) DEFAULT NULL, content9 LONGTEXT DEFAULT NULL, subtitle9 VARCHAR(255) DEFAULT NULL, image10 VARCHAR(100) DEFAULT NULL, content10 LONGTEXT DEFAULT NULL, subtitle10 VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_published TINYINT(1) NOT NULL, slug VARCHAR(128) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rubrik (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE rubrik');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
