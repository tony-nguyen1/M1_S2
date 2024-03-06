<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306122723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__tournoi AS SELECT id, description, evenement_id FROM tournoi');
        $this->addSql('DROP TABLE tournoi');
        $this->addSql('CREATE TABLE tournoi (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description VARCHAR(20) NOT NULL, evenement_id INTEGER NOT NULL, CONSTRAINT FK_18AFD9DFFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tournoi (id, description, evenement_id) SELECT id, description, evenement_id FROM __temp__tournoi');
        $this->addSql('DROP TABLE __temp__tournoi');
        $this->addSql('CREATE INDEX IDX_18AFD9DFFD02F13 ON tournoi (evenement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__tournoi AS SELECT id, description, evenement_id FROM tournoi');
        $this->addSql('DROP TABLE tournoi');
        $this->addSql('CREATE TABLE tournoi (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description VARCHAR(20) NOT NULL, evenement_id INTEGER NOT NULL, ev_id INTEGER NOT NULL, CONSTRAINT FK_18AFD9DFFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_18AFD9DF40A4EC42 FOREIGN KEY (ev_id) REFERENCES evenement (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tournoi (id, description, evenement_id) SELECT id, description, evenement_id FROM __temp__tournoi');
        $this->addSql('DROP TABLE __temp__tournoi');
        $this->addSql('CREATE INDEX IDX_18AFD9DFFD02F13 ON tournoi (evenement_id)');
        $this->addSql('CREATE INDEX IDX_18AFD9DF40A4EC42 ON tournoi (ev_id)');
    }
}
