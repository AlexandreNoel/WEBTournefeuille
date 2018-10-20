
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
    Libelle VARCHAR NOT NULL
);

CREATE TABLE Utilisateur (
    idUser SERIAL PRIMARY KEY ,
    Pseudo VARCHAR NOT NULL UNIQUE,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    sodle INTEGER NOT NULL ,
    idRole INTEGER NOT NULL REFERENCES Role (idRole)
);

CREATE TABLE Barman(
    idUser SERIAL PRIMARY KEY REFERENCES Utilisateur(idUser),
    MotDePasse VARCHAR NOT NULL UNIQUE
);

CREATE TABLE Commande(
    idCommande SERIAL PRIMARY KEY,
    dateCommande TIMESTAMP default CURRENT_TIMESTAMP,
    idUser INTEGER NOT NULL REFERENCES Utilisateur (idUser)
);

CREATE TABLE Categorie(
    idCategorie SERIAL PRIMARY KEY,
    libelle VARCHAR NOT NULL
);

CREATE TABLE Produit(
    idProduit SERIAL PRIMARY KEY,
    libelle VARCHAR NOT NULL,
    prix INTEGER NOT NULL,
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
    Description VARCHAR NOT NULL,
    idAuthor INTEGER NOT NULL REFERENCES Utilisateur (idUser)
);

CREATE TABLE Vote(
    idUser SERIAL NOT NULL REFERENCES Utilisateur  (idUser),
    idNouveauProduit SERIAL NOT NULL REFERENCES NouveauProduit (idNouveauProduit),
    dateVote TIMESTAMP default CURRENT_TIMESTAMP,
    PRIMARY KEY (idUser, IdNouveauProduit)
);

CREATE TABLE Annonce (
    idAnnonce SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    body VARCHAR NOT NULL,
    idAuthor INTEGER NOT NULL REFERENCES Utilisateur (idUser)
);

INSERT INTO Role(idRole,Libelle) VALUES (1,'Admin');
INSERT INTO Role(idRole,Libelle) VALUES (2,'Barman');
INSERT INTO Role(idRole,Libelle) VALUES (3,'Client');
INSERT INTO Utilisateur(idUser,Pseudo,  firstname,lastname, sodle,idRole ) VALUES (1,'Gefclic', 'Benoit','SCHOLL','25','3');
INSERT INTO Utilisateur(idUser,Pseudo,  firstname,lastname, sodle,idRole ) VALUES (2,'Chap','Antoine','CHAPUZOT','25','2');
INSERT INTO Utilisateur(idUser,Pseudo,  firstname,lastname, sodle,idRole ) VALUES (3,'Théo', 'Théo','PEUCKVERT','25','2');
INSERT INTO Barman(idUser,MotDePasse) VALUES(2,'LaGuinessCestLaBase');
INSERT INTO Categorie(idCategorie,libelle) VALUES (1,'Boisson');
INSERT INTO Categorie(idCategorie,libelle) VALUES (2,'Friandise');
INSERT INTO Categorie(idCategorie,libelle) VALUES (3,'Snack');
INSERT INTO Categorie(idCategorie,libelle) VALUES (4,'Boissons Chaudes');
INSERT INTO Produit(idProduit,libelle,prix,quantiteStock,idCategorie) VALUES (1,'Coca',0.50,4,1);
INSERT INTO Produit(idProduit,libelle,prix,quantiteStock,idCategorie) VALUES (2,'Fanta',0.50,2,1);
INSERT INTO Produit(idProduit,libelle,prix,quantiteStock,idCategorie) VALUES (3,'Sprite',0.50,5,1);
INSERT INTO Produit(idProduit,libelle,prix,quantiteStock,idCategorie) VALUES (4,'Pizza ChouFleur',1.60,2,3);
INSERT INTO Produit(idProduit,libelle,prix,quantiteStock,idCategorie) VALUES (5,'Buns Flageolet',1.50,2,3);
INSERT INTO Produit(idProduit,libelle,prix,quantiteStock,idCategorie) VALUES (6,'Mars',0.50,2,2);
INSERT INTO Produit(idProduit,libelle,prix,quantiteStock,idCategorie) VALUES (7,'Kinder Bueno',0.50,2,2);
INSERT INTO Produit(idProduit,libelle,prix,quantiteStock,idCategorie) VALUES (8,'Cafe Fort',0.40,20,4);
INSERT INTO Produit(idProduit,libelle,prix,quantiteStock,idCategorie) VALUES (9,'Cafe leger',0.40,20,4);
INSERT INTO Produit(idProduit,libelle,prix,quantiteStock,idCategorie) VALUES (10,'Thé',0.40,20,4);
INSERT INTO Annonce(idAnnonce,title,body,idAuthor) VALUES (1,'Nouvelle Application','<h1>Merci aux FIPAS </h1><br><p>Grace au travail acharnée des FIPAS, le BarC devient le BarD et vous porpose une toute nouvelle application de gestion de votre compte</p>',3);
INSERT INTO NouveauProduit(idNouveauProduit,libelle,Description,idAuthor) VALUES (1,'RedBull','Pour avoir des ailes en allant en cours',1);