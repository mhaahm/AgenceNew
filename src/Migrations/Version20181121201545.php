<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181121201545 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE IF EXISTS agence_user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE IF EXISTS user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE IF NOT EXISTS  options_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE IF NOT EXISTS options (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE  IF NOT EXISTS options_property (options_id INT NOT NULL, property_id INT NOT NULL, PRIMARY KEY(options_id, property_id))');
        $this->addSql('CREATE INDEX IF NOT EXISTS IDX_21C8AA603ADB05F1 ON options_property (options_id)');
        $this->addSql('CREATE INDEX IF NOT EXISTS IDX_21C8AA60549213EC ON options_property (property_id)');
        $this->addSql('ALTER TABLE options_property ADD CONSTRAINT FK_21C8AA603ADB05F1 FOREIGN KEY (options_id) REFERENCES options (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE options_property ADD CONSTRAINT FK_21C8AA60549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE agence_user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE options_property DROP CONSTRAINT FK_21C8AA603ADB05F1');
        $this->addSql('DROP SEQUENCE IF EXISTS options_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE IF NOT EXISTS agence_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE IF NOT EXISTS user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agence_user (id INT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE options');
        $this->addSql('DROP TABLE options_property');
    }
}
