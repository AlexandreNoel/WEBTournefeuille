CREATE TABLE "Connexion" (
       id SERIAL PRIMARY KEY ,
       mail VARCHAR NOT NULL
       CHECK (mail LIKE '%@%.%'),
       mdp VARCHAR NOT NULL ,
);

CREATE TABE "Identite" (
       id SERIAL PRIMARY KEY,
       nom VARCHAR NOT NULL,
       prenom VARCHAR NOT NULL,
       ddn DATE NOT NULL
       CHECK (ddn>'2007-01-01'),
       sexe VARCHAR NOT NULL,
       telephone INTEGER(10),
);

CREATE TABLE "Localisation" (
       id SERIAL PRIMARY KEY,
       ville VARCHAR,
       pays VARCHAR,
),

CREATE TABLE "Commentaire" (
       id PRIMARY KEY,
       commentaire VARCHAR (300),
       reponse VARCHAR (6),
);

CREATE TABLE "Note" (
       id PRIMARY KEY,
       note INTEGER
       CHECK note <=20,
);
