INSERT INTO classe (cycle, annee) VALUES
('CIR', 'A1'), ('CIR', 'A2'), ('CIR', 'A3'), ('CIR',  'M1'), ('CIR',  'M2'),
('CGSI',  'A1'), ('CGSI',  'A2'), ('CGSI',  'A3'), ('CGSI',  'M1'), ('CGSI',  'M2'), 
('CEST',  'A1'), ('CEST',  'A2'), ('CEST',  'A3'), ('CEST',  'M1'), ('CEST',  'M2'); 

INSERT INTO matiere (value_matiere) VALUES
('Mathématiques'), ('Physique'), ('Web'), ('C++'), ('Python');

INSERT INTO personne VALUES ('admin@admin.fr', 'admin', 'ad', '$2y$10$Ldb2s1HCr0q7tgp6JaDbNehV72FvFAtRNe86BJmLQhRjyVxINVYGm', '00 00 00 00 00');
INSERT INTO admin (mail) VALUES ('admin@admin.fr');

INSERT INTO personne VALUES 
('jeandupont@isen.fr', 'DUPONT', 'Jean', '$2y$10$Ldb2s1HCr0q7tgp6JaDbNehV72FvFAtRNe86BJmLQhRjyVxINVYGm' , '06 00 00 00 00' ), 
('abdelauger@isen.fr', 'AUGER', 'Abdel', '$2y$10$Ldb2s1HCr0q7tgp6JaDbNehV72FvFAtRNe86BJmLQhRjyVxINVYGm' , '06 00 00 00 01' ), 
('vincentheroux@isen.fr', 'HEROUX', 'Vincent', '$2y$10$Ldb2s1HCr0q7tgp6JaDbNehV72FvFAtRNe86BJmLQhRjyVxINVYGm' , '06 00 00 00 02' ),
('clementsoupai@isen.fr', 'SOUPAI', 'Clement', '$2y$10$Ldb2s1HCr0q7tgp6JaDbNehV72FvFAtRNe86BJmLQhRjyVxINVYGm' , '06 00 00 00 03' ),
('karineayoub@isen.fr', 'AYOUB', 'Karine', '$2y$10$Ldb2s1HCr0q7tgp6JaDbNehV72FvFAtRNe86BJmLQhRjyVxINVYGm' , '06 00 00 00 04' ),
('abdelaqabdelkari@isen.fr', 'ABDELKARI', 'Abdelaq', '$2y$10$Ldb2s1HCr0q7tgp6JaDbNehV72FvFAtRNe86BJmLQhRjyVxINVYGm' , '06 00 00 00 05' ),
('nilsbosse@isen.fr', 'BOSSE', 'Nils', '$2y$10$Ldb2s1HCr0q7tgp6JaDbNehV72FvFAtRNe86BJmLQhRjyVxINVYGm' , '06 00 00 00 06' ),
('jean-jacquesmeuneu@isen.fr', 'MEUNEU', 'Jean-Jacques', '$2y$10$Ldb2s1HCr0q7tgp6JaDbNehV72FvFAtRNe86BJmLQhRjyVxINVYGm' , '06 00 00 00 07' );

INSERT INTO etudiant (mail, id_classe) VALUES
('jeandupont@isen.fr', 1), ('abdelauger@isen.fr', 1), ('vincentheroux@isen.fr', 1), ('clementsoupai@isen.fr', 1);

INSERT INTO enseignant (mail, id_matiere) VALUES 
('karineayoub@isen.fr', 3), ('abdelaqabdelkari@isen.fr', 1), ('nilsbosse@isen.fr', 4), ('jean-jacquesmeuneu@isen.fr', 5);

INSERT INTO semestre (date_debut, date_fin, nom_semestre, id_classe) VALUES
('2019-09-01', '2020-01-31', 'S1 CIR2', 2), ('2020-02-01', '2020-06-30', 'S2 CGSI 1', 6), ('2020-09-01', '2021-01-31', 'S1 CEST3', 13), 
('2021-02-01', '2021-06-30', 'S2 CIR1', 1), ('2021-05-04', '2022-09-03', 'S1 CIR3', 3), ('2022-09-04', '2023-01-31', 'S2 CIR2', 2);

INSERT INTO ds (coefficient, nom_ds, id_enseignant, id_semestre) VALUES
(2, 'DS2 Maths', 2, 1), (2, 'DS1 Maths', 2, 4), (2, 'DS1 C++', 3, 2), (1, 'DS2 C++', 3, 5), (1, 'DS1 Python', 4, 4), (2, 'DS2 Python', 4, 5);