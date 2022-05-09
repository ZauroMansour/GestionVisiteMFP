<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211115123618 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE formation CHANGE telephone telephone VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE thematique ADD actif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE usern usern VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX usern TO UNIQ_8D93D6497785C930');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBAD745416 FOREIGN KEY (ministere_id) REFERENCES ministere (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB476556AF FOREIGN KEY (thematique_id) REFERENCES thematique (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE formation CHANGE telephone telephone VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE thematique DROP actif');
        $this->addSql('ALTER TABLE user CHANGE usern usern VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d6497785c930 TO usern');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBAD745416');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB476556AF');
    }
}
