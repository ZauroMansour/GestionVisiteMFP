<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220221144018 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE corps (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_CAB3F89BED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE corps ADD CONSTRAINT FK_CAB3F89BED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE formation CHANGE telephone telephone VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBAD745416 FOREIGN KEY (ministere_id) REFERENCES ministere (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB476556AF FOREIGN KEY (thematique_id) REFERENCES thematique (id)');
        $this->addSql('ALTER TABLE user CHANGE usern usern VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX usern ON user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6497785C930 ON user (usern)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE corps');
        $this->addSql('ALTER TABLE formation CHANGE telephone telephone VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE usern usern VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX uniq_8d93d6497785c930 ON user');
        $this->addSql('CREATE UNIQUE INDEX usern ON user (usern)');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBAD745416');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB476556AF');
    }
}
