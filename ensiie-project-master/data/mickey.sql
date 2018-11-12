CREATE TABLE public.User(
	Id         SERIAL NOT NULL ,
	Name       VARCHAR (50) NOT NULL ,
	LastName   VARCHAR (50) NOT NULL ,
	Username   VARCHAR (50) NOT NULL ,
	Mail       VARCHAR (50) NOT NULL  ,
	CONSTRAINT User_PK PRIMARY KEY (Id)
)WITHOUT OIDS;

CREATE TABLE public.Child(
	IdChild   SERIAL NOT NULL  ,
	CONSTRAINT Child_PK PRIMARY KEY (IdChild)
)WITHOUT OIDS;

CREATE TABLE public.Parent(
	IdParent   SERIAL NOT NULL  ,
	CONSTRAINT Parent_PK PRIMARY KEY (IdParent)
)WITHOUT OIDS;

CREATE TABLE public.Food(
	IdFood      SERIAL NOT NULL ,
	Name        VARCHAR (100) NOT NULL ,
	Type        VARCHAR (20) NOT NULL ,
	Price       FLOAT  NOT NULL ,
	Quantity    INT  NOT NULL ,
	CodeBarre   INT  NOT NULL  ,
	CONSTRAINT Food_PK PRIMARY KEY (IdFood)
)WITHOUT OIDS;


CREATE TABLE public.Buffet(
	IdBuffet   SERIAL NOT NULL  ,
	CONSTRAINT Buffet_PK PRIMARY KEY (IdBuffet)
)WITHOUT OIDS;

CREATE TABLE public.Fridge(
	IdFridge      SERIAL NOT NULL ,
	DateOfClean   DATE  NOT NULL  ,
	CONSTRAINT Fridge_PK PRIMARY KEY (IdFridge)
)WITHOUT OIDS;

CREATE TABLE public.Is(
	IdChild   INT  NOT NULL ,
	Id        INT  NOT NULL  ,
	CONSTRAINT Is_PK PRIMARY KEY (IdChild,Id)

	,CONSTRAINT Is_Child_FK FOREIGN KEY (IdChild) REFERENCES public.Child(IdChild)
	,CONSTRAINT Is_User0_FK FOREIGN KEY (Id) REFERENCES public.User(Id)
)WITHOUT OIDS;

CREATE TABLE public.Can_be(
	IdParent   INT  NOT NULL ,
	Id         INT  NOT NULL  ,
	CONSTRAINT Can_be_PK PRIMARY KEY (IdParent,Id)

	,CONSTRAINT Can_be_Parent_FK FOREIGN KEY (IdParent) REFERENCES public.Parent(IdParent)
	,CONSTRAINT Can_be_User0_FK FOREIGN KEY (Id) REFERENCES public.User(Id)
)WITHOUT OIDS;

CREATE TABLE public.Consumed(
	IdFood   INT  NOT NULL ,
	Id       INT  NOT NULL  ,
	CONSTRAINT Consumed_PK PRIMARY KEY (IdFood,Id)

	,CONSTRAINT Consumed_Food_FK FOREIGN KEY (IdFood) REFERENCES public.Food(IdFood)
	,CONSTRAINT Consumed_User0_FK FOREIGN KEY (Id) REFERENCES public.User(Id)
)WITHOUT OIDS;

CREATE TABLE public.Watch(
	IdFood   INT  NOT NULL ,
	Id       INT  NOT NULL  ,
	CONSTRAINT Watch_PK PRIMARY KEY (IdFood,Id)

	,CONSTRAINT Watch_Food_FK FOREIGN KEY (IdFood) REFERENCES public.Food(IdFood)
	,CONSTRAINT Watch_User0_FK FOREIGN KEY (Id) REFERENCES public.User(Id)
)WITHOUT OIDS;

CREATE TABLE public.Waste(
	IdFood   INT  NOT NULL ,
	Id       INT  NOT NULL  ,
	CONSTRAINT Waste_PK PRIMARY KEY (IdFood,Id)

	,CONSTRAINT Waste_Food_FK FOREIGN KEY (IdFood) REFERENCES public.Food(IdFood)
	,CONSTRAINT Waste_User0_FK FOREIGN KEY (Id) REFERENCES public.User(Id)
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
