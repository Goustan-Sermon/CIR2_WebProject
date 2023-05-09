#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: personne
#------------------------------------------------------------

CREATE TABLE personne(
        id_personne  Int  Auto_increment  NOT NULL ,
        nom          Varchar (50) NOT NULL ,
        prenom       Varchar (50) NOT NULL ,
        mail         Varchar (50) NOT NULL ,
        mot_de_passe Varchar (50) NOT NULL ,
        photo        Blob NOT NULL
	,CONSTRAINT personne_PK PRIMARY KEY (id_personne)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: semestre
#------------------------------------------------------------

CREATE TABLE semestre(
        id_semestre Int  Auto_increment  NOT NULL ,
        date_debut  Date NOT NULL ,
        date_fin    Date NOT NULL
	,CONSTRAINT semestre_PK PRIMARY KEY (id_semestre)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: classe
#------------------------------------------------------------

CREATE TABLE classe(
        id_classe Int  Auto_increment  NOT NULL ,
        cycle     Varchar (50) NOT NULL ,
        couleur   Int NOT NULL ,
        classe    Varchar (50) NOT NULL
	,CONSTRAINT classe_PK PRIMARY KEY (id_classe)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: etudiant
#------------------------------------------------------------

CREATE TABLE etudiant(
        id_etudiant Int  Auto_increment  NOT NULL ,
        id_personne Int NOT NULL ,
        id_classe   Int NOT NULL
	,CONSTRAINT etudiant_PK PRIMARY KEY (id_etudiant)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: enseignant
#------------------------------------------------------------

CREATE TABLE enseignant(
        id_enseignant Int  Auto_increment  NOT NULL ,
        telephone     Varchar (50) NOT NULL ,
        id_matiere    Int NOT NULL ,
        id_personne   Int NOT NULL
	,CONSTRAINT enseignant_PK PRIMARY KEY (id_enseignant)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ds
#------------------------------------------------------------

CREATE TABLE ds(
        id_evaluation Int  Auto_increment  NOT NULL ,
        coefficient   Varchar (50) NOT NULL ,
        id_classe     Int NOT NULL ,
        id_matiere    Int NOT NULL ,
        id_enseignant Int NOT NULL
	,CONSTRAINT ds_PK PRIMARY KEY (id_evaluation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: note
#------------------------------------------------------------

CREATE TABLE note(
        id_note       Int  Auto_increment  NOT NULL ,
        value_note    Float NOT NULL ,
        id_etudiant   Int NOT NULL ,
        id_evaluation Int NOT NULL ,
        id_enseignant Int NOT NULL
	,CONSTRAINT note_PK PRIMARY KEY (id_note)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: appréciation
#------------------------------------------------------------

CREATE TABLE appreciation(
        id_appreciation   Int  Auto_increment  NOT NULL ,
        value_apprecition Varchar (50) NOT NULL ,
        id_semestre       Int NOT NULL ,
        id_enseignant     Int NOT NULL
	,CONSTRAINT appreciation_PK PRIMARY KEY (id_appreciation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: matière
#------------------------------------------------------------

CREATE TABLE matiere(
        id_matiere    Int  Auto_increment  NOT NULL ,
        value_matiere Varchar (50) NOT NULL ,
        id_enseignant Int NOT NULL ,
        id_semestre   Int NOT NULL ,
        id_evaluation Int NOT NULL
	,CONSTRAINT matiere_PK PRIMARY KEY (id_matiere)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: consulter
#------------------------------------------------------------

CREATE TABLE consulter(
        id_appreciation Int NOT NULL ,
        id_etudiant     Int NOT NULL
	,CONSTRAINT consulter_PK PRIMARY KEY (id_appreciation,id_etudiant)
)ENGINE=InnoDB;




ALTER TABLE etudiant
	ADD CONSTRAINT etudiant_personne0_FK
	FOREIGN KEY (id_personne)
	REFERENCES personne(id_personne);

ALTER TABLE etudiant
	ADD CONSTRAINT etudiant_classe1_FK
	FOREIGN KEY (id_classe)
	REFERENCES classe(id_classe);

ALTER TABLE enseignant
	ADD CONSTRAINT enseignant_matiere0_FK
	FOREIGN KEY (id_matiere)
	REFERENCES matiere(id_matiere);

ALTER TABLE enseignant
	ADD CONSTRAINT enseignant_personne1_FK
	FOREIGN KEY (id_personne)
	REFERENCES personne(id_personne);

ALTER TABLE enseignant 
	ADD CONSTRAINT enseignant_matiere0_AK 
	UNIQUE (id_matiere);

ALTER TABLE ds
	ADD CONSTRAINT ds_classe0_FK
	FOREIGN KEY (id_classe)
	REFERENCES classe(id_classe);

ALTER TABLE ds
	ADD CONSTRAINT ds_matiere1_FK
	FOREIGN KEY (id_matiere)
	REFERENCES matiere(id_matiere);

ALTER TABLE ds
	ADD CONSTRAINT ds_enseignant2_FK
	FOREIGN KEY (id_enseignant)
	REFERENCES enseignant(id_enseignant);

ALTER TABLE ds 
	ADD CONSTRAINT ds_matiere0_AK 
	UNIQUE (id_matiere);

ALTER TABLE note
	ADD CONSTRAINT note_etudiant0_FK
	FOREIGN KEY (id_etudiant)
	REFERENCES etudiant(id_etudiant);

ALTER TABLE note
	ADD CONSTRAINT note_ds1_FK
	FOREIGN KEY (id_evaluation)
	REFERENCES ds(id_evaluation);

ALTER TABLE note
	ADD CONSTRAINT note_enseignant2_FK
	FOREIGN KEY (id_enseignant)
	REFERENCES enseignant(id_enseignant);

ALTER TABLE appreciation
	ADD CONSTRAINT appreciation_semestre0_FK
	FOREIGN KEY (id_semestre)
	REFERENCES semestre(id_semestre);

ALTER TABLE appreciation
	ADD CONSTRAINT appreciation_enseignant1_FK
	FOREIGN KEY (id_enseignant)
	REFERENCES enseignant(id_enseignant);

ALTER TABLE matiere
	ADD CONSTRAINT matiere_enseignant0_FK
	FOREIGN KEY (id_enseignant)
	REFERENCES enseignant(id_enseignant);

ALTER TABLE matiere
	ADD CONSTRAINT matiere_semestre1_FK
	FOREIGN KEY (id_semestre)
	REFERENCES semestre(id_semestre);

ALTER TABLE matiere
	ADD CONSTRAINT matiere_ds2_FK
	FOREIGN KEY (id_evaluation)
	REFERENCES ds(id_evaluation);

ALTER TABLE matiere 
	ADD CONSTRAINT matiere_enseignant0_AK 
	UNIQUE (id_enseignant);

ALTER TABLE matiere 
	ADD CONSTRAINT matiere_ds1_AK 
	UNIQUE (id_evaluation);

ALTER TABLE consulter
	ADD CONSTRAINT consulter_appreciation0_FK
	FOREIGN KEY (id_appreciation)
	REFERENCES appreciation(id_appreciation);

ALTER TABLE consulter
	ADD CONSTRAINT consulter_etudiant1_FK
	FOREIGN KEY (id_etudiant)
	REFERENCES etudiant(id_etudiant);
