--CREATE DATABASE phatadvisor;

------------------------------------------------------------
--        Script Postgres
------------------------------------------------------------

CREATE EXTENSION pgcrypto;

------------------------------------------------------------
-- Table: Persons
------------------------------------------------------------
CREATE TABLE public.Persons(

	Id_User       SERIAL NOT NULL,
	Nom_User      VARCHAR (25) NOT NULL ,
	Prenom_User   VARCHAR (25) NOT NULL ,
	mail_User	  VARCHAR(40) NOT NULL,
	Promo_User    INT  NOT NULL ,
	isAdmin       BOOL  NOT NULL ,
	Secret_User   VARCHAR (100) NOT NULL  ,
	CONSTRAINT Persons_PK PRIMARY KEY (Id_User),
	CONSTRAINT UC_Persons UNIQUE (mail_User)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Restos
------------------------------------------------------------
CREATE TABLE public.Restos(
	Id_Resto        SERIAL NOT NULL,
	Nom_Resto       VARCHAR (25) NOT NULL ,
	Descr_Resto     VARCHAR (200) NOT NULL ,
	Addr_Resto      VARCHAR (100) NOT NULL ,
	CP_Resto        INT  NOT NULL ,
	city_resto		VARCHAR(50) NOT NULL,
	Tel_Resto       VARCHAR(20),
	Website_Resto   VARCHAR(200),
	isDeleted       BOOL  NOT NULL  ,
	thumbnail		VARCHAR(100) ,
	score         INT NOT NULL DEFAULT 0,

	CONSTRAINT Restos_PK PRIMARY KEY (Id_Resto)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Comments
------------------------------------------------------------
CREATE TABLE public.Comments(
	id_Comment        SERIAL NOT NULL,
	Text_comment      VARCHAR (500) NOT NULL ,
	Date_comment      TIMESTAMP  NOT NULL ,
	Id_User_Persons   INT  NOT NULL ,
	Id_Resto_Restos   INT  NOT NULL ,
	Note_Resto INT NOT NULL
	,CONSTRAINT Comments_PK PRIMARY KEY (id_Comment)
	,CONSTRAINT Comments_Persons_FK FOREIGN KEY (Id_User_Persons) REFERENCES public.Persons(Id_User)
	,CONSTRAINT Comments_Restos_FK FOREIGN KEY (Id_Resto_Restos) REFERENCES public.Restos(Id_Resto)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Favoris
------------------------------------------------------------
CREATE TABLE public.Favoris(
	id_Fav            SERIAL NOT NULL ,
	Id_User_Persons   INT  NOT NULL ,
	Id_Resto_Restos   INT  NOT NULL
	,CONSTRAINT Favoris_PK PRIMARY KEY (id_Fav)
	,CONSTRAINT Favoris_Persons_FK FOREIGN KEY (Id_User_Persons) REFERENCES public.Persons(Id_User)
	,CONSTRAINT Favoris_Restos_FK FOREIGN KEY (Id_Resto_Restos) REFERENCES public.Restos(Id_Resto)
	,CONSTRAINT UC_Favoris UNIQUE (Id_User_Persons,Id_Resto_Restos)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Categories
------------------------------------------------------------
CREATE TABLE public.Categories(
	id_Cat    SERIAL NOT NULL ,
	Nom_Cat   VARCHAR (30) NOT NULL  ,
	Cat_link   VARCHAR (30) ,
	CONSTRAINT Categories_PK PRIMARY KEY (id_Cat)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Cat_Resto
------------------------------------------------------------
CREATE TABLE public.Cat_Resto(
	Id_Resto   INT  NOT NULL ,
	id_Cat     INT  NOT NULL ,
	CONSTRAINT Cat_Resto_PK PRIMARY KEY (id_Cat,Id_Resto)
	,CONSTRAINT Cat_Resto_Categories_FK FOREIGN KEY (id_Cat) REFERENCES public.Categories(id_Cat)
	,CONSTRAINT Cat_Resto_Restos_FK FOREIGN KEY (Id_Resto) REFERENCES public.Restos(Id_Resto)
	,CONSTRAINT UC_Cat_Resto UNIQUE (Id_Resto,id_Cat)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Badge
------------------------------------------------------------
CREATE TABLE public.Badge(
	id_Badge    SERIAL NOT NULL ,
	Nom_Badge   VARCHAR (30) NOT NULL ,
	Badge_link	VARCHAR (30),
	CONSTRAINT Badge_PK PRIMARY KEY (id_Badge)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Badge_Resto
------------------------------------------------------------
CREATE TABLE public.Badge_Resto(
	Id_Resto   INT  NOT NULL ,
	id_Badge   INT  NOT NULL  ,
	CONSTRAINT Badge_Resto_PK PRIMARY KEY (Id_Resto,id_Badge)
	,CONSTRAINT UC_Cat_Resto UNIQUE (Id_Resto,id_Badge)
	,CONSTRAINT Badge_Resto_Restos_FK FOREIGN KEY (Id_Resto) REFERENCES public.Restos(Id_Resto)
	,CONSTRAINT Badge_Resto_Badge0_FK FOREIGN KEY (id_Badge) REFERENCES public.Badge(id_Badge)
)WITHOUT OIDS;

/*------------------------------------------------------------
-- Table: Score
------------------------------------------------------------
CREATE TABLE public.Score(
	id_Score          SERIAL NOT NULL ,
	Id_Resto_Restos   INT  NOT NULL  ,
	Score             INT  NOT NULL ,
	CONSTRAINT Score_PK PRIMARY KEY (id_Score)
	,CONSTRAINT Score_Restos_FK FOREIGN KEY (Id_Resto_Restos) REFERENCES public.Restos(Id_Resto)
)WITHOUT OIDS;*/

---------------------------
-- Insertion des données
---------------------------

INSERT INTO restos
VALUES (
	DEFAULT,
	'The Noodles Shop',
	'Pâtes et nouilles asiatiques de différentes variétés',
	'3 Place Pierre Mendès France',	91000,'EVRY',
	'01 69 36 42 44','http://thenoodlesshop.fr/','0','http://www.thenoodlesshop.fr/images/logo.png'
	);

INSERT INTO restos
VALUES (DEFAULT,
	'Paul Evry 2',
	'Pains traditionnels, sandwichs, pâtisseries et viennoiseries servis dans une chaîne française de boulangeries',
	'Centre Commercial EVRY2 2 Boulevard de l''Europe',91000,'EVRY',
	'01 64 97 86 62','http://thenoodlesshop.fr/','0','https://upload.wikimedia.org/wikipedia/commons/0/0f/Logo_Paul.png'
	);

INSERT INTO restos
VALUES (
	DEFAULT,
	'Burger King Evry 2',
	'Chaîne réputée proposant hamburgers à la viande grillée, frites, 
	milk-shakes et petits-déjeuners',
	'172 Place des Terrasses de l''Agora',91000,'EVRY',
	'01 82 93 00 31','https://restaurants.burgerking.fr/evry-2','0','https://upload.wikimedia.org/wikipedia/fr/d/d4/Burger_King.svg'
	);
	INSERT INTO restos
VALUES
	(
		DEFAULT,
		'The Waffle Factory',
		'Waffle Factory réinvente la gaufre en proposant un concept innovant de restauration',
		'2 Boulevard de l''Europe', 91000, 'EVRY',
		'01 82 93 00 31', 'http://evry2.wafflefactory.com/', '0', 'http://evry2.wafflefactory.com/wp-content/uploads/2017/03/Capture-d’écran-2017-03-14-à-15.19.06.png'
	);

---------------------------
-- Insertion des catégories
---------------------------

INSERT INTO Categories VALUES (DEFAULT,'Asiatique','asiatique.png');
INSERT INTO Categories VALUES (DEFAULT,'Pizza','pizza.png');
INSERT INTO Categories VALUES (DEFAULT,'Salade','salade.png');
INSERT INTO Categories VALUES (DEFAULT,'Japonais','sushi.png');
INSERT INTO Categories VALUES (DEFAULT,'Burger','burger.png');
INSERT INTO Categories VALUES (DEFAULT,'Poulet','bucket.png');
INSERT INTO Categories VALUES (DEFAULT,'Coreen');
INSERT INTO Categories VALUES (DEFAULT,'Restaurant');
INSERT INTO Categories VALUES (DEFAULT,'Sandwich');
INSERT INTO Categories VALUES (DEFAULT,'Tacos');
INSERT INTO Categories VALUES (DEFAULT,'Gauffre');
---------------------------
-- Insertion des catégories des restaurants
---------------------------

INSERT INTO Cat_Resto VALUES (1,1);
INSERT INTO Cat_Resto VALUES (2,9);
INSERT INTO Cat_Resto VALUES (3,5);
INSERT INTO Cat_Resto VALUES (4,11);

---------------------------
-- Insertion des badges
---------------------------

INSERT INTO Badge VALUES (DEFAULT,'Bio', NULL);
INSERT INTO Badge VALUES (DEFAULT,'Halal','badge-halal.png');
INSERT INTO Badge VALUES (DEFAULT,'Vegan','badge-vegetarien.png');
INSERT INTO Badge VALUES (DEFAULT,'Partenariat','badge-partenariat.png');
INSERT INTO Badge VALUES (DEFAULT,'Livraison','badge-livraison.png');
INSERT INTO Badge VALUES (DEFAULT,'A emporter','badge-emporter.png');
INSERT INTO Badge VALUES (DEFAULT,'Commander','badge-commander.png');

---------------------------
-- Insertion des badges des restaurants
---------------------------
INSERT INTO Badge_Resto VALUES (1,4);
INSERT INTO Badge_Resto VALUES (1,5);
INSERT INTO Badge_Resto VALUES (1,6);
INSERT INTO Badge_Resto VALUES (2,3);
INSERT INTO Badge_Resto VALUES (2,6);
INSERT INTO Badge_Resto VALUES (3,5);
INSERT INTO Badge_Resto VALUES (3,6);
INSERT INTO Badge_Resto VALUES (4,5);
INSERT INTO Badge_Resto VALUES (4,6);

---------------------------
-- Insertion des utilisateurs
---------------------------
INSERT INTO persons VALUES (DEFAULT,'admin_lastname','admin_firstname','admin@mail.com',2020,'1',crypt('admin_secret',gen_salt('bf',8)));
INSERT INTO persons VALUES (DEFAULT,'user_lastname','user_firstname','user@mail.com',2021,'0',crypt('user_secret',gen_salt('bf',8)));

---------------------------
-- Trigger de gestion des notes
---------------------------
CREATE FUNCTION after_insert_comment () RETURNS TRIGGER AS 
'
  DECLARE
    noteSum INTEGER;
    notefin INTEGER;
    nbnote INTEGER;
  BEGIN
    SELECT INTO nbnote count(*) FROM Comments WHERE Comments.Id_Resto_Restos=NEW.Id_Resto_Restos;
    IF nbnote != 0 THEN
      SELECT INTO noteSum sum(note_resto) FROM Comments WHERE Comments.Id_Resto_Restos=NEW.Id_Resto_Restos;
      notefin:=noteSum/nbnote;
      UPDATE restos SET score = notefin WHERE restos.id_resto = NEW.Id_Resto_Restos;
    END IF;
    RETURN NEW;
  END; 
' 
LANGUAGE 'plpgsql'; 

CREATE TRIGGER trig_ins_comment AFTER INSERT ON Comments 
  FOR EACH ROW 
  EXECUTE PROCEDURE after_insert_comment();
  
  
CREATE FUNCTION after_delete_comment () RETURNS TRIGGER AS
'
  DECLARE
    noteSum INTEGER;
    notefin INTEGER;
    nbnote INTEGER;
  BEGIN
    SELECT INTO nbnote count(*) FROM Comments WHERE Comments.Id_Resto_Restos=OLD.Id_Resto_Restos;

    IF nbnote != 0 THEN
     SELECT INTO noteSum sum(note_resto) FROM Comments WHERE Comments.Id_Resto_Restos=OLD.Id_Resto_Restos;
      notefin:=noteSum/nbnote;
    ELSE
      notefin = 0;
    END IF;

    UPDATE restos SET score = notefin WHERE restos.id_resto = OLD.Id_Resto_Restos;

    RETURN OLD;
  END; 
' 
LANGUAGE 'plpgsql'; 

CREATE TRIGGER trig_del_comment AFTER DELETE ON Comments
  FOR EACH ROW 
  EXECUTE PROCEDURE after_delete_comment();



---------------------------
-- Insertion des commentaires
---------------------------
INSERT INTO Comments VALUES (DEFAULT,'Bon mais il y avait un peu d''attente....','05/10/2018',1,2,4);
insert into comments values(default, 'De la merde, je n''ai pas l''intention de revenir', '01/01/95',2,2,2);
insert into comments values(default, 'Excellent, meilleur repas de ma vie', '01/01/95',1,1,5);
