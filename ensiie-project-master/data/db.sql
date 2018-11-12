CREATE TABLE public.UserF(
	Id         SERIAL PRIMARY KEY  ,
	NameU       VARCHAR (50) NOT NULL ,
	PasswordP   VARCHAR (50) NOT NULL,
	LastName   VARCHAR (50) NOT NULL ,
	Username   VARCHAR (50) NOT NULL ,
	Mail       VARCHAR (50) NOT NULL
)WITHOUT OIDS;
 
CREATE TABLE public.Child(
	IdChild   SERIAL PRIMARY KEY 
)WITHOUT OIDS;

CREATE TABLE public.Parent(
	IdParent   SERIAL  PRIMARY KEY
)WITHOUT OIDS;

CREATE TABLE public.Food(
	IdFood      SERIAL PRIMARY KEY ,
	NameF        VARCHAR (200) NOT NULL ,
	Typet        VARCHAR (20) NOT NULL ,
	Price       FLOAT  NOT NULL ,
	Quantity    INT  NOT NULL ,
	CodeBarre   BIGINT  NOT NULL  ,
	ExpirationDate DATE
)WITHOUT OIDS;


CREATE TABLE public.Buffet(
	IdBuffet   SERIAL PRIMARY KEY 
)WITHOUT OIDS;

CREATE TABLE public.Fridge(
	IdFridge      SERIAL PRIMARY KEY  ,
	DateOfClean   DATE  NOT NULL 
)WITHOUT OIDS;

CREATE TABLE public.Is(
	IdChild   INT  NOT NULL ,
	Id        INT  NOT NULL  ,
	CONSTRAINT Is_PK PRIMARY KEY (IdChild,Id)

	,CONSTRAINT Is_Child_FK FOREIGN KEY (IdChild) REFERENCES public.Child(IdChild)
	,CONSTRAINT Is_UserF0_FK FOREIGN KEY (Id) REFERENCES public.UserF(Id)
)WITHOUT OIDS;

CREATE TABLE public.Can_be(
	IdParent   INT  NOT NULL ,
	Id         INT  NOT NULL  ,
	CONSTRAINT Can_be_PK PRIMARY KEY (IdParent,Id)
	,CONSTRAINT Can_be_Parent_FK FOREIGN KEY (IdParent) REFERENCES public.Parent(IdParent)
	,CONSTRAINT Can_be_UserF0_FK FOREIGN KEY (Id) REFERENCES public.UserF(Id)
)WITHOUT OIDS;

CREATE TABLE public.Consumed(
	IdFood   INT  NOT NULL ,
	Id       INT  NOT NULL  ,
	CONSTRAINT Consumed_PK PRIMARY KEY (IdFood,Id)

	,CONSTRAINT Consumed_Food_FK FOREIGN KEY (IdFood) REFERENCES public.Food(IdFood)
	,CONSTRAINT Consumed_UserF0_FK FOREIGN KEY (Id) REFERENCES public.UserF(Id)
)WITHOUT OIDS;

CREATE TABLE public.Watch(
	IdFood   INT  NOT NULL ,
	Id       INT  NOT NULL  ,
	CONSTRAINT Watch_PK PRIMARY KEY (IdFood,Id)

	,CONSTRAINT Watch_Food_FK FOREIGN KEY (IdFood) REFERENCES public.Food(IdFood)
	,CONSTRAINT Watch_UserF0_FK FOREIGN KEY (Id) REFERENCES public.UserF(Id)
)WITHOUT OIDS;

CREATE TABLE public.Waste(
	IdFood   INT  NOT NULL ,
	Id       INT  NOT NULL  ,
	CONSTRAINT Waste_PK PRIMARY KEY (IdFood,Id)

	,CONSTRAINT Waste_Food_FK FOREIGN KEY (IdFood) REFERENCES public.Food(IdFood)
	,CONSTRAINT Waste_UserF0_FK FOREIGN KEY (Id) REFERENCES public.UserF(Id)
)WITHOUT OIDS;

CREATE TABLE public.Delete(
	IdFood     INT  NOT NULL ,
	IdParent   INT  NOT NULL  ,
	CONSTRAINT Delete_PK PRIMARY KEY (IdFood,IdParent)

	,CONSTRAINT Delete_Food_FK FOREIGN KEY (IdFood) REFERENCES public.Food(IdFood)
	,CONSTRAINT Delete_Parent0_FK FOREIGN KEY (IdParent) REFERENCES public.Parent(IdParent)
)WITHOUT OIDS;

CREATE TABLE public.Add(
	IdFood     INT  NOT NULL ,
	IdParent   INT  NOT NULL  ,
	CONSTRAINT Add_PK PRIMARY KEY (IdFood,IdParent)

	,CONSTRAINT Add_Food_FK FOREIGN KEY (IdFood) REFERENCES public.Food(IdFood)
	,CONSTRAINT Add_Parent0_FK FOREIGN KEY (IdParent) REFERENCES public.Parent(IdParent)
)WITHOUT OIDS;



INSERT INTO "userf"(nameu,lastname,username,passwordp, mail) VALUES ('Dominic', 'Toretto', 'dom','mickeyPass','dom@gmail.com');
INSERT INTO "parent"(IdParent) VALUES (1);
INSERT INTO "can_be"(id,idParent) VALUES(1,1);
INSERT INTO "food"(Namef,Typet,ExpirationDate,Price,Quantity,CodeBarre) VALUES('Ice tea','Boisson','2018-10-27',2,1,124632);
INSERT INTO "add"(IdFood,IdParent) VALUES (1,1);
INSERT INTO "watch"(IdFood,id) VALUES (1,1);

INSERT INTO "userf"(nameu,lastname,username,passwordp, mail) VALUES ('Mickey', 'Iron', 'mickey','mickeyPass','mickey@gmail.com');
INSERT INTO "parent"(IdParent) VALUES (2);
INSERT INTO "can_be"(id,idParent) VALUES(2,2);
INSERT INTO "food"(Namef,Typet,ExpirationDate,Price,Quantity,CodeBarre) VALUES('Cookie','Gateaux','2018-10-27',6,4,3546542);
INSERT INTO "add"(IdFood,IdParent) VALUES (2,2);
INSERT INTO "watch"(IdFood,id) VALUES (2,2);


/*
CREATE TABLE "public.user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date
);
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('John', 'Doe', '1967-11-22');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Yvette', 'Angel', '1932-01-24');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Amelia', 'Waters', '1981-12-01');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Manuel', 'Holloway', '1979-07-25');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Alonzo', 'Erickson', '1947-11-13');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Otis', 'Roberson', '1995-01-09');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jaime', 'King', '1924-05-30');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Vicky', 'Pearson', '1982-12-12)');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Silvia', 'Mcguire', '1971-03-02');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Brendan', 'Pena', '1950-02-17');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jackie', 'Cohen', '1967-01-27');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');
*/