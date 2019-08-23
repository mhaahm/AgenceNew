<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181123195742 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE options_property');
        $this->addSql('ALTER TABLE property ADD filename VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE options_property (options_id INT NOT NULL, property_id INT NOT NULL, PRIMARY KEY(options_id, property_id))');
        $this->addSql('CREATE INDEX idx_21c8aa60549213ec ON options_property (property_id)');
        $this->addSql('CREATE INDEX idx_21c8aa603adb05f1 ON options_property (options_id)');
        $this->addSql('ALTER TABLE options_property ADD CONSTRAINT fk_21c8aa603adb05f1 FOREIGN KEY (options_id) REFERENCES options (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE options_property ADD CONSTRAINT fk_21c8aa60549213ec FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE property DROP filename');
    }
}
