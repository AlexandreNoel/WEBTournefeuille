------------------------------------
-- Suppression préventive des tables
------------------------------------
DROP TABLE IF EXISTS Annonce;
DROP TABLE IF EXISTS Vote;
DROP TABLE IF EXISTS NouveauProduit;
DROP TABLE IF EXISTS FaitPartieCommande;
DROP TABLE IF EXISTS Produit;
DROP TABLE IF EXISTS Barmen;
DROP TABLE IF EXISTS Categorie;
DROP TABLE IF EXISTS Commande;
DROP TABLE IF EXISTS Utilisateur;

------------------------------------
-- Création des rôles
------------------------------------

CREATE TABLE Utilisateur (
    idUtilisateur SERIAL PRIMARY KEY ,
    pseudo VARCHAR NOT NULL UNIQUE,
    prenom VARCHAR NOT NULL ,
    nom VARCHAR NOT NULL ,
    solde INTEGER NOT NULL
);

CREATE TABLE Barmen(
    idUtilisateur SERIAL PRIMARY KEY REFERENCES Utilisateur(idUtilisateur) ON DELETE CASCADE,
    Codebarmen VARCHAR NOT NULL UNIQUE
);

CREATE TABLE Commande(
    idCommande SERIAL PRIMARY KEY,
    dateCommande TIMESTAMP default CURRENT_TIMESTAMP,
    idUtilisateur INTEGER NOT NULL REFERENCES Utilisateur (idUtilisateur),
    idBarmen INTEGER NOT NULL REFERENCES Utilisateur (idUtilisateur),
    prixTotal FLOAT NOT NULL
);

CREATE TABLE Categorie(
    idCategorie SERIAL PRIMARY KEY,
    libelle VARCHAR NOT NULL
);

CREATE TABLE Produit(
    idProduit SERIAL PRIMARY KEY,
    libelle VARCHAR NOT NULL,
    prix FLOAT NOT NULL,
    reduction FLOAT NOT NULL,
    quantiteStock INTEGER NOT NULL,
    estDisponible Bool NOT NULL,
    idCategorie INTEGER NOT NULL REFERENCES Categorie (idCategorie)
);

CREATE TABLE PreferenceUtilisateur(
    idUtilisateur SERIAL NOT NULL REFERENCES Utilisateur (idUtilisateur),
    idProduit SERIAL NOT NULL REFERENCES Produit (idProduit),
    indicePreference INTEGER NOT NULL,
    PRIMARY KEY (idUtilisateur,idProduit)
)

CREATE TABLE FaitPartieCommande(
    idProduit SERIAL NOT NULL REFERENCES Produit (idProduit),
    idCommande SERIAL NOT NULL REFERENCES Commande (idCommande),
    prixVente FLOAT NOT NULL,
    quantite INTEGER NOT NULL,
    PRIMARY KEY (idProduit, idCommande)
);


CREATE TABLE NouveauProduit(
    idNouveauProduit SERIAL PRIMARY KEY,
    libelle VARCHAR NOT NULL,
    description VARCHAR NOT NULL,
    idAuteur INTEGER NOT NULL REFERENCES Utilisateur (idUtilisateur)
);

CREATE TABLE Vote(
    idUtilisateur SERIAL NOT NULL REFERENCES Utilisateur  (idUtilisateur),
    idNouveauProduit SERIAL NOT NULL REFERENCES NouveauProduit (idNouveauProduit),
    dateVote TIMESTAMP default CURRENT_TIMESTAMP,
    PRIMARY KEY (idUtilisateur, IdNouveauProduit)
);

CREATE TABLE Annonce (
    idAnnonce SERIAL PRIMARY KEY,
    titre VARCHAR NOT NULL,
    contenu VARCHAR NOT NULL,
    idAuteur INTEGER NOT NULL REFERENCES Utilisateur (idUtilisateur),
    dateCreation date not null default CURRENT_DATE
);


--------------------------------------------------
-- INSERTION DES DONNEES
--------------------------------------------------


-- Table Utilisateur
INSERT INTO Utilisateur(idUtilisateur,pseudo,  prenom,nom, solde ) VALUES (1,'GEFCLIC', 'Benoit','SCHOLL','25');
INSERT INTO Utilisateur(idUtilisateur,pseudo,  prenom,nom, solde ) VALUES (2,'CHAP','Antoine','CHAPUSOT','25');
INSERT INTO Utilisateur(idUtilisateur,pseudo,  prenom,nom, solde ) VALUES (3,'TOAST', 'Théo','PEUCKERT','25');

SELECT setval('utilisateur_idutilisateur_seq', 3, true);

--Table Barman
INSERT INTO Barmen(idUtilisateur,Codebarmen) VALUES(2,'LaGuinessCestLaBase');

-- Table Categorie
INSERT INTO Categorie(idCategorie,libelle) VALUES (1,'Boisson');
INSERT INTO Categorie(idCategorie,libelle) VALUES (2,'Friandise');
INSERT INTO Categorie(idCategorie,libelle) VALUES (3,'Snack');
INSERT INTO Categorie(idCategorie,libelle) VALUES (4,'Boissons Chaudes');

-- Table Produit
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,estDisponible,idCategorie) VALUES ('Coca',0.50,0,4,TRUE,1);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,estDisponible,idCategorie) VALUES ('Fanta',0.50,0,2,TRUE,1);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,estDisponible,idCategorie) VALUES ('Sprite',0.50,0,5,TRUE,1);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,estDisponible,idCategorie) VALUES ('Pizza ChouFleur',1.60,0,2,TRUE,3);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,estDisponible,idCategorie) VALUES ('Buns Flageolet',1.50,0,2,TRUE,3);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,estDisponible,idCategorie) VALUES ('Mars',0.50,0,2,TRUE,2);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,estDisponible,idCategorie) VALUES ('Kinder Bueno',0.50,0,2,TRUE,2);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,estDisponible,idCategorie) VALUES ('Cafe Fort',0.40,0,20,TRUE,4);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,estDisponible,idCategorie) VALUES ('Cafe leger',0.40,0,20,TRUE,4);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,estDisponible,idCategorie) VALUES ('Thé',0.40,0,20,TRUE,4);

-- Table PreferenceUtilisateur
INSERT INTO PreferenceUtilisateur (idUtilisateur,idProduit,indicePreference) VALUES (1,1,1);

-- Table Annonce
INSERT INTO Annonce(titre,contenu,idAuteur,dateCreation) VALUES ('Nouvelle Application','<h1>Merci aux FIPAS </h1><br><p>Grace au travail acharnée des FIPAS, le BarC devient le BarD et vous porpose une toute nouvelle application de gestion de votre compte</p>',3,'01/01/2018');
INSERT INTO Annonce(titre,contenu,idAuteur,dateCreation) VALUES ('Nouvelle Application','<h1>Merci aux FIPAS </h1><br><p>Grace au travail acharnée des FIPAS, le BarC devient le BarD et vous porpose une toute nouvelle application de gestion de votre compte</p>',3,'01/01/2018');
INSERT INTO Annonce(titre,contenu,idAuteur,dateCreation) VALUES ('Nouvelle Application','<h1>Merci aux FIPAS </h1><br><p>Grace au travail acharnée des FIPAS, le BarC devient le BarD et vous porpose une toute nouvelle application de gestion de votre compte</p>',3,'01/01/2018');

-- Table NouveauProduit
INSERT INTO NouveauProduit(idNouveauProduit,libelle,Description,idAuteur) VALUES (1,'RedBull','Pour avoir des ailes en allant en cours',1);

-- Table Commande
INSERT INTO Commande ( dateCommande, idUtilisateur, idBarmen,prixTotal) VALUES (current_date,1,2,42);
-- Table FaitPartieCommande
INSERT INTO FaitPartieCommande (idProduit, idCommande, prixVente, quantite) VALUES (1,1,1,84);