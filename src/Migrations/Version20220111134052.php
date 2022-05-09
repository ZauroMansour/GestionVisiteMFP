<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220111134052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agent_etat (id INT AUTO_INCREMENT NOT NULL, id_agent VARCHAR(12) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, datenaiss DATE NOT NULL, matricule VARCHAR(20) NOT NULL, cni VARCHAR(25) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, telephone VARCHAR(25) DEFAULT NULL, adresse LONGTEXT DEFAULT NULL, demande LONGTEXT NOT NULL, datedemande DATETIME NOT NULL, corps VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation_agent_etat (reclamation_id INT NOT NULL, agent_etat_id INT NOT NULL, INDEX IDX_C080BED02D6BA2D9 (reclamation_id), INDEX IDX_C080BED0DF0DE455 (agent_etat_id), PRIMARY KEY(reclamation_id, agent_etat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reclamation_agent_etat ADD CONSTRAINT FK_C080BED02D6BA2D9 FOREIGN KEY (reclamation_id) REFERENCES reclamation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation_agent_etat ADD CONSTRAINT FK_C080BED0DF0DE455 FOREIGN KEY (agent_etat_id) REFERENCES agent_etat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation CHANGE telephone telephone VARCHAR(10) NOT NULL');
        // $this->addSql('ALTER TABLE user CHANGE usern usern VARCHAR(255) NOT NULL');
        // $this->addSql('ALTER TABLE user RENAME INDEX usern TO UNIQ_8D93D6497785C930');
        // $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBAD745416 FOREIGN KEY (ministere_id) REFERENCES ministere (id)');
        // $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB476556AF FOREIGN KEY (thematique_id) REFERENCES thematique (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reclamation_agent_etat DROP FOREIGN KEY FK_C080BED0DF0DE455');
        $this->addSql('ALTER TABLE reclamation_agent_etat DROP FOREIGN KEY FK_C080BED02D6BA2D9');
        $this->addSql('DROP TABLE agent_etat');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reclamation_agent_etat');
        $this->addSql('ALTER TABLE formation CHANGE telephone telephone VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE usern usern VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d6497785c930 TO usern');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBAD745416');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB476556AF');
    }
}
