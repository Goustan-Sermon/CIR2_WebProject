<<<<<<< HEAD
SELECT appreciation.* FROM appreciation JOIN consulter ON appreciation.id_appreciation = consulter.id_appreciation WHERE appreciation.id_matiere = 1 AND appreciation.id_semestre = 7 AND consulter.id_etudiant = 1;
=======
SELECT * FROM semestre WHERE id_semestre IN (SELECT id_semestre FROM ds WHERE id_evaluation IN (SELECT id_evaluation FROM note WHERE id_etudiant = 1)) AND date_debut <= '2023-05-15' AND date_fin >= '2023-05-15';
>>>>>>> f146a90251b4e74d4b120f111abe2dbad4eeed1b
