<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220521150230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_marque (categorie_id INT NOT NULL, marque_id INT NOT NULL, INDEX IDX_DC493BF7BCF5E72D (categorie_id), INDEX IDX_DC493BF74827B9B2 (marque_id), PRIMARY KEY(categorie_id, marque_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couleur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, vehicule_id INT DEFAULT NULL, nom_img VARCHAR(255) DEFAULT NULL, INDEX IDX_C53D045F4A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, vehicule_id INT DEFAULT NULL, emprunt_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', rendu_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', rendu VARBINARY(255) NOT NULL, lieulocation VARCHAR(255) NOT NULL, lieurendu VARCHAR(255) NOT NULL, prolongation DATETIME DEFAULT NULL, INDEX IDX_5E9E89CBA76ED395 (user_id), INDEX IDX_5E9E89CB4A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, marque_id INT DEFAULT NULL, vehicule_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_D79572D9BCF5E72D (categorie_id), INDEX IDX_D79572D94827B9B2 (marque_id), INDEX IDX_D79572D94A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, numpermis VARCHAR(255) DEFAULT NULL, hasrent VARBINARY(255) NOT NULL, registrate_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', born_at DATE NOT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postale VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, immat VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, disponible VARCHAR(255) NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, INDEX IDX_292FFF1DBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule_couleur (vehicule_id INT NOT NULL, couleur_id INT NOT NULL, INDEX IDX_7E6F2C44A4A3511 (vehicule_id), INDEX IDX_7E6F2C4C31BA576 (couleur_id), PRIMARY KEY(vehicule_id, couleur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule_marque (vehicule_id INT NOT NULL, marque_id INT NOT NULL, INDEX IDX_DF3A78EE4A4A3511 (vehicule_id), INDEX IDX_DF3A78EE4827B9B2 (marque_id), PRIMARY KEY(vehicule_id, marque_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_marque ADD CONSTRAINT FK_DC493BF7BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_marque ADD CONSTRAINT FK_DC493BF74827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D94827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D94A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE vehicule_couleur ADD CONSTRAINT FK_7E6F2C44A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicule_couleur ADD CONSTRAINT FK_7E6F2C4C31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicule_marque ADD CONSTRAINT FK_DF3A78EE4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicule_marque ADD CONSTRAINT FK_DF3A78EE4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_marque DROP FOREIGN KEY FK_DC493BF7BCF5E72D');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9BCF5E72D');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DBCF5E72D');
        $this->addSql('ALTER TABLE vehicule_couleur DROP FOREIGN KEY FK_7E6F2C4C31BA576');
        $this->addSql('ALTER TABLE categorie_marque DROP FOREIGN KEY FK_DC493BF74827B9B2');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D94827B9B2');
        $this->addSql('ALTER TABLE vehicule_marque DROP FOREIGN KEY FK_DF3A78EE4827B9B2');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4A4A3511');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB4A4A3511');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D94A4A3511');
        $this->addSql('ALTER TABLE vehicule_couleur DROP FOREIGN KEY FK_7E6F2C44A4A3511');
        $this->addSql('ALTER TABLE vehicule_marque DROP FOREIGN KEY FK_DF3A78EE4A4A3511');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_marque');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE vehicule_couleur');
        $this->addSql('DROP TABLE vehicule_marque');
    }
}
