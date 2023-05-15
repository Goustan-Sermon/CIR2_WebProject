DELETE FROM admin;
DELETE FROM note;
DELETE FROM etudiant;
DELETE FROM ds;
DELETE FROM enseigner;
DELETE FROM matiere;
DELETE FROM enseignant;
DELETE FROM personne;
DELETE FROM semestre;
DELETE FROM classe;
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

('thomasdubois@isen.fr', 'DUBOIS', 'Thomas', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '06 00 00 00 04'),
('marietoure@isen.fr', 'TOURE', 'Marie', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '06 00 00 00 05'),
('felixbertrand@isen.fr', 'BERTRAND', 'Felix', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '06 00 00 00 06'),
('louiscarre@isen.fr', 'CARRE', 'Louis', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '06 00 00 00 07'),
('marielagrange@isen.fr', 'LAGRANGE', 'Marie', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '06 00 00 00 08'),
('pierreperreault@isen.fr', 'PERREAULT', 'Pierre', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '06 00 00 00 09'),
('charlesleroy@isen.fr', 'LEROY', 'Charles', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '06 00 00 00 10'),
('anatoledupont@isen.fr', 'DUPONT', 'Anatole', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '06 00 00 00 11'),
('ameliecolin@isen.fr', 'COLIN', 'Amelie', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '06 00 00 00 12'),
('jacquesdufour@isen.fr', 'DUFOUR', 'Jacques', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '06 00 00 00 13'),

('karineayoub@isen.fr', 'AYOUB', 'Karine', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 14' ),
('abdelaqabdelkari@isen.fr', 'ABDELKARI', 'Abdelaq', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 15' ),
('nilsbosse@isen.fr', 'BOSSE', 'Nils', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 16' ),
('jean-jacquesmeuneu@isen.fr', 'MEUNEU', 'Jean-Jacques', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu' , '06 00 00 00 17' ),
('freixasjeremy@isen.fr', 'FREIXAS', 'Jeremy', '$2y$10$44LjEkr5EcC5hjJj9UCLSOki7drhytcw.r6ShVCmGsD47uQaMsyzu', '06 00 00 00 18');

ALTER SEQUENCE etudiant_id_etudiant_seq RESTART;
INSERT INTO etudiant (mail, id_classe) VALUES
('jeandupont@isen.fr', 1), ('abdelauger@isen.fr', 1), ('vincentheroux@isen.fr', 1), ('clementsoupai@isen.fr', 1),
('thomasdubois@isen.fr', 3), ('marietoure@isen.fr', 3), ('felixbertrand@isen.fr', 3), ('louiscarre@isen.fr', 3),
('marielagrange@isen.fr', 3), ('pierreperreault@isen.fr', 3), ('charlesleroy@isen.fr', 3), ('anatoledupont@isen.fr', 3),
('ameliecolin@isen.fr', 3), ('jacquesdufour@isen.fr', 3);

ALTER SEQUENCE enseignant_id_enseignant_seq RESTART;
INSERT INTO enseignant (mail) VALUES 
('karineayoub@isen.fr'), ('abdelaqabdelkari@isen.fr'), ('nilsbosse@isen.fr'), ('jean-jacquesmeuneu@isen.fr'), ('freixasjeremy@isen.fr');

INSERT INTO enseigner (id_enseignant, id_matiere) VALUES
(4, 5), (4, 3), (1, 2), (2, 1), (3, 4), (3, 5), (3, 3), (3, 2), (3, 1), (5, 2);

ALTER SEQUENCE semestre_id_semestre_seq RESTART;
INSERT INTO semestre (date_debut, date_fin, nom_semestre, id_classe) VALUES
('2019-09-01', '2020-01-31', 'S1 CIR2', 2), ('2020-02-01', '2020-06-30', 'S2 CGSI 1', 6), ('2020-09-01', '2021-01-31', 'S1 CEST3', 13), 
('2021-02-01', '2021-06-30', 'S2 CIR1', 1), ('2021-05-04', '2022-09-03', 'S1 CIR3', 3), ('2022-09-04', '2023-01-31', 'S2 CIR2', 2), ('2023-02-01', '2023-06-30', 'S1 CIR1', 1);

ALTER SEQUENCE ds_id_evaluation_seq RESTART;
INSERT INTO ds (coefficient, nom_ds, date_ds, id_enseignant, id_semestre, id_matiere, id_classe) VALUES
(2, 'DS2 Maths', '2023-02-08', 2, 7, 1, 1), (2, 'DS1 Maths', '2023-04-15', 2, 7, 1, 1), (2, 'DS1 C++', '2022-04-17', 3, 5, 4, 3), 
(1, 'DS2 C++', '2022-06-04', 3, 4, 4, 2), (1, 'DS1 Python', '2023-02-24', 4, 7, 5, 1), (2, 'DS2 Python', '2022-03-14', 4, 5, 5, 3), 
(2, 'DS1 Web', '2023-05-14', 1, 7, 3, 1), (1, 'DS1 C++', '2023-05-14', 3, 7, 4, 1), (2, 'DS2 C++', '2023-05-14', 3, 7, 4, 1),
(1, 'Interro Physique', '2023-04-10', 5, 7, 2, 1), (2, 'DS Physique', '2023-03-28', 5, 7, 2, 1);

ALTER SEQUENCE note_id_note_seq RESTART;
INSERT INTO note (value_note, id_etudiant, id_evaluation) VALUES 
(14, 1, 5), (14, 2, 5), (15, 3, 5), (16, 4, 5), (7, 1, 1), (17, 2, 1), 
(11, 3, 1), (8, 4, 1), (10, 1, 2), (14, 2, 2), (11, 3, 2), (8, 4, 2), 
(12 , 1, 6), (4, 2, 6), (19, 3, 6), (16, 4, 6), (12, 1, 3), (11, 2, 3), 
(15, 3, 3), (1, 4, 3), (17, 1, 4), (14, 2, 4), (13, 3, 4), (12, 4, 4), 
(14, 1, 7), (15, 2, 7), (16, 3, 7), (17, 4, 7), (14, 1, 8), (5, 2, 8),
(17, 3, 8), (10, 4, 8), (16, 1, 9), (1, 2, 9), (9, 3, 9), (15, 4, 9),
(10, 1, 10), (11, 2, 10), (12, 3, 10), (13, 4, 10), (14, 1, 11), (15, 2, 11),
(16, 3, 11), (17, 4, 11);

ALTER SEQUENCE appreciation_id_appreciation_seq RESTART;
INSERT INTO appreciation (value_apprecition, id_semestre, id_enseignant, id_matiere) VALUES
('Pas bien du tout', 7, 2, 1);

INSERT INTO consulter (id_appreciation, id_etudiant) VALUES
(1, 1);