<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220115122909 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, piecesjointes_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C53D045F1B3E20A0 (piecesjointes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F1B3E20A0 FOREIGN KEY (piecesjointes_id) REFERENCES agent_etat (id)');
        $this->addSql('ALTER TABLE agent_etat DROP cniname, CHANGE datetraitement datetraitement DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE formation CHANGE telephone telephone VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE usern usern VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX usern TO UNIQ_8D93D6497785C930');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBAD745416 FOREIGN KEY (ministere_id) REFERENCES ministere (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB476556AF FOREIGN KEY (thematique_id) REFERENCES thematique (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE agent_etat ADD cniname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE datetraitement datetraitement DATETIME NOT NULL');
        $this->addSql('ALTER TABLE formation CHANGE telephone telephone VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE usern usern VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d6497785c930 TO usern');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBAD745416');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB476556AF');
    }
}
