<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211102234534 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE usern usern VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX usern TO UNIQ_8D93D6497785C930');
        $this->addSql('ALTER TABLE visite CHANGE motif_demande_id motif_demande_id INT DEFAULT NULL, CHANGE departement_id departement_id INT DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE demande demande LONGTEXT DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE datenaiss datenaiss DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBAD745416 FOREIGN KEY (ministere_id) REFERENCES ministere (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB476556AF FOREIGN KEY (thematique_id) REFERENCES thematique (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE usern usern VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d6497785c930 TO usern');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBAD745416');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB476556AF');
        $this->addSql('ALTER TABLE visite CHANGE motif_demande_id motif_demande_id INT NOT NULL, CHANGE departement_id departement_id INT NOT NULL, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE demande demande LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE datenaiss datenaiss DATE NOT NULL');
    }
}
