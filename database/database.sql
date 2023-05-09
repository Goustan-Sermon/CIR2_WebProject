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
	MOT_DE_PASSE   VARCHAR (50) NOT NULL ,
	TELEPHONE      VARCHAR (50) NOT NULL  ,
	CONSTRAINT PERSONNE_PK PRIMARY KEY (ID_PERSONNE)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: etudiant
------------------------------------------------------------
CREATE TABLE public.ETUDIANT(
	ID_ETUDIANT   INT  NOT NULL ,
	VALUE_CYCLE   VARCHAR (50) NOT NULL  ,
	CONSTRAINT ETUDIANT_PK PRIMARY KEY (ID_ETUDIANT)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: enseignant
------------------------------------------------------------
CREATE TABLE public.ENSEIGNANT(
	ID_ENSEIGNANT   INT  NOT NULL  ,
	CONSTRAINT ENSEIGNANT_PK PRIMARY KEY (ID_ENSEIGNANT)
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
-- Table: appréciation
------------------------------------------------------------
CREATE TABLE public.APPRÉCIATION(
	ID_APPRECIATION     SERIAL NOT NULL ,
	VALUE_APPRECITION   VARCHAR (50) NOT NULL  ,
	CONSTRAINT APPRÉCIATION_PK PRIMARY KEY (ID_APPRECIATION)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: matière
------------------------------------------------------------
CREATE TABLE public.MATIÈRE(
	ID_MATIERE      SERIAL NOT NULL ,
	VALUE_MATIERE   VARCHAR (50) NOT NULL ,
	ID_SEMESTRE     INT  NOT NULL  ,
	CONSTRAINT MATIÈRE_PK PRIMARY KEY (ID_MATIERE)

	,CONSTRAINT MATIÈRE_SEMESTRE_FK FOREIGN KEY (ID_SEMESTRE) REFERENCES public.SEMESTRE(ID_SEMESTRE)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: ds
------------------------------------------------------------
CREATE TABLE public.DS(
	ID_EVALUATION   SERIAL NOT NULL ,
	COEFFICIENT     VARCHAR (50) NOT NULL ,
	ID_MATIERE      INT  NOT NULL  ,
	CONSTRAINT DS_PK PRIMARY KEY (ID_EVALUATION)

	,CONSTRAINT DS_MATIÈRE_FK FOREIGN KEY (ID_MATIERE) REFERENCES public.MATIÈRE(ID_MATIERE)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: note
------------------------------------------------------------
CREATE TABLE public.NOTE(
	ID_NOTE         SERIAL NOT NULL ,
	VALUE_NOTE      FLOAT  NOT NULL ,
	ID_EVALUATION   INT  NOT NULL ,
	ID_ENSEIGNANT   INT  NOT NULL ,
	ID_ETUDIANT     INT  NOT NULL  ,
	CONSTRAINT NOTE_PK PRIMARY KEY (ID_NOTE)

	,CONSTRAINT NOTE_DS_FK FOREIGN KEY (ID_EVALUATION) REFERENCES public.DS(ID_EVALUATION)
	,CONSTRAINT NOTE_ENSEIGNANT0_FK FOREIGN KEY (ID_ENSEIGNANT) REFERENCES public.ENSEIGNANT(ID_ENSEIGNANT)
	,CONSTRAINT NOTE_ETUDIANT1_FK FOREIGN KEY (ID_ETUDIANT) REFERENCES public.ETUDIANT(ID_ETUDIANT)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: être
------------------------------------------------------------
CREATE TABLE public.ETRE(
	ID_ENSEIGNANT   INT  NOT NULL ,
	ID_PERSONNE     INT  NOT NULL ,
	ID_ETUDIANT     INT  NOT NULL  ,
	CONSTRAINT ETRE_PK PRIMARY KEY (ID_ENSEIGNANT,ID_PERSONNE,ID_ETUDIANT)

	,CONSTRAINT ETRE_ENSEIGNANT_FK FOREIGN KEY (ID_ENSEIGNANT) REFERENCES public.ENSEIGNANT(ID_ENSEIGNANT)
	,CONSTRAINT ETRE_PERSONNE0_FK FOREIGN KEY (ID_PERSONNE) REFERENCES public.PERSONNE(ID_PERSONNE)
	,CONSTRAINT ETRE_ETUDIANT1_FK FOREIGN KEY (ID_ETUDIANT) REFERENCES public.ETUDIANT(ID_ETUDIANT)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: enseigner
------------------------------------------------------------
CREATE TABLE public.ENSEIGNER(
	ID_MATIERE      INT  NOT NULL ,
	ID_ENSEIGNANT   INT  NOT NULL  ,
	CONSTRAINT ENSEIGNER_PK PRIMARY KEY (ID_MATIERE,ID_ENSEIGNANT)

	,CONSTRAINT ENSEIGNER_MATIÈRE_FK FOREIGN KEY (ID_MATIERE) REFERENCES public.MATIÈRE(ID_MATIERE)
	,CONSTRAINT ENSEIGNER_ENSEIGNANT0_FK FOREIGN KEY (ID_ENSEIGNANT) REFERENCES public.ENSEIGNANT(ID_ENSEIGNANT)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: consulter
------------------------------------------------------------
CREATE TABLE public.CONSULTER(
	ID_APPRECIATION   INT  NOT NULL ,
	ID_ETUDIANT       INT  NOT NULL  ,
	CONSTRAINT CONSULTER_PK PRIMARY KEY (ID_APPRECIATION,ID_ETUDIANT)

	,CONSTRAINT CONSULTER_APPRÉCIATION_FK FOREIGN KEY (ID_APPRECIATION) REFERENCES public.APPRÉCIATION(ID_APPRECIATION)
	,CONSTRAINT CONSULTER_ETUDIANT0_FK FOREIGN KEY (ID_ETUDIANT) REFERENCES public.ETUDIANT(ID_ETUDIANT)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: contenir
------------------------------------------------------------
CREATE TABLE public.CONTENIR(
	ID_SEMESTRE       INT  NOT NULL ,
	ID_APPRECIATION   INT  NOT NULL  ,
	CONSTRAINT CONTENIR_PK PRIMARY KEY (ID_SEMESTRE,ID_APPRECIATION)

	,CONSTRAINT CONTENIR_SEMESTRE_FK FOREIGN KEY (ID_SEMESTRE) REFERENCES public.SEMESTRE(ID_SEMESTRE)
	,CONSTRAINT CONTENIR_APPRÉCIATION0_FK FOREIGN KEY (ID_APPRECIATION) REFERENCES public.APPRÉCIATION(ID_APPRECIATION)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: créer
------------------------------------------------------------
CREATE TABLE public.CRÉER(
	ID_APPRECIATION   INT  NOT NULL ,
	ID_ENSEIGNANT     INT  NOT NULL  ,
	CONSTRAINT CRÉER_PK PRIMARY KEY (ID_APPRECIATION,ID_ENSEIGNANT)

	,CONSTRAINT CRÉER_APPRÉCIATION_FK FOREIGN KEY (ID_APPRECIATION) REFERENCES public.APPRÉCIATION(ID_APPRECIATION)
	,CONSTRAINT CRÉER_ENSEIGNANT0_FK FOREIGN KEY (ID_ENSEIGNANT) REFERENCES public.ENSEIGNANT(ID_ENSEIGNANT)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: remplir
------------------------------------------------------------
CREATE TABLE public.REMPLIR(
	ID_EVALUATION   INT  NOT NULL ,
	ID_ENSEIGNANT   INT  NOT NULL  ,
	CONSTRAINT REMPLIR_PK PRIMARY KEY (ID_EVALUATION,ID_ENSEIGNANT)

	,CONSTRAINT REMPLIR_DS_FK FOREIGN KEY (ID_EVALUATION) REFERENCES public.DS(ID_EVALUATION)
	,CONSTRAINT REMPLIR_ENSEIGNANT0_FK FOREIGN KEY (ID_ENSEIGNANT) REFERENCES public.ENSEIGNANT(ID_ENSEIGNANT)
)WITHOUT OIDS;



