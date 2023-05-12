------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: personne
------------------------------------------------------------
CREATE TABLE public.personne(
	mail           VARCHAR (50) NOT NULL ,
	nom            VARCHAR (50) NOT NULL ,
	prenom         VARCHAR (50) NOT NULL ,
	mot_de_passe   VARCHAR (200) NOT NULL ,
	telephone      VARCHAR (50) NOT NULL  ,
	CONSTRAINT personne_PK PRIMARY KEY (mail)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: matiere
------------------------------------------------------------
CREATE TABLE public.matiere(
	id_matiere      SERIAL NOT NULL ,
	value_matiere   VARCHAR (50) NOT NULL  ,
	CONSTRAINT matiere_PK PRIMARY KEY (id_matiere)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: enseignant
------------------------------------------------------------
CREATE TABLE public.enseignant(
	id_enseignant   SERIAL NOT NULL ,
	id_matiere      INT  NOT NULL ,
	mail            VARCHAR (50) NOT NULL  ,
	CONSTRAINT enseignant_PK PRIMARY KEY (id_enseignant)

	,CONSTRAINT enseignant_matiere_FK FOREIGN KEY (id_matiere) REFERENCES public.matiere(id_matiere)
	,CONSTRAINT enseignant_personne0_FK FOREIGN KEY (mail) REFERENCES public.personne(mail)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: classe
------------------------------------------------------------
CREATE TABLE public.classe(
	id_classe   SERIAL NOT NULL ,
	cycle       VARCHAR (50) NOT NULL ,
	annee       VARCHAR (50) NOT NULL  ,
	CONSTRAINT classe_PK PRIMARY KEY (id_classe)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: etudiant
------------------------------------------------------------
CREATE TABLE public.etudiant(
	id_etudiant   SERIAL NOT NULL ,
	mail          VARCHAR (50) NOT NULL ,
	id_classe     INT  NOT NULL  ,
	CONSTRAINT etudiant_PK PRIMARY KEY (id_etudiant)

	,CONSTRAINT etudiant_personne_FK FOREIGN KEY (mail) REFERENCES public.personne(mail)
	,CONSTRAINT etudiant_classe0_FK FOREIGN KEY (id_classe) REFERENCES public.classe(id_classe)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: semestre
------------------------------------------------------------
CREATE TABLE public.semestre(
	id_semestre    SERIAL NOT NULL ,
	date_debut     DATE  NOT NULL ,
	date_fin       DATE  NOT NULL ,
	nom_semestre   VARCHAR (50) NOT NULL ,
	id_classe      INT  NOT NULL  ,
	CONSTRAINT semestre_PK PRIMARY KEY (id_semestre)

	,CONSTRAINT semestre_classe_FK FOREIGN KEY (id_classe) REFERENCES public.classe(id_classe)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: ds
------------------------------------------------------------
CREATE TABLE public.ds(
	id_evaluation   SERIAL NOT NULL ,
	coefficient     FLOAT  NOT NULL ,
	nom_ds          VARCHAR (50) NOT NULL ,
	date_ds         DATE  NOT NULL ,
	id_enseignant   INT  NOT NULL ,
	id_semestre     INT  NOT NULL ,
	id_matiere      INT  NOT NULL ,
	id_classe       INT  NOT NULL  ,
	CONSTRAINT ds_PK PRIMARY KEY (id_evaluation)

	,CONSTRAINT ds_enseignant_FK FOREIGN KEY (id_enseignant) REFERENCES public.enseignant(id_enseignant)
	,CONSTRAINT ds_semestre0_FK FOREIGN KEY (id_semestre) REFERENCES public.semestre(id_semestre)
	,CONSTRAINT ds_matiere1_FK FOREIGN KEY (id_matiere) REFERENCES public.matiere(id_matiere)
	,CONSTRAINT ds_classe2_FK FOREIGN KEY (id_classe) REFERENCES public.classe(id_classe)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: note
------------------------------------------------------------
CREATE TABLE public.note(
	id_note         SERIAL NOT NULL ,
	value_note      FLOAT  NOT NULL ,
	id_etudiant     INT  NOT NULL ,
	id_evaluation   INT  NOT NULL ,
	id_enseignant   INT  NOT NULL  ,
	CONSTRAINT note_PK PRIMARY KEY (id_note)

	,CONSTRAINT note_etudiant_FK FOREIGN KEY (id_etudiant) REFERENCES public.etudiant(id_etudiant)
	,CONSTRAINT note_ds0_FK FOREIGN KEY (id_evaluation) REFERENCES public.ds(id_evaluation)
	,CONSTRAINT note_enseignant1_FK FOREIGN KEY (id_enseignant) REFERENCES public.enseignant(id_enseignant)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: appreciation
------------------------------------------------------------
CREATE TABLE public.appreciation(
	id_appreciation     SERIAL NOT NULL ,
	value_apprecition   VARCHAR (250) NOT NULL ,
	id_semestre         INT  NOT NULL ,
	id_enseignant       INT  NOT NULL ,
	id_matiere          INT  NOT NULL  ,
	CONSTRAINT appreciation_PK PRIMARY KEY (id_appreciation)

	,CONSTRAINT appreciation_semestre_FK FOREIGN KEY (id_semestre) REFERENCES public.semestre(id_semestre)
	,CONSTRAINT appreciation_enseignant0_FK FOREIGN KEY (id_enseignant) REFERENCES public.enseignant(id_enseignant)
	,CONSTRAINT appreciation_matiere1_FK FOREIGN KEY (id_matiere) REFERENCES public.matiere(id_matiere)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: admin
------------------------------------------------------------
CREATE TABLE public.admin(
	id_admin   SERIAL NOT NULL ,
	mail       VARCHAR (50) NOT NULL  ,
	CONSTRAINT admin_PK PRIMARY KEY (id_admin)

	,CONSTRAINT admin_personne_FK FOREIGN KEY (mail) REFERENCES public.personne(mail)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: consulter
------------------------------------------------------------
CREATE TABLE public.consulter(
	id_appreciation   INT  NOT NULL ,
	id_etudiant       INT  NOT NULL  ,
	CONSTRAINT consulter_PK PRIMARY KEY (id_appreciation,id_etudiant)

	,CONSTRAINT consulter_appreciation_FK FOREIGN KEY (id_appreciation) REFERENCES public.appreciation(id_appreciation)
	,CONSTRAINT consulter_etudiant0_FK FOREIGN KEY (id_etudiant) REFERENCES public.etudiant(id_etudiant)
)WITHOUT OIDS;



