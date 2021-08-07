<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200316164432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE departement ADD region_id INT NOT NULL');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B6398260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_C1765B6398260155 ON departement (region_id)');
        $this->addSql('ALTER TABLE visite ADD motif_demande_id INT NOT NULL, ADD departement_id INT NOT NULL, ADD telephone VARCHAR(100) NOT NULL, ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBFFE93879 FOREIGN KEY (motif_demande_id) REFERENCES motif_demande (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBCCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_B09C8CBBFFE93879 ON visite (motif_demande_id)');
        $this->addSql('CREATE INDEX IDX_B09C8CBBCCF9E01E ON visite (departement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B6398260155');
        $this->addSql('DROP INDEX IDX_C1765B6398260155 ON departement');
        $this->addSql('ALTER TABLE departement DROP region_id');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBFFE93879');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBCCF9E01E');
        $this->addSql('DROP INDEX IDX_B09C8CBBFFE93879 ON visite');
        $this->addSql('DROP INDEX IDX_B09C8CBBCCF9E01E ON visite');
        $this->addSql('ALTER TABLE visite DROP motif_demande_id, DROP departement_id, DROP telephone, DROP email');
    }
}
