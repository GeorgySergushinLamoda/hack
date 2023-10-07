<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231007040104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action (id INT NOT NULL, name TEXT NOT NULL, short_description TEXT NOT NULL, full_description TEXT DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, finish_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, visible BOOLEAN NOT NULL, price INT NOT NULL, action_text TEXT NOT NULL, link TEXT DEFAULT NULL, goal INT DEFAULT NULL, processor TEXT NOT NULL, steps TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN action.start_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN action.finish_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE action_status (id INT NOT NULL, action_id INT NOT NULL, actor_id TEXT NOT NULL, status TEXT NOT NULL, progress SMALLINT DEFAULT NULL, value INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B93054779D32F035 ON action_status (action_id)');
        $this->addSql('ALTER TABLE action_status ADD CONSTRAINT FK_B93054779D32F035 FOREIGN KEY (action_id) REFERENCES action (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE action_status DROP CONSTRAINT FK_B93054779D32F035');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE action_status');
    }
}
