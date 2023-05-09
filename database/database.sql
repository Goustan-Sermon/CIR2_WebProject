------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: personne
------------------------------------------------------------
CREATE TABLE public.PERSONNE(
	ID_PERSONNE    SERIAL NOT NULL ,
	NOM            VARCHAR (50) NOT NULL ,
	PRENOM         VARCHAR (50) NOT NULL ,
	MAIL           VARCHAR (50) NOT NULL ,
	MOT_DE_PASSE   VARCHAR (200) NOT NULL ,
	TELEPHONE      VARCHAR (50) NOT NULL  ,
	CONSTRAINT PERSONNE_PK PRIMARY KEY (ID_PERSONNE)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: semestre
------------------------------------------------------------
CREATE TABLE public.SEMESTRE(
	ID_SEMESTRE   SERIAL NOT NULL ,
	DATE_DEBUT    DATE  NOT NULL ,
	DATE_FIN      DATE  NOT NULL  ,
	CONSTRAINT SEMESTRE_PK PRIMARY KEY (ID_SEMESTRE)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: matiere
------------------------------------------------------------
CREATE TABLE public.MATIERE(
	ID_MATIERE      SERIAL NOT NULL ,
	VALUE_MATIERE   VARCHAR (50) NOT NULL ,
	ID_SEMESTRE     INT  NOT NULL  ,
	CONSTRAINT MATIERE_PK PRIMARY KEY (ID_MATIERE)

	,CONSTRAINT MATIERE_SEMESTRE_FK FOREIGN KEY (ID_SEMESTRE) REFERENCES public.SEMESTRE(ID_SEMESTRE)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: enseignant
------------------------------------------------------------
CREATE TABLE public.ENSEIGNANT(
	ID_ENSEIGNANT   INT  NOT NULL ,
	ID_MATIERE      INT  NOT NULL ,
	ID_PERSONNE     INT  NOT NULL  ,
	CONSTRAINT ENSEIGNANT_PK PRIMARY KEY (ID_ENSEIGNANT)

	,CONSTRAINT ENSEIGNANT_MATIERE_FK FOREIGN KEY (ID_MATIERE) REFERENCES public.MATIERE(ID_MATIERE)
	,CONSTRAINT ENSEIGNANT_PERSONNE0_FK FOREIGN KEY (ID_PERSONNE) REFERENCES public.PERSONNE(ID_PERSONNE)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: appreciation
------------------------------------------------------------
CREATE TABLE public.APPRECIATION(
	ID_APPRECIATION     SERIAL NOT NULL ,
	VALUE_APPRECITION   VARCHAR (50) NOT NULL ,
	ID_SEMESTRE         INT  NOT NULL ,
	ID_ENSEIGNANT       INT  NOT NULL  ,
	CONSTRAINT APPRECIATION_PK PRIMARY KEY (ID_APPRECIATION)

	,CONSTRAINT APPRECIATION_SEMESTRE_FK FOREIGN KEY (ID_SEMESTRE) REFERENCES public.SEMESTRE(ID_SEMESTRE)
	,CONSTRAINT APPRECIATION_ENSEIGNANT0_FK FOREIGN KEY (ID_ENSEIGNANT) REFERENCES public.ENSEIGNANT(ID_ENSEIGNANT)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: classe
------------------------------------------------------------
CREATE TABLE public.CLASSE(
	ID_CLASSE   SERIAL NOT NULL ,
	CYCLE       VARCHAR (50) NOT NULL ,
	COULEUR     INT  NOT NULL ,
	CLASSE      VARCHAR (50) NOT NULL  ,
	CONSTRAINT CLASSE_PK PRIMARY KEY (ID_CLASSE)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: etudiant
------------------------------------------------------------
CREATE TABLE public.ETUDIANT(
	ID_ETUDIANT   INT  NOT NULL ,
	ID_PERSONNE   INT  NOT NULL ,
	ID_CLASSE     INT  NOT NULL  ,
	CONSTRAINT ETUDIANT_PK PRIMARY KEY (ID_ETUDIANT)

	,CONSTRAINT ETUDIANT_PERSONNE_FK FOREIGN KEY (ID_PERSONNE) REFERENCES public.PERSONNE(ID_PERSONNE)
	,CONSTRAINT ETUDIANT_CLASSE0_FK FOREIGN KEY (ID_CLASSE) REFERENCES public.CLASSE(ID_CLASSE)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: ds
------------------------------------------------------------
CREATE TABLE public.DS(
	ID_EVALUATION   SERIAL NOT NULL ,
	COEFFICIENT     VARCHAR (50) NOT NULL ,
	ID_CLASSE       INT  NOT NULL ,
	ID_ENSEIGNANT   INT  NOT NULL  ,
	CONSTRAINT DS_PK PRIMARY KEY (ID_EVALUATION)

	,CONSTRAINT DS_CLASSE_FK FOREIGN KEY (ID_CLASSE) REFERENCES public.CLASSE(ID_CLASSE)
	,CONSTRAINT DS_ENSEIGNANT0_FK FOREIGN KEY (ID_ENSEIGNANT) REFERENCES public.ENSEIGNANT(ID_ENSEIGNANT)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: note
------------------------------------------------------------
CREATE TABLE public.NOTE(
	ID_NOTE         SERIAL NOT NULL ,
	VALUE_NOTE      FLOAT  NOT NULL ,
	ID_ETUDIANT     INT  NOT NULL ,
	ID_EVALUATION   INT  NOT NULL ,
	ID_ENSEIGNANT   INT  NOT NULL  ,
	CONSTRAINT NOTE_PK PRIMARY KEY (ID_NOTE)

	,CONSTRAINT NOTE_ETUDIANT_FK FOREIGN KEY (ID_ETUDIANT) REFERENCES public.ETUDIANT(ID_ETUDIANT)
	,CONSTRAINT NOTE_DS0_FK FOREIGN KEY (ID_EVALUATION) REFERENCES public.DS(ID_EVALUATION)
	,CONSTRAINT NOTE_ENSEIGNANT1_FK FOREIGN KEY (ID_ENSEIGNANT) REFERENCES public.ENSEIGNANT(ID_ENSEIGNANT)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: consulter
------------------------------------------------------------
CREATE TABLE public.CONSULTER(
	ID_APPRECIATION   INT  NOT NULL ,
	ID_ETUDIANT       INT  NOT NULL  ,
	CONSTRAINT CONSULTER_PK PRIMARY KEY (ID_APPRECIATION,ID_ETUDIANT)

	,CONSTRAINT CONSULTER_APPRECIATION_FK FOREIGN KEY (ID_APPRECIATION) REFERENCES public.APPRECIATION(ID_APPRECIATION)
	,CONSTRAINT CONSULTER_ETUDIANT0_FK FOREIGN KEY (ID_ETUDIANT) REFERENCES public.ETUDIANT(ID_ETUDIANT)
)WITHOUT OIDS;
