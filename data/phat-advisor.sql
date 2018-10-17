--CREATE DATABASE phatadvisor;

------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Persons
------------------------------------------------------------
CREATE TABLE public.Persons(
	Id_User       INT  NOT NULL ,
	Nom_User      VARCHAR (25) NOT NULL ,
	Prenom_User   VARCHAR (25) NOT NULL ,
	Promo_User    INT  NOT NULL ,
	isAdmin       BOOL  NOT NULL ,
	Secret_User   VARCHAR (100) NOT NULL  ,
	CONSTRAINT Persons_PK PRIMARY KEY (Id_User)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Restos
------------------------------------------------------------
CREATE TABLE public.Restos(
	Id_Resto        INT  NOT NULL ,
	Nom_Resto       VARCHAR (25) NOT NULL ,
	Descr_Resto     VARCHAR (200) NOT NULL ,
	Addr_Resto      VARCHAR (100) NOT NULL ,
	CP_Resto        INT  NOT NULL ,
	Tel_Resto       INT  NOT NULL ,
	Website_Resto   VARCHAR (15) NOT NULL  ,
	CONSTRAINT Restos_PK PRIMARY KEY (Id_Resto)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Comments
------------------------------------------------------------
CREATE TABLE public.Comments(
	id_Comment        INT  NOT NULL ,
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
	id_Fav            INT  NOT NULL ,
	Id_Resto          INT  NOT NULL ,
	Id_User           INT  NOT NULL ,
	Id_User_Persons   INT  NOT NULL ,
	Id_Resto_Restos   INT  NOT NULL  ,
	CONSTRAINT Favoris_PK PRIMARY KEY (id_Fav)

	,CONSTRAINT Favoris_Persons_FK FOREIGN KEY (Id_User_Persons) REFERENCES public.Persons(Id_User)
	,CONSTRAINT Favoris_Restos0_FK FOREIGN KEY (Id_Resto_Restos) REFERENCES public.Restos(Id_Resto)
)WITHOUT OIDS;