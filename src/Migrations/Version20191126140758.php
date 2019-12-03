<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126140758 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE test1 (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE telechargement CHANGE nb nb INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE datenaiss datenaiss DATETIME DEFAULT NULL, CHANGE dateins dateins DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE theme CHANGE libelle libelle VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE test1');
        $this->addSql('ALTER TABLE telechargement CHANGE nb nb INT NOT NULL');
        $this->addSql('ALTER TABLE theme CHANGE libelle libelle VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE datenaiss datenaiss DATETIME NOT NULL, CHANGE dateins dateins DATETIME NOT NULL');
    }
}
