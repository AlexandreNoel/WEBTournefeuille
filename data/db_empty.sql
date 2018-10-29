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
);

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
