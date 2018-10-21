
DROP TABLE IF EXISTS Annonce;
DROP TABLE IF EXISTS Vote;
DROP TABLE IF EXISTS NouveauProduit;
DROP TABLE IF EXISTS FaitPartieCommande;
DROP TABLE IF EXISTS Produit;
DROP TABLE IF EXISTS Barman;
DROP TABLE IF EXISTS Categorie;
DROP TABLE IF EXISTS Commande;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Role;

CREATE TABLE Role (
    idRole SERIAL PRIMARY KEY ,
    libelle VARCHAR NOT NULL
);

CREATE TABLE Utilisateur (
    idUtilisateur SERIAL PRIMARY KEY ,
    pseudo VARCHAR NOT NULL UNIQUE,
    prenom VARCHAR NOT NULL ,
    nom VARCHAR NOT NULL ,
    solde INTEGER NOT NULL ,
    idRole INTEGER NOT NULL REFERENCES Role (idRole)
);

CREATE TABLE Barman(
    idUtilisateur SERIAL PRIMARY KEY REFERENCES Utilisateur(idUtilisateur),
    MotDePasse VARCHAR NOT NULL UNIQUE
);

CREATE TABLE Commande(
    idCommande SERIAL PRIMARY KEY,
    dateCommande TIMESTAMP default CURRENT_TIMESTAMP,
    idUtilisateur INTEGER NOT NULL REFERENCES Utilisateur (idUtilisateur)
);

CREATE TABLE Categorie(
    idCategorie SERIAL PRIMARY KEY,
    libelle VARCHAR NOT NULL
);

CREATE TABLE Produit(
    idProduit SERIAL PRIMARY KEY,
    libelle VARCHAR NOT NULL,
    prix INTEGER NOT NULL,
    reduction INTEGER NOT NULL,
    quantiteStock INTEGER NOT NULL,
    idCategorie INTEGER NOT NULL REFERENCES Categorie (idCategorie)
);

CREATE TABLE FaitPartieCommande(
    idProduit SERIAL NOT NULL REFERENCES Produit (idProduit),
    idCommande SERIAL NOT NULL REFERENCES Commande (idCommande),
    prixVente INTEGER NOT NULL,
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
    idAuteur INTEGER NOT NULL REFERENCES Utilisateur (idUtilisateur)
);

INSERT INTO Role(idRole,libelle) VALUES (1,'Admin');
INSERT INTO Role(idRole,libelle) VALUES (2,'Barman');
INSERT INTO Role(idRole,libelle) VALUES (3,'Client');
INSERT INTO Utilisateur(idUtilisateur,pseudo,  prenom,nom, solde,idRole ) VALUES (1,'Gefclic', 'Benoit','SCHOLL','25','3');
INSERT INTO Utilisateur(idUtilisateur,pseudo,  prenom,nom, solde,idRole ) VALUES (2,'Chap','Antoine','CHAPUZOT','25','2');
INSERT INTO Utilisateur(idUtilisateur,pseudo,  prenom,nom, solde,idRole ) VALUES (3,'Théo', 'Théo','PEUCKVERT','25','2');
INSERT INTO Barman(idUtilisateur,MotDePasse) VALUES(2,'LaGuinessCestLaBase');
INSERT INTO Categorie(idCategorie,libelle) VALUES (1,'Boisson');
INSERT INTO Categorie(idCategorie,libelle) VALUES (2,'Friandise');
INSERT INTO Categorie(idCategorie,libelle) VALUES (3,'Snack');
INSERT INTO Categorie(idCategorie,libelle) VALUES (4,'Boissons Chaudes');
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,idCategorie) VALUES ('Coca',0.50,0,4,1);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,idCategorie) VALUES ('Fanta',0.50,0,2,1);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,idCategorie) VALUES ('Sprite',0.50,0,5,1);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,idCategorie) VALUES ('Pizza ChouFleur',1.60,0,2,3);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,idCategorie) VALUES ('Buns Flageolet',1.50,0,2,3);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,idCategorie) VALUES ('Mars',0.50,0,2,2);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,idCategorie) VALUES ('Kinder Bueno',0.50,0,2,2);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,idCategorie) VALUES ('Cafe Fort',0.40,0,20,4);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,idCategorie) VALUES ('Cafe leger',0.40,0,20,4);
INSERT INTO Produit(libelle,prix,reduction,quantiteStock,idCategorie) VALUES ('Thé',0.40,0,20,4);
INSERT INTO Annonce(idAnnonce,titre,contenu,idAuteur) VALUES (1,'Nouvelle Application','<h1>Merci aux FIPAS </h1><br><p>Grace au travail acharnée des FIPAS, le BarC devient le BarD et vous porpose une toute nouvelle application de gestion de votre compte</p>',3);
INSERT INTO NouveauProduit(idNouveauProduit,libelle,Description,idAuteur) VALUES (1,'RedBull','Pour avoir des ailes en allant en cours',1);
