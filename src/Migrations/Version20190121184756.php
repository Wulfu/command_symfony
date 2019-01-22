<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190121184756 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE answer1 answer1 VARCHAR(255) NOT NULL, CHANGE answer2 answer2 VARCHAR(255) NOT NULL, CHANGE answer3 answer3 VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX question_id ON result');
        $this->addSql('ALTER TABLE result CHANGE is_deleted is_deleted TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE question DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE question CHANGE id id INT DEFAULT NULL, CHANGE title title TINYTEXT DEFAULT NULL COLLATE utf8_general_ci, CHANGE answer1 answer1 TINYTEXT DEFAULT NULL COLLATE utf8_general_ci, CHANGE answer2 answer2 TINYTEXT DEFAULT NULL COLLATE utf8_general_ci, CHANGE answer3 answer3 TINYTEXT DEFAULT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE result CHANGE is_deleted is_deleted TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('CREATE INDEX question_id ON result (question_id)');
    }
}
