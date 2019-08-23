<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190223092206 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ligne_commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fournisseur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stock_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vente_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE entree_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sortie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, name VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ligne_commande (id INT NOT NULL, article_id INT NOT NULL, numero_commande_id INT DEFAULT NULL, quantite INT NOT NULL, prix_vente DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3170B74B7294869C ON ligne_commande (article_id)');
        $this->addSql('CREATE INDEX IDX_3170B74BCD55219B ON ligne_commande (numero_commande_id)');
        $this->addSql('CREATE TABLE fournisseur (id INT NOT NULL, name VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, pays VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE stock (id INT NOT NULL, article_id INT DEFAULT NULL, quantite INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4B3656607294869C ON stock (article_id)');
        $this->addSql('CREATE TABLE vente (id INT NOT NULL, article_id INT NOT NULL, date_vente TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_888A2A4C7294869C ON vente (article_id)');
        $this->addSql('CREATE TABLE entree (id INT NOT NULL, quantite INT NOT NULL, prix_entre DOUBLE PRECISION NOT NULL, date_entre TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, employe INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE commande (id INT NOT NULL, client_id INT DEFAULT NULL, date_livraison TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, etat BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6EEAA67D19EB6921 ON commande (client_id)');
        $this->addSql('CREATE TABLE article (id INT NOT NULL, fournisseur_id INT NOT NULL, libele VARCHAR(255) NOT NULL, quantite INT NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_23A0E66670C757F ON article (fournisseur_id)');
        $this->addSql('CREATE TABLE sortie (id INT NOT NULL, article_id INT DEFAULT NULL, quantite INT NOT NULL, prix_vente DOUBLE PRECISION NOT NULL, date_sortie TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, employe INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3C3FD3F27294869C ON sortie (article_id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B7294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BCD55219B FOREIGN KEY (numero_commande_id) REFERENCES commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656607294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C7294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F27294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ALTER on_line DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66670C757F');
        $this->addSql('ALTER TABLE ligne_commande DROP CONSTRAINT FK_3170B74BCD55219B');
        $this->addSql('ALTER TABLE ligne_commande DROP CONSTRAINT FK_3170B74B7294869C');
        $this->addSql('ALTER TABLE stock DROP CONSTRAINT FK_4B3656607294869C');
        $this->addSql('ALTER TABLE vente DROP CONSTRAINT FK_888A2A4C7294869C');
        $this->addSql('ALTER TABLE sortie DROP CONSTRAINT FK_3C3FD3F27294869C');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ligne_commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fournisseur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stock_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vente_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE entree_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sortie_id_seq CASCADE');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP TABLE entree');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE sortie');
        $this->addSql('ALTER TABLE post ALTER on_line SET DEFAULT \'false\'');
    }
}
