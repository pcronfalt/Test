<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126141016 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE test1 ADD test2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test1 ADD CONSTRAINT FK_8AB2DCE2D6703629 FOREIGN KEY (test2_id) REFERENCES test2 (id)');
        $this->addSql('CREATE INDEX IDX_8AB2DCE2D6703629 ON test1 (test2_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE test1 DROP FOREIGN KEY FK_8AB2DCE2D6703629');
        $this->addSql('DROP INDEX IDX_8AB2DCE2D6703629 ON test1');
        $this->addSql('ALTER TABLE test1 DROP test2_id');
    }
}
