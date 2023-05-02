------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: personne
------------------------------------------------------------
CREATE TABLE public.personne(
	id_personne    SERIAL NOT NULL ,
	nom            VARCHAR (50) NOT NULL ,
	prenom         VARCHAR (50) NOT NULL ,
	mail           VARCHAR (50) NOT NULL ,
	mot_de_passe   VARCHAR (50) NOT NULL ,
	photo          BYTEA  NOT NULL  ,
	CONSTRAINT personne_PK PRIMARY KEY (id_personne)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: enseignant
------------------------------------------------------------
CREATE TABLE public.enseignant(
	id_enseignant   SERIAL NOT NULL ,
	telephone       VARCHAR (50) NOT NULL  ,
	CONSTRAINT enseignant_PK PRIMARY KEY (id_enseignant)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: semestre
------------------------------------------------------------
CREATE TABLE public.semestre(
	id_semestre   SERIAL NOT NULL ,
	date_debut    DATE  NOT NULL ,
	date_fin      DATE  NOT NULL  ,
	CONSTRAINT semestre_PK PRIMARY KEY (id_semestre)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: appréciation
------------------------------------------------------------
CREATE TABLE public.appreciation(
	id_appreciation     SERIAL NOT NULL ,
	value_apprecition   VARCHAR (50) NOT NULL  ,
	CONSTRAINT appreciation_PK PRIMARY KEY (id_appreciation)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: matière
------------------------------------------------------------
CREATE TABLE public.matiere(
	id_matiere      SERIAL NOT NULL ,
	value_matiere   VARCHAR (50) NOT NULL ,
	id_semestre     INT  NOT NULL  ,
	CONSTRAINT matiere_PK PRIMARY KEY (id_matiere)

	,CONSTRAINT matiere_semestre_FK FOREIGN KEY (id_semestre) REFERENCES public.semestre(id_semestre)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: ds
------------------------------------------------------------
CREATE TABLE public.ds(
	id_evaluation   SERIAL NOT NULL ,
	coefficient     VARCHAR (50) NOT NULL ,
	id_matiere      INT  NOT NULL  ,
	CONSTRAINT ds_PK PRIMARY KEY (id_evaluation)

	,CONSTRAINT ds_matiere_FK FOREIGN KEY (id_matiere) REFERENCES public.matiere(id_matiere)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: cycle
------------------------------------------------------------
CREATE TABLE public.cycle(
	id_cycle      SERIAL NOT NULL ,
	value_cycle   VARCHAR (50) NOT NULL ,
	couleur       INT  NOT NULL  ,
	CONSTRAINT cycle_PK PRIMARY KEY (id_cycle)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: etudiant
------------------------------------------------------------
CREATE TABLE public.etudiant(
	id_etudiant   SERIAL NOT NULL ,
	id_cycle      INT  NOT NULL  ,
	CONSTRAINT etudiant_PK PRIMARY KEY (id_etudiant)

	,CONSTRAINT etudiant_cycle_FK FOREIGN KEY (id_cycle) REFERENCES public.cycle(id_cycle)
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
-- Table: être
------------------------------------------------------------
CREATE TABLE public.etre(
	id_enseignant   INT  NOT NULL ,
	id_personne     INT  NOT NULL ,
	id_etudiant     INT  NOT NULL  ,
	CONSTRAINT etre_PK PRIMARY KEY (id_enseignant,id_personne,id_etudiant)

	,CONSTRAINT etre_enseignant_FK FOREIGN KEY (id_enseignant) REFERENCES public.enseignant(id_enseignant)
	,CONSTRAINT etre_personne0_FK FOREIGN KEY (id_personne) REFERENCES public.personne(id_personne)
	,CONSTRAINT etre_etudiant1_FK FOREIGN KEY (id_etudiant) REFERENCES public.etudiant(id_etudiant)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: enseigner
------------------------------------------------------------
CREATE TABLE public.enseigner(
	id_matiere      INT  NOT NULL ,
	id_enseignant   INT  NOT NULL  ,
	CONSTRAINT enseigner_PK PRIMARY KEY (id_matiere,id_enseignant)

	,CONSTRAINT enseigner_matiere_FK FOREIGN KEY (id_matiere) REFERENCES public.matiere(id_matiere)
	,CONSTRAINT enseigner_enseignant0_FK FOREIGN KEY (id_enseignant) REFERENCES public.enseignant(id_enseignant)
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


------------------------------------------------------------
-- Table: contenir
------------------------------------------------------------
CREATE TABLE public.contenir(
	id_semestre       INT  NOT NULL ,
	id_appreciation   INT  NOT NULL  ,
	CONSTRAINT contenir_PK PRIMARY KEY (id_semestre,id_appreciation)

	,CONSTRAINT contenir_semestre_FK FOREIGN KEY (id_semestre) REFERENCES public.semestre(id_semestre)
	,CONSTRAINT contenir_appreciation0_FK FOREIGN KEY (id_appreciation) REFERENCES public.appreciation(id_appreciation)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: dépendre
------------------------------------------------------------
CREATE TABLE public.dependre(
	id_evaluation   INT  NOT NULL ,
	id_cycle        INT  NOT NULL  ,
	CONSTRAINT dependre_PK PRIMARY KEY (id_evaluation,id_cycle)

	,CONSTRAINT dependre_ds_FK FOREIGN KEY (id_evaluation) REFERENCES public.ds(id_evaluation)
	,CONSTRAINT dependre_cycle0_FK FOREIGN KEY (id_cycle) REFERENCES public.cycle(id_cycle)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: créer
------------------------------------------------------------
CREATE TABLE public.creer(
	id_appreciation   INT  NOT NULL ,
	id_enseignant     INT  NOT NULL  ,
	CONSTRAINT creer_PK PRIMARY KEY (id_appreciation,id_enseignant)

	,CONSTRAINT creer_appreciation_FK FOREIGN KEY (id_appreciation) REFERENCES public.appreciation(id_appreciation)
	,CONSTRAINT creer_enseignant0_FK FOREIGN KEY (id_enseignant) REFERENCES public.enseignant(id_enseignant)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: remplir
------------------------------------------------------------
CREATE TABLE public.remplir(
	id_evaluation   INT  NOT NULL ,
	id_enseignant   INT  NOT NULL  ,
	CONSTRAINT remplir_PK PRIMARY KEY (id_evaluation,id_enseignant)

	,CONSTRAINT remplir_ds_FK FOREIGN KEY (id_evaluation) REFERENCES public.ds(id_evaluation)
	,CONSTRAINT remplir_enseignant0_FK FOREIGN KEY (id_enseignant) REFERENCES public.enseignant(id_enseignant)
)WITHOUT OIDS;



