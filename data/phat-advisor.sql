--CREATE DATABASE phatadvisor;

------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Persons
------------------------------------------------------------
CREATE TABLE public.Persons(

	Id_User       SERIAL ,
	Nom_User      VARCHAR (25) NOT NULL ,
	Prenom_User   VARCHAR (25) NOT NULL ,
	mail_User	  VARCHAR(40) NOT NULL,
	Promo_User    INT  NOT NULL ,
	isAdmin       BOOL  NOT NULL ,
	Secret_User   VARCHAR (100) NOT NULL  ,
	CONSTRAINT Persons_PK PRIMARY KEY (Id_User)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Restos
------------------------------------------------------------
CREATE TABLE public.Restos(
	Id_Resto        SERIAL ,
	Nom_Resto       VARCHAR (25) NOT NULL ,
	Descr_Resto     VARCHAR (200) NOT NULL ,
	Addr_Resto      VARCHAR (100) NOT NULL ,
	CP_Resto        INT  NOT NULL ,
	city_resto		VARCHAR(50) NOT NULL,
	Tel_Resto       VARCHAR(20) ,
	Website_Resto   VARCHAR (50) NOT NULL  ,
	isDeleted       BOOL  NOT NULL  ,

	CONSTRAINT Restos_PK PRIMARY KEY (Id_Resto)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Comments
------------------------------------------------------------
CREATE TABLE public.Comments(
	id_Comment        SERIAL ,
	Id_Resto          INT  NOT NULL ,
	Id_User           INT  NOT NULL ,
	Text_comment      VARCHAR (500) NOT NULL ,
	Date_comment      DATE  NOT NULL ,
	Id_User_Persons   INT  NOT NULL ,
	Id_Resto_Restos   INT  NOT NULL  ,
	CONSTRAINT Comments_PK PRIMARY KEY (id_Comment)

	,CONSTRAINT Comments_Persons_FK FOREIGN KEY (Id_User_Persons) REFERENCES public.Persons(Id_User)
	,CONSTRAINT Comments_Restos_FK FOREIGN KEY (Id_Resto_Restos) REFERENCES public.Restos(Id_Resto)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Favoris
------------------------------------------------------------
CREATE TABLE public.Favoris(
	id_Fav            SERIAL  ,
	Id_User_Persons   INT  NOT NULL ,
	Id_Resto_Restos   INT  NOT NULL  ,
	CONSTRAINT Favoris_PK PRIMARY KEY (id_Fav)

	,CONSTRAINT Favoris_Persons_FK FOREIGN KEY (Id_User_Persons) REFERENCES public.Persons(Id_User)
	,CONSTRAINT Favoris_Restos_FK FOREIGN KEY (Id_Resto_Restos) REFERENCES public.Restos(Id_Resto)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Categories
------------------------------------------------------------
CREATE TABLE public.Categories(
	id_Cat    SERIAL NOT NULL ,
	Nom_Cat   VARCHAR (30) NOT NULL  ,
	CONSTRAINT Categories_PK PRIMARY KEY (id_Cat)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Cat_Resto
------------------------------------------------------------
CREATE TABLE public.Cat_Resto(
	Id_Resto   INT  NOT NULL  ,
	id_Cat     INT  NOT NULL ,
	CONSTRAINT Cat_Resto_PK PRIMARY KEY (id_Cat,Id_Resto)

	,CONSTRAINT Cat_Resto_Categories_FK FOREIGN KEY (id_Cat) REFERENCES public.Categories(id_Cat)
	,CONSTRAINT Cat_Resto_Restos_FK FOREIGN KEY (Id_Resto) REFERENCES public.Restos(Id_Resto)
)WITHOUT OIDS;


---------------------------
-- Insertion des données
---------------------------

INSERT INTO restos
VALUES (
	DEFAULT,
	'The Noodles Shop',
	'Pâtes et nouilles asiatiques de différentes variétés',
	'3 Place Pierre Mendès France',	91000,'EVRY',
	'01 69 36 42 44','http://thenoodlesshop.fr/','0'
	);

INSERT INTO restos
VALUES (DEFAULT,
	'Paul Evry 2',
	'Pains traditionnels, sandwichs, pâtisseries et viennoiseries servis dans une chaîne française de boulangeries',
	'Centre Commercial EVRY2 2 Boulevard de l''Europe',91000,'EVRY',
	'01 64 97 86 62','http://thenoodlesshop.fr/','0'
	);

INSERT INTO restos
VALUES (
	DEFAULT,
	'Burger King Evry 2',
	'Chaîne réputée proposant hamburgers à la viande grillée, frites, 
	milk-shakes et petits-déjeuners',
	'172 Place des Terrasses de l''Agora',91000,'EVRY',
	'01 82 93 00 31','https://restaurants.burgerking.fr/evry-2','0'
	);

---------------------------
-- Insertion des catégories
---------------------------

INSERT INTO Categories VALUES (DEFAULT,'Bio');
INSERT INTO Categories VALUES (DEFAULT,'Hallal');
INSERT INTO Categories VALUES (DEFAULT,'Vegan');
INSERT INTO Categories VALUES (DEFAULT,'Fast Food');
INSERT INTO Categories VALUES (DEFAULT,'Asiatique');

---------------------------
-- Insertion des catégories des restaurants
---------------------------

INSERT INTO Cat_Resto VALUES (1,5);
INSERT INTO Cat_Resto VALUES (1,2);
INSERT INTO Cat_Resto VALUES (2,1);
INSERT INTO Cat_Resto VALUES (2,3);
INSERT INTO Cat_Resto VALUES (3,4);


---------------------------
-- Insertion des utilisateurs
---------------------------
INSERT INTO persons VALUES (DEFAULT,'admin_lastname','admin_firstname','admin@mail.com',2020,'1',md5('admin_secret'));
INSERT INTO persons VALUES (DEFAULT,'user_lastname','user_firstname','user@mail.com',2021,'0',md5('user_secret'));
