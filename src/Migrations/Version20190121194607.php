<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190121194607 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE digit_result CHANGE result_id result_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE digit_result ADD CONSTRAINT FK_E7CC77D77A7B643 FOREIGN KEY (result_id) REFERENCES result (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7CC77D77A7B643 ON digit_result (result_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE digit_result DROP FOREIGN KEY FK_E7CC77D77A7B643');
        $this->addSql('DROP INDEX UNIQ_E7CC77D77A7B643 ON digit_result');
        $this->addSql('ALTER TABLE digit_result CHANGE result_id result_id INT NOT NULL');
    }
}
