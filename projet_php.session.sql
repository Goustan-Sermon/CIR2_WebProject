SELECT * FROM appreciation WHERE id_appreciation = (SELECT MAX(id_appreciation) FROM appreciation)