<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222133759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel VARCHAR(25) NOT NULL, email VARCHAR(50) NOT NULL, mf VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, firstname VARCHAR(50) NOT NULL, adresse VARCHAR(100) NOT NULL, cin BIGINT NOT NULL, tel VARCHAR(25) NOT NULL, email VARCHAR(50) NOT NULL, specialite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, secteur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, sous_titre VARCHAR(255) DEFAULT NULL, detail VARCHAR(255) DEFAULT NULL, objectifs VARCHAR(255) NOT NULL, contenu VARCHAR(255) DEFAULT NULL, mode VARCHAR(30) NOT NULL, duree VARCHAR(30) DEFAULT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, unite VARCHAR(20) DEFAULT NULL, INDEX IDX_404021BF9F7E4405 (secteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_formateur (formation_id INT NOT NULL, formateur_id INT NOT NULL, INDEX IDX_270B2E925200282E (formation_id), INDEX IDX_270B2E92155D8F51 (formateur_id), PRIMARY KEY(formation_id, formateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_assuree (id INT AUTO_INCREMENT NOT NULL, formateur_id INT NOT NULL, client_id INT NOT NULL, formation_id INT NOT NULL, date_debut DATETIME NOT NULL, unite VARCHAR(255) NOT NULL, qte INT NOT NULL, INDEX IDX_E850DE81155D8F51 (formateur_id), INDEX IDX_E850DE8119EB6921 (client_id), INDEX IDX_E850DE815200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, detail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF9F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE formation_formateur ADD CONSTRAINT FK_270B2E925200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_formateur ADD CONSTRAINT FK_270B2E92155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_assuree ADD CONSTRAINT FK_E850DE81155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id)');
        $this->addSql('ALTER TABLE formation_assuree ADD CONSTRAINT FK_E850DE8119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE formation_assuree ADD CONSTRAINT FK_E850DE815200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF9F7E4405');
        $this->addSql('ALTER TABLE formation_formateur DROP FOREIGN KEY FK_270B2E925200282E');
        $this->addSql('ALTER TABLE formation_formateur DROP FOREIGN KEY FK_270B2E92155D8F51');
        $this->addSql('ALTER TABLE formation_assuree DROP FOREIGN KEY FK_E850DE81155D8F51');
        $this->addSql('ALTER TABLE formation_assuree DROP FOREIGN KEY FK_E850DE8119EB6921');
        $this->addSql('ALTER TABLE formation_assuree DROP FOREIGN KEY FK_E850DE815200282E');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_formateur');
        $this->addSql('DROP TABLE formation_assuree');
        $this->addSql('DROP TABLE secteur');
    }
}
