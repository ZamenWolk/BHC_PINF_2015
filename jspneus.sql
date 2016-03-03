#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        user_id         int (11) Auto_increment  NOT NULL ,
        user_nom        Varchar (50) NOT NULL ,
        user_prenom     Varchar (50) NOT NULL ,
        user_mail       Varchar (50) NOT NULL ,
        user_password   Varchar (128) NOT NULL ,
        user_newsletter Bool NOT NULL ,
        PRIMARY KEY (user_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: adresse
#------------------------------------------------------------

CREATE TABLE adresse(
        adresse_id     int (11) Auto_increment  NOT NULL ,
        adresse_ligne1 Varchar (255) NOT NULL ,
        adresse_ligne2 Varchar (255) NOT NULL ,
        adresse_codeP  Int NOT NULL ,
        adresse_ville  Varchar (75) NOT NULL ,
        user_id        Int NOT NULL ,
        PRIMARY KEY (adresse_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commande
#------------------------------------------------------------

CREATE TABLE commande(
        commande_id   int (11) Auto_increment  NOT NULL ,
        commande_date TimeStamp NOT NULL ,
        adresse_id    Int NOT NULL ,
        adresse_id_1  Int NOT NULL ,
        PRIMARY KEY (commande_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: pneu
#------------------------------------------------------------

CREATE TABLE pneu(
        pneu_ean                Varchar (25) ,
        pneu_ref                Varchar (50) NOT NULL ,
        pneu_marque             Varchar (50) ,
        pneu_categorie          Varchar (50) ,
        pneu_description        Varchar (150) ,
        pneu_largeur            Int ,
        pneu_serie              Int ,
        pneu_jante              Int ,
        pneu_charge             Varchar (15) ,
        pneu_vitesse            Char (1) ,
        pneu_profil             Varchar (150) ,
        pneu_decibel            Int ,
        pneu_bruit              Int ,
        pneu_consommation       Char (1) ,
        pneu_adherance          Char (1) ,
        pneu_categorieEtiquette Char (2) ,
        pneu_stock              Int ,
        pneu_prix               Int ,
        pneu_dateAjoutBDD       Datetime NOT NULL ,
        pneu_derniereVersion    Bool NOT NULL ,
        pneu_valable            Bool NOT NULL ,
        PRIMARY KEY (pneu_ref ,pneu_dateAjoutBDD )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: admin
#------------------------------------------------------------

CREATE TABLE admin(
        admin_id            int (11) Auto_increment  NOT NULL ,
        admin_name          Varchar (30) NOT NULL ,
        admin_pass          Varchar (128) NOT NULL ,
        admin_autorisations Varchar (65000) NOT NULL ,
        PRIMARY KEY (admin_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: config
#------------------------------------------------------------

CREATE TABLE config(
        config_ratio_prix Int NOT NULL ,
        PRIMARY KEY (config_ratio_prix )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: recuperation
#------------------------------------------------------------

CREATE TABLE recuperation(
        recuperation_id         int (11) Auto_increment  NOT NULL ,
        recuperation_token      Char (32) NOT NULL ,
        recuperation_utilise    Bool NOT NULL ,
        recuperation_dateLimite Datetime NOT NULL ,
        user_id                 Int NOT NULL ,
        PRIMARY KEY (recuperation_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: fait partie
#------------------------------------------------------------

CREATE TABLE fait_partie(
        quantite          Int NOT NULL ,
        pneu_ref          Varchar (50) NOT NULL ,
        pneu_dateAjoutBDD Datetime NOT NULL ,
        commande_id       Int NOT NULL ,
        PRIMARY KEY (pneu_ref ,pneu_dateAjoutBDD ,commande_id )
)ENGINE=InnoDB;

ALTER TABLE adresse ADD CONSTRAINT FK_adresse_user_id FOREIGN KEY (user_id) REFERENCES user(user_id);
ALTER TABLE commande ADD CONSTRAINT FK_commande_adresse_id FOREIGN KEY (adresse_id) REFERENCES adresse(adresse_id);
ALTER TABLE commande ADD CONSTRAINT FK_commande_adresse_id_1 FOREIGN KEY (adresse_id_1) REFERENCES adresse(adresse_id);
ALTER TABLE recuperation ADD CONSTRAINT FK_recuperation_user_id FOREIGN KEY (user_id) REFERENCES user(user_id);
ALTER TABLE fait_partie ADD CONSTRAINT FK_fait_partie_pneu_ref FOREIGN KEY (pneu_ref) REFERENCES pneu(pneu_ref);
ALTER TABLE fait_partie ADD CONSTRAINT FK_fait_partie_pneu_dateAjoutBDD FOREIGN KEY (pneu_dateAjoutBDD) REFERENCES pneu(pneu_dateAjoutBDD);
ALTER TABLE fait_partie ADD CONSTRAINT FK_fait_partie_commande_id FOREIGN KEY (commande_id) REFERENCES commande(commande_id);
