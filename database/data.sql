DELETE FROM admin;
DELETE FROM etudiant;
DELETE FROM ds;
DELETE FROM enseignant;
DELETE FROM personne;
DELETE FROM matiere;
DELETE FROM semestre;
DELETE FROM classe;
DELETE FROM note;
DELETE FROM appreciation;
DELETE FROM consulter;

ALTER SEQUENCE classe_id_classe_seq RESTART;
INSERT INTO classe (cycle, annee) VALUES
('CIR', 'A1'), ('CIR', 'A2'), ('CIR', 'A3'), ('CIR',  'M1'), ('CIR',  'M2'),
('CGSI',  'A1'), ('CGSI',  'A2'), ('CGSI',  'A3'), ('CGSI',  'M1'), ('CGSI',  'M2'), 
('CEST',  'A1'), ('CEST',  'A2'), ('CEST',  'A3'), ('CEST',  'M1'), ('CEST',  'M2'); 

ALTER SEQUENCE matiere_id_matiere_seq RESTART;
INSERT INTO matiere (value_matiere) VALUES
('Mathématiques'), ('Physique'), ('Web'), ('C++'), ('Python');

INSERT INTO personne VALUES ('admin@admin.fr', 'admin', 'ad', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '00 00 00 00 00');
ALTER SEQUENCE admin_id_admin_seq RESTART;
INSERT INTO admin (mail) VALUES ('admin@admin.fr');

INSERT INTO personne VALUES 
('jeandupont@isen.fr', 'DUPONT', 'Jean', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 00' ), 
('abdelauger@isen.fr', 'AUGER', 'Abdel', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 01' ), 
('vincentheroux@isen.fr', 'HEROUX', 'Vincent', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 02' ),
('clementsoupai@isen.fr', 'SOUPAI', 'Clement', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 03' ),
('karineayoub@isen.fr', 'AYOUB', 'Karine', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 04' ),
('abdelaqabdelkari@isen.fr', 'ABDELKARI', 'Abdelaq', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 05' ),
('nilsbosse@isen.fr', 'BOSSE', 'Nils', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 06' ),
('jean-jacquesmeuneu@isen.fr', 'MEUNEU', 'Jean-Jacques', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 07' );

ALTER SEQUENCE etudiant_id_etudiant_seq RESTART;
INSERT INTO etudiant (mail, id_classe) VALUES
('jeandupont@isen.fr', 1), ('abdelauger@isen.fr', 1), ('vincentheroux@isen.fr', 1), ('clementsoupai@isen.fr', 1);

ALTER SEQUENCE enseignant_id_enseignant_seq RESTART;
INSERT INTO enseignant (mail, id_matiere) VALUES 
('karineayoub@isen.fr', 3), ('abdelaqabdelkari@isen.fr', 1), ('nilsbosse@isen.fr', 4), ('jean-jacquesmeuneu@isen.fr', 5);

ALTER SEQUENCE semestre_id_semestre_seq RESTART;
INSERT INTO semestre (date_debut, date_fin, nom_semestre, id_classe) VALUES
('2019-09-01', '2020-01-31', 'S1 CIR2', 2), ('2020-02-01', '2020-06-30', 'S2 CGSI 1', 6), ('2020-09-01', '2021-01-31', 'S1 CEST3', 13), 
('2021-02-01', '2021-06-30', 'S2 CIR1', 1), ('2021-05-04', '2022-09-03', 'S1 CIR3', 3), ('2022-09-04', '2023-01-31', 'S2 CIR2', 2);

ALTER SEQUENCE ds_id_evaluation_seq RESTART;
INSERT INTO ds (coefficient, nom_ds, date_ds, id_enseignant, id_semestre, id_matiere, id_classe) VALUES
(2, 'DS2 Maths', '2021-02-01', 2, 1, 1, 1), (2, 'DS1 Maths', '2022-09-01', 2, 1, 1, 1), (2, 'DS1 C++', '2021-05-04', 3, 2, 4, 3), 
(1, 'DS2 C++', '2022-06-04', 3, 4, 4, 2), (1, 'DS1 Python', '2022-03-09', 4, 4, 5, 1), (2, 'DS2 Python', '2022-07-02', 4, 5, 5, 3);