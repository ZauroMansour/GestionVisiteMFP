<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317124449 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, structure_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E19D9AD22534008B (structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD22534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE motif_demande DROP FOREIGN KEY FK_67E3108F2534008B');
        $this->addSql('DROP INDEX IDX_67E3108F2534008B ON motif_demande');
        $this->addSql('ALTER TABLE motif_demande ADD service_id INT DEFAULT NULL, DROP structure_id');
        $this->addSql('ALTER TABLE motif_demande ADD CONSTRAINT FK_67E3108FED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_67E3108FED5CA9E6 ON motif_demande (service_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE motif_demande DROP FOREIGN KEY FK_67E3108FED5CA9E6');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP INDEX IDX_67E3108FED5CA9E6 ON motif_demande');
        $this->addSql('ALTER TABLE motif_demande ADD structure_id INT NOT NULL, DROP service_id');
        $this->addSql('ALTER TABLE motif_demande ADD CONSTRAINT FK_67E3108F2534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('CREATE INDEX IDX_67E3108F2534008B ON motif_demande (structure_id)');
    }
}
