<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190121201141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE result ADD digit_result_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC1131C2B87C8 FOREIGN KEY (digit_result_id) REFERENCES digit_result (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_136AC1131C2B87C8 ON result (digit_result_id)');
        $this->addSql(
            'UPDATE result r
            INNER JOIN digit_result dr ON dr.result_id = r.id
            SET r.digit_result_id = dr.id WHERE dr.result_id = r.id'
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE result DROP FOREIGN KEY FK_136AC1131C2B87C8');
        $this->addSql('DROP INDEX UNIQ_136AC1131C2B87C8 ON result');
        $this->addSql('ALTER TABLE result DROP digit_result_id');
    }
}
