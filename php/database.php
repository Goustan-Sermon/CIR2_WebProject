<?php
include 'constants.php';
//--------------------------------------------------------------------------------------------------------
//----------------------------------------------Connection----------------------------------------------
//--------------------------------------------------------------------------------------------------------
function dbConnect(){
    $dsn = 'pgsql:dbname='.DB_NAME.';host='.DB_SERVER.';port='.DB_PORT;
    $user = DB_USER;
    $password = DB_PASSWORD;

    try {
        $db = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
        return false;
    }
    return $db;
}
//--------------------------------------------------------------------------------------------------------
//----------------------------------------------Add----------------------------------------------
//--------------------------------------------------------------------------------------------------------
function addPersonne($db, $nom, $prenom, $mail, $mot_de_passe, $telephone){
    $query = 'SELECT COUNT(*) FROM personne WHERE mail = :mail';
    $statement = $db->prepare($query);
    $statement->bindParam(':mail', $mail);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if($result[0]['count'] > 0){
        return false;
    }else{
        try{
            $statement = $db->prepare('INSERT INTO personne (nom, prenom, mail, mot_de_passe, telephone) VALUES (:nom, :prenom, :mail, :mot_de_passe, :telephone)');
            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':prenom', $prenom);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':mot_de_passe', $mot_de_passe);
            $statement->bindParam(':telephone', $telephone);
            $statement->execute();
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }
    return true;
}

function addEtudiant($db, $mail, $id_classe){
    try{
        $statement = $db->prepare('INSERT INTO etudiant (mail, id_classe) VALUES (:mail, :id_classe)');
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}

function addEnseignant($db, $mail){
    try{
        $statement = $db->prepare('INSERT INTO enseignant (mail) VALUES (:mail)');
        $statement->bindParam(':mail', $mail);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}

function addSemestre($db, $date_debut, $date_fin, $nom_semestre, $id_classe){
    try{
        $statement = $db->prepare('INSERT INTO semestre (date_debut, date_fin, nom_semestre, id_classe) VALUES (:date_debut, :date_fin, :nom_semestre, :id_classe)');
        $statement->bindParam(':date_debut', $date_debut);
        $statement->bindParam(':date_fin', $date_fin);
        $statement->bindParam(':nom_semestre', $nom_semestre);
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
} 

function addEpreuve($db, $coefficient, $nom, $date, $id_prof, $id_semestre, $id_matiere, $id_classe){
    try{
        $statement = $db->prepare('INSERT INTO ds (coefficient, nom_ds, date_ds, id_enseignant, id_semestre, id_matiere, id_classe) VALUES (:coefficient, :nom, :date, :id_prof, :id_semestre, :id_matiere, :id_classe)');
        $statement->bindParam(':coefficient', $coefficient);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':date', $date);
        $statement->bindParam(':id_prof', $id_prof);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}
function addAppreciation($db, $id_enseignant, $id_matiere, $id_semestre, $value_appreciation){
    try{
        $prepare = 'INSERT INTO appreciation (value_apprecition, id_semestre, id_enseignant, id_matiere) VALUES (:value_appreciation, :id_semestre, :id_enseignant, :id_matiere)';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':value_appreciation', $value_appreciation);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}

function addEnseignantToMatiere($db, $id_enseignant, $id_matiere){
    try{
        $statement = $db->prepare('INSERT INTO enseigner (id_enseignant, id_matiere) VALUES (:id_enseignant, :id_matiere)');
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}

function addConsulter($db, $id_appreciation, $id_etudiant){
    try{
        $statement = $db->prepare('INSERT INTO consulter (id_appreciation, id_etudiant) VALUES (:id_appreciation, :id_etudiant)');
        $statement->bindParam(':id_appreciation', $id_appreciation);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}
function addAppreciationAndConsulter($db, $id_enseignant, $id_matiere, $id_semestre, $value_appreciation, $id_etudiant){
    addAppreciation($db, $id_enseignant, $id_matiere, $id_semestre, $value_appreciation);
    $id_appreciation = getAppreciationLast($db)[0]['id_appreciation'];
    addConsulter($db, $id_appreciation, $id_etudiant);
}
function addNotes($db, $value_note, $id_etudiant, $id_evaluation){
    try{
        $prepare = 'INSERT INTO note (value_note, id_etudiant, id_evaluation) VALUES ( :value_note, :id_etudiant, :id_evaluation)';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':value_note', $value_note);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->bindParam(':id_evaluation', $id_evaluation);
        $statement->execute();

    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}
//--------------------------------------------------------------------------------------------------------
//----------------------------------------------Set----------------------------------------------
//--------------------------------------------------------------------------------------------------------
function setCoeffficient($db, $coefficient, $id_evaluation){
    try{
        $statement = $db->prepare('UPDATE ds SET coefficient = :coefficient WHERE id_evaluation = :id_evaluation');
        $statement->bindParam(':coefficient', $coefficient);
        $statement->bindParam(':id_evaluation', $id_evaluation);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}


//--------------------------------------------------------------------------------------------------------
//----------------------------------------------Get----------------------------------------------
//--------------------------------------------------------------------------------------------------------
function dbGetPersonnes($db){
    try{
        $statement = $db->query('SELECT * FROM personne');
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function dbGetPersonne($db, $id_personne){
    try{
        $statement = $db->prepare('SELECT * FROM personne WHERE mail =:id_personne');
        $statement->bindParam(':id_personne', $id_personne);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function dbGetAnneeById($db, $id_classe){
    try{
        $statement = $db->prepare('SELECT annee FROM classe WHERE id_classe = :id_classe');
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function dbGetCycleById($db, $id_classe){
    try{
        $statement = $db->prepare('SELECT cycle FROM classe WHERE id_classe = :id_classe');
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function dbGetPersonneOfEtudiant($db, $id_etudiant){
    try{
        $statement = $db->prepare('SELECT personne.* FROM personne jOIN etudiant ON personne.mail = etudiant.mail WHERE etudiant.id_etudiant = :id_etudiant');
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getStatut($db , $id_personne){
    try{
        if (isExistPersonne($db, $id_personne)){
            $prepare = 'SELECT COUNT(*) FROM etudiant WHERE mail= :id_personne';
            $statement = $db->prepare($prepare);
            $statement->bindParam(':id_personne', $id_personne);
            $statement->execute();
            $etudiant = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            $prepare = 'SELECT COUNT(*) FROM enseignant WHERE mail= :id_personne';
            $statement = $db->prepare($prepare);
            $statement->bindParam(':id_personne', $id_personne);
            $statement->execute();
            $enseignant = $statement->fetchAll(PDO::FETCH_ASSOC);

            $prepare = 'SELECT COUNT(*) FROM admin WHERE mail= :id_personne';
            $statement = $db->prepare($prepare);
            $statement->bindParam(':id_personne', $id_personne);
            $statement->execute();
            $admin = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            if ($etudiant[0]['count'] == 1 ){
                
                $result = 'etudiant';
            } elseif ($enseignant[0]['count'] == 1 ){
                $result = 'enseignant';
            } elseif($admin[0]['count'] == 1){
                $result = 'admin';
            }
            else{
                $result = 'false';
            }
        }
    }   
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
    }
    return $result;
}

function getIdOfStatutOfPersonne($db, $id_personne){
    try{
        if (isExistPersonne($db, $id_personne)){
            $statut = getStatut($db, $id_personne);
            if($statut == 'enseignant'){
                $prepare = 'SELECT * FROM enseignant WHERE mail= :id_personne';
                $statement = $db->prepare($prepare);
                $statement->bindParam(':id_personne', $id_personne);
                $statement->execute();
                $enseignant = $statement->fetchAll(PDO::FETCH_ASSOC);
                $result = $enseignant[0]['id_enseignant'];
            }elseif($statut == 'etudiant'){
                $prepare = 'SELECT * FROM etudiant WHERE mail= :id_personne';
                $statement = $db->prepare($prepare);
                $statement->bindParam(':id_personne', $id_personne);
                $statement->execute();
                $etudiant = $statement->fetchAll(PDO::FETCH_ASSOC);

                $result = $etudiant[0]['id_etudiant'];
            }else{
                $prepare = 'SELECT * FROM admin WHERE mail= :id_personne';
                $statement = $db->prepare($prepare);
                $statement->bindParam(':id_personne', $id_personne);
                $statement->execute();
                $admin = $statement->fetchAll(PDO::FETCH_ASSOC);

                $result = $admin[0]['id_admin'];
            }
        }
    }   
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
    }
    return $result;
}
function isExistPersonne($db, $id_personne){
    try{
        $prepare='SELECT COUNT(*) FROM personne WHERE mail = :id_personne';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_personne', $id_personne);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($result[0]['count'] == 1){
            $return = TRUE;
        } else{
            $return = FALSE;
        }
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $return;
}
function dbGetEpreuve($db){
    try{
        $statement = $db->query('SELECT * FROM ds');
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function dbGetMatiereIdByValue_matiere($db, $value_matiere){
    try{
        $statement = $db->prepare('SELECT * FROM matiere WHERE value_matiere =:value_matiere');
        $statement->bindParam(':value_matiere', $value_matiere);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function dbGetIdEnseignantByMail($db, $mail){
    try{
        $statement = $db->prepare('SELECT id_enseignant FROM enseignant WHERE mail =:mail');
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }

    return $result;
}

function dbGetDateById_evaluation($db, $id_evaluation){
    try{
        $statement = $db->prepare('SELECT date_ds FROM ds WHERE id_evaluation =:id_evaluation');
        $statement->bindParam(':id_evaluation', $id_evaluation);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function dbGetEnseignantOfNoteById_evaluation($db, $id_evaluation){
    try{
        $statement = $db->prepare('SELECT enseignant.* FROM enseignant JOIN ds ON enseignant.id_enseignant = ds.id_enseignant WHERE ds.id_evaluation =:id_evaluation');
        $statement->bindParam(':id_evaluation', $id_evaluation);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function dbGetNomEnseignantByMail($db, $mail){
    try{
        $statement = $db->prepare('SELECT nom FROM personne WHERE mail =:mail');
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function dbGetMatiereById($db, $id_matiere){
    try{
        $statement = $db->prepare('SELECT value_matiere FROM matiere WHERE id_matiere =:id_matiere');
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function getAverageFromCurrentSemestreByMatiere($db, $id_matiere, $id_semestre){
    try{
        $statement = $db->prepare('SELECT CAST(SUM(value_note*coefficient)/SUM(coefficient) AS numeric(10,2)) FROM note JOIN ds ON note.id_evaluation = ds.id_evaluation WHERE ds.id_matiere = :id_matiere AND ds.id_semestre = :id_semestre');
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function getAverageFromCurrentSemestreByMatiereAndId_etudiant($db, $id_matiere, $id_semestre, $id_etudiant){
    try{
        $statement = $db->prepare('SELECT CAST(SUM(value_note*coefficient)/SUM(coefficient) AS numeric(10,2)) FROM note JOIN ds ON note.id_evaluation = ds.id_evaluation WHERE ds.id_matiere = :id_matiere AND ds.id_semestre = :id_semestre AND note.id_etudiant = :id_etudiant');
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}
function getAverageAndEtudiantIdFromCurrentSemestreByMatiereAndId_etudiant($db, $id_matiere, $id_semestre, $id_etudiant){
    try{
        $statement = $db->prepare('SELECT CAST(SUM(value_note*coefficient)/SUM(coefficient) AS numeric(10,2)) FROM note JOIN ds ON note.id_evaluation = ds.id_evaluation WHERE ds.id_matiere = :id_matiere AND ds.id_semestre = :id_semestre AND note.id_etudiant = :id_etudiant');
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}
function getTotalAverageFromCurrentSemestreForEtudiant($db, $id_etudiant, $id_semestre){
    try{
        $statement = $db->prepare('SELECT CAST(SUM(value_note*coefficient)/SUM(coefficient) AS numeric(10,2)) FROM note JOIN ds ON note.id_evaluation = ds.id_evaluation WHERE ds.id_semestre = :id_semestre AND note.id_etudiant = :id_etudiant');
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function getAverageFromClasse($db, $id_classe){
    try{
        $statement = $db->prepare('SELECT AVG(value_note) FROM note JOIN ds ON note.id_evaluation = ds.id_evaluation JOIN etudiant ON note.id_etudiant = etudiant.id_etudiant WHERE etudiant.id_classe = :id_classe');
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function getAverageFromClasseByCurrentSemestre($db, $id_classe, $id_semestre){
    try{
        $statement = $db->prepare('SELECT CAST(SUM(value_note*coefficient)/SUM(coefficient) AS numeric(10,2))FROM note JOIN ds ON note.id_evaluation = ds.id_evaluation JOIN etudiant ON note.id_etudiant = etudiant.id_etudiant WHERE etudiant.id_classe = :id_classe AND ds.id_semestre = :id_semestre');
        $statement->bindParam(':id_classe', $id_classe);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function getAverageTotalFromEtudiantWithCoef($db, $id_etudiant){
    try{
        $statement = $db->prepare('SELECT SUM(value_note*coef)/SUM(coef) FROM note JOIN ds ON note.id_evaluation = ds.id_evaluation WHERE note.id_etudiant = :id_etudiant');
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function rattrapageByMatiereByEtu($db, $id_matiere, $currentSemestre, $id){
    if(getAverageFromCurrentSemestreByMatiereAndId_etudiant($db, $id_matiere, $currentSemestre, $id)['numeric'] < 10){
        return true;
    }
    else{
        return false;
    }
}

function dbGetPersonnesName($db){
    try{
        $statement = $db->prepare('SELECT nom, prenom FROM personne JOIN etudiant ON personne.mail = etudiant.mail JOIN classe ON etudiant.id_classe = classe.id_classe');
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function dbGetEnseignantsName($db){
    try{
        $statement = $db->prepare('SELECT nom, prenom FROM personne JOIN enseignant ON personne.mail = enseignant.mail');
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function dbGetMatiereFromEnseignantByName($db, $nom, $prenom){
    try{
        $statement = $db->prepare('SELECT matiere.value_matiere FROM personne JOIN enseignant ON personne.mail = enseignant.mail JOIN enseigner ON enseignant.id_enseignant = enseigner.id_enseignant JOIN matiere ON enseigner.id_matiere = matiere.id_matiere WHERE personne.prenom = :prenom AND personne.nom = :nom');
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':prenom', $prenom);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function dbGetClasseFromEtudiantByPrenomAndNomInPersonne($db, $prenom, $nom){
    try{
        $statement = $db->prepare('SELECT classe.id_classe FROM personne JOIN etudiant ON personne.mail = etudiant.mail JOIN classe ON etudiant.id_classe = classe.id_classe WHERE personne.prenom = :prenom AND personne.nom = :nom');
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':nom', $nom);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result['id_classe'];
}

function getNumerOfDsOfSemestre($db, $id_semestre){
    try{
        $statement = $db->prepare('SELECT COUNT(*) FROM ds WHERE id_semestre =:id_semestre');
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function getNumberOfDsOfCurrentSemestreByMatiere($db, $id_matiere, $id_semestre){
    try{
        $statement = $db->prepare('SELECT COUNT(*) FROM ds WHERE id_matiere =:id_matiere AND id_semestre =:id_semestre');
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        return false;
    }
    return $result;
}

function getMatiereOfEnseignant($db, $id_enseignant){
    try{
        $prepare='SELECT * FROM matiere JOIN enseigner ON matiere.id_matiere = enseigner.id_matiere WHERE enseigner.id_enseignant = :id_enseignant';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function getMatiereOfClasseOfEnseignant($db, $id_enseignant, $id_classe){
    try{
        $prepare='SELECT matiere.* FROM matiere JOIN enseigner ON matiere.id_matiere = enseigner.id_matiere WHERE enseigner.id_enseignant = :id_enseignant AND 0<
        (SELECT COUNT(*) FROM ds WHERE ds.id_enseignant = :id_enseignant AND ds.id_classe =  :id_classe AND ds.id_matiere = matiere.id_matiere )';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getMatiereOfEnseignantOfSemestre($db, $id_enseignant, $id_semestre){
    try{
        $prepare='SELECT matiere.* FROM matiere JOIN enseigner ON matiere.id_matiere = enseigner.id_matiere WHERE enseigner.id_enseignant = :id_enseignant AND 0<
        (SELECT COUNT(*) FROM ds WHERE ds.id_enseignant = :id_enseignant AND ds.id_semestre =  :id_semestre AND ds.id_matiere = matiere.id_matiere )';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function dbGetMailProfById($db, $id_enseignant){
    try{
        $statement = $db->prepare('SELECT mail FROM enseignant WHERE id_enseignant =:id_enseignant');
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function dbGetNomSemestreById($db, $id_semestre){
    try{
        $statement = $db->prepare('SELECT nom_semestre FROM semestre WHERE id_semestre =:id_semestre');
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function dbGetIdMatieres($db){
    try{
        $statement = $db->query('SELECT value_matiere FROM matiere');
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function dbGetIdMatiereByValue($db, $value_matiere){
    try{
        $statement = $db->prepare('SELECT id_matiere FROM matiere WHERE value_matiere =:value_matiere');
        $statement->bindParam(':value_matiere', $value_matiere);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function dbGetIdSemestre($db, $date_debut, $date_fin){
    try{
        $statement = $db->prepare('SELECT id_semestre FROM semestre WHERE date_debut =:date_debut AND date_fin =:date_fin');
        $statement->bindParam(':date_debut', $date_debut);
        $statement->bindParam(':date_fin', $date_fin);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function dbGetEnseignant($db){
    try{
        $statement = $db->query('SELECT * FROM enseignant');
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function dbGetPersonneNameByMail($db, $mail){
    try{
        $statement = $db->prepare('SELECT nom FROM personne WHERE mail =:mail');
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function dbGetSemestre($db){
    try{
        $statement = $db->query('SELECT * FROM semestre');
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function dbGetSemestreOfEtudiant($db, $id_etudiant){
    try{
        $statement = $db->prepare('SELECT semestre.* FROM semestre JOIN classe ON semestre.id_classe = classe.id_classe JOIN etudiant ON classe.id_classe = etudiant.id_classe WHERE etudiant.id_etudiant = :id_etudiant');
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function getIdClasseByMail($db, $mail){
    try{
        $statement = $db->prepare('SELECT id_classe FROM classe WHERE mail =:mail');
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function dbGetSemestreByClasse($db, $id_classe){
    try{
        $statement = $db->prepare('SELECT * FROM semestre WHERE id_classe = :id_classe');
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function getSemestreOne($db, $id_semestre){
    try{
        $statement = $db->prepare('SELECT * FROM semestre WHERE id_semestre = :id_semestre');
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function dbGetIdMatiere($db, $nom_matiere){
    try{
        $statement = $db->prepare('SELECT id_matiere FROM matiere WHERE value_matiere =:nom_matiere');
        $statement->bindParam(':nom_matiere', $nom_matiere);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getClasseId($db, $annee, $cycle){
    try{
        $statement = $db->prepare('SELECT id_classe FROM classe WHERE annee =:annee AND cycle =:cycle');
        $statement->bindParam(':annee', $annee);
        $statement->bindParam(':cycle', $cycle);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}



function getClasseNameById($db, $id_classe){
    try{
        $statement = $db->prepare('SELECT annee, cycle FROM classe WHERE id_classe =:id_classe');
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function getClasseById($db, $id_etudiant){
    try{
        $statement = $db->prepare('SELECT id_classe FROM etudiant WHERE id_etudiant =:id_etudiant');
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}


function getClasse($db, $id_classe){
    try{
        $prepare='SELECT cycle,annee FROM classe WHERE id_classe = :id_classe';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getClasseOfEnseignant($db, $id_enseignant){
    try{
        $prepare='SELECT cycle,annee FROM classe JOIN ds On classe.id_classe = ds.id_classe WHERE ds.id_enseignant = :id_enseignant';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getClasseOfSemestreOfEnseignant($db, $id_semestre, $id_enseignant){
    try{
        $prepare='SELECT DISTINCT classe.* FROM classe JOIN ds On classe.id_classe = ds.id_classe WHERE ds.id_enseignant = :id_enseignant AND ds.id_semestre = :id_semestre';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getClasseOfSemestreOfEnseignantOfMatiere($db, $id_semestre, $id_enseignant, $id_matiere){
    try{
        $prepare='SELECT DISTINCT classe.* FROM classe JOIN ds On classe.id_classe = ds.id_classe WHERE ds.id_enseignant = :id_enseignant AND ds.id_semestre = :id_semestre AND ds.id_matiere = :id_matiere';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getClasseOfDS($db, $id_evaluation){
    try{
        $prepare='SELECT id_classe FROM ds WHERE id_evaluation = :id_evaluation';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_evaluation', $id_evaluation);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getNumberEtudiantOfClasse($db, $id_classe){
    try{
        $prepare='SELECT COUNT(*) FROM etudiant WHERE id_classe = :id_classe';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getNoteOfEtudiantOfSemestre($db, $id_etudiant, $id_semestre){
    try{
        $prepare='SELECT value_note FROM note JOIN ds ON ds.id_evaluation = note.id_evaluation WHERE ds.id_semestre = :id_semestre AND note.id_etudiant = :id_etudiant';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function getMatiereOfNote($db, $id_evaluation){
    try{
        $prepare='SELECT id_matiere FROM ds WHERE id_evaluation = :id_evaluation';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_evaluation', $id_evaluation);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function getNoteOfEtudiant($db, $id_etudiant){
    try{
        $prepare='SELECT * FROM note JOIN ds ON ds.id_evaluation = note.id_evaluation WHERE note.id_etudiant = :id_etudiant ';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}



function getNoteInfoOfEtudiantOfSemestre($db, $id_etudiant, $id_semestre){
    try{
        $prepare='SELECT * FROM note JOIN ds ON ds.id_evaluation = note.id_evaluation WHERE ds.id_semestre = :id_semestre AND note.id_etudiant = :id_etudiant';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }

    return $result;
}

function getNoteOfEnseignant($db, $id_enseignant){
    try{
        $prepare='SELECT * FROM note JOIN ds ON ds.id_evaluation = note.id_evaluation WHERE ds.id_enseignant = :id_enseignant ';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
// function getNoteOfEtudiantOfMatiere($db, $id_etudiant, $id_semestre, $id_matiere){
//     try{
//         $notesOfSemestres = getNoteOfEtudiantOfSemestre($db, $id_etudiant, $id_semestre);

//     }
//     catch(PDOException $exception){
//         error_log('Request error: '.$exception->getMessage());
//         return false;
//     }
//     return $result;
// }
function getSemestreOfClasse($db, $id_classe){
    try{
        $prepare='SELECT nom_semestre FROM semestre WHERE id_classe = :id_classe';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function getSemestreOfEnseignant($db, $id_enseignant){
    try{
        $prepare='SELECT DISTINCT semestre.* FROM semestre JOIN ds ON semestre.id_semestre = ds.id_semestre WHERE ds.id_enseignant = :id_enseignant';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getDs($db, $id_evaluation){
    try{
        $prepare='SELECT * FROM ds WHERE id_evaluation = :id_evaluation ';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_evaluation', $id_evaluation);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getDSOfEnseignant($db, $id_enseignant){
    try{
        $prepare='SELECT * FROM ds WHERE  id_enseignant = :id_enseignant';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function dbGetNomdsById_evaluation($db, $id_evaluation){
    try{
        $prepare='SELECT nom_ds FROM ds WHERE id_evaluation = :id_evaluation';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_evaluation', $id_evaluation);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }

    return $result;
}
function getDsOfEnseignantOfClasseOfSemestre($db, $id_enseignant, $id_classe, $id_semestre){
    try{
        $prepare='SELECT * FROM ds WHERE id_classe = :id_classe AND id_enseignant = :id_enseignant AND  id_semestre = :id_semestre';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->bindParam(':id_classe', $id_classe);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getDsOfEnseignantOfClasseOfSemestreOfmatiere($db, $id_enseignant, $id_classe, $id_semestre, $id_matiere){
    try{
        $prepare='SELECT * FROM ds WHERE id_classe = :id_classe AND id_enseignant = :id_enseignant AND  id_semestre = :id_semestre  AND  id_matiere = :id_matiere';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->bindParam(':id_classe', $id_classe);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getEtudiantOfClasse($db, $id_classe){
    try{
        $prepare='SELECT * FROM etudiant WHERE id_classe = :id_classe';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getEtudiantById($db, $id_etudiant){
    try{
        $prepare='SELECT * FROM etudiant WHERE id_etudiant = :id_etudiant';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getEtudiantOfSemestreOfMatiere($db, $id_semestre, $id_matiere){
    try{
        $prepare='SELECT note.* FROM note JOIN ds ON note.id_evaluation = ds.id_evaluation WHERE ds.id_semestre =:id_semestre AND ds.id_matiere  =:id_matiere'; 
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getCurrentSemestre($db){
    try{
        $date = date("Y-m-d");
        $prepare='SELECT * FROM semestre WHERE date_debut <= :date AND date_fin >= :date';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':date', $date);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result[0];
}
function getCurrentSemestreFromEtudiant($db, $id_etudiant){
    try{
        $date = date("Y-m-d");
        $prepare='SELECT * FROM semestre WHERE id_semestre IN (SELECT id_semestre FROM ds WHERE id_evaluation IN (SELECT id_evaluation FROM note WHERE id_etudiant = :id_etudiant)) AND date_debut <= :date AND date_fin >= :date';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->bindParam(':date', $date);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $result = array_unique($result, SORT_REGULAR);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result[0];
}

function getEtudiantOfDs($db, $id_evaluation){
    try{
        $classe = getClasseOfDS($db, $id_evaluation);
        print_r($classe);
        $result = getEtudiantOfClasse($db, $classe[0]['id_classe']);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getEtudiantIdOfAppreciation($db, $id_appreciation){
    try{
        $prepare='SELECT * FROM consulter WHERE id_appreciation = :id_appreciation';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_appreciation', $id_appreciation);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getAppreciationOfEnseignant($db, $id_enseignant){
    try{
        $prepare='SELECT * FROM appreciation WHERE id_enseignant = :id_enseignant';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_enseignant', $id_enseignant);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getAppreciationOfEtudiantOfMatiereOfSemestre($db, $id_etudiant, $id_matiere, $id_semestre){
    try{
        $prepare='SELECT appreciation.* FROM appreciation JOIN consulter ON appreciation.id_appreciation = consulter.id_appreciation WHERE appreciation.id_matiere = :id_matiere AND appreciation.id_semestre = :id_semestre AND consulter.id_etudiant = :id_etudiant';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function getAppreciationLast($db){
    try{
        $prepare='SELECT * FROM appreciation WHERE id_appreciation = (SELECT MAX(id_appreciation) FROM appreciation)';
        $statement = $db->prepare($prepare);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function trier_etudiants_par_moyenne($array) {
    usort($array, function($a, $b) {
        return $a["moyenne"] > $b["moyenne"];
    });
    return $array;
}
function getClassementOfEtudiantBySemestreBymatiere($db, $id_etudiant, $id_semestre, $id_matiere, $id_classe){
    try{
        $personnes = getEtudiantOfClasse($db, $id_classe);
        // print_r($personnes);
        $array =  [];
        foreach($personnes as $personne){
            // print("<br> - - - id : ");
            // print_r($personne);
            // print("<br> - - - moyennne :");
            $moy = getAverageAndEtudiantIdFromCurrentSemestreByMatiereAndId_etudiant($db, $id_matiere, $id_semestre, $personne['id_etudiant'])['numeric'];
            if(!isset($moy)){
                $moy = 0;
            }
            // print($moy);
            array_push($array, ["id_etudiant" =>$personne['id_etudiant'], "moyenne" =>  $moy]);
        }
        // print("<br> <br>====== array :<br>");
        // print_r($array);
        $arraynew = trier_etudiants_par_moyenne($array);
        // print("<br><br>==== array trié :<br>");
        // print_r($arraynew);
        $i=0;

        foreach($arraynew as $stock){
            // print_r($stock);
            if($stock['id_etudiant'] == $id_etudiant){
                $place=$i;
            }
            $i++;
        }
        $result = $i-$place;
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
//--------------------------------------------------------------------------------------------------------
//----------------------------------------------Delete----------------------------------------------
//--------------------------------------------------------------------------------------------------------
function deleteNote($db, $id_note){
    try{
        $prepare = 'DELETE FROM note WHERE id_note = :id_note';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_note', $id_note);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}
function deleteConsulter($db, $id_appreciation){
    try{
        $prepare = 'DELETE FROM consulter WHERE id_appreciation = :id_appreciation';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_appreciation', $id_appreciation);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}
function deleteAppreciation($db, $id_appreciation){
    try{
        $prepare = 'DELETE FROM appreciation WHERE id_appreciation = :id_appreciation';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_appreciation', $id_appreciation);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}
function deleteAppreciationAndConsulter($db, $id_appreciation){
    deleteConsulter($db, $id_appreciation);
    deleteAppreciation($db, $id_appreciation);
}
//--------------------------------------------------------------------------------------------------------
//----------------------------------------------EDIT----------------------------------------------
//--------------------------------------------------------------------------------------------------------
function editeNote($db, $id_note, $new_value){
    try{
        $prepare = 'UPDATE note SET value_note = :new_value WHERE id_note = :id_note';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_note', $id_note);
        $statement->bindParam(':new_value', $new_value);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}
function editeAppreciation($db, $id_appreciation, $new_value){
    try{
        $prepare = 'UPDATE appreciation SET value_apprecition = :new_value WHERE id_appreciation = :id_appreciation';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_appreciation', $id_appreciation);
        $statement->bindParam(':new_value', $new_value);
        $statement->execute();
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}
//--------------------------------------------------------------------------------------------------------
//----------------------------------------------CHECK----------------------------------------------
//--------------------------------------------------------------------------------------------------------
function checkIdentification($db, $id_personne, $mdp){
    try{
        if(isExistPersonne($db, $id_personne)){
            $prepare = 'SELECT mot_de_passe FROM personne WHERE mail= :id_personne';
            $statement = $db->prepare($prepare);
            $statement->bindParam(':id_personne', $id_personne);
            $statement->execute();
            $hash = $statement->fetchAll(PDO::FETCH_ASSOC);
            $result = password_verify($mdp, $hash[0]['mot_de_passe']);
        } else{
            $result = FALSE;
        }
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
    }
    return $result;
}

function isNoteOfEtudiantOfDS($db, $id_etudiant, $id_evaluation){
    try{
        $prepare = 'SELECT COUNT(*) FROM note WHERE id_etudiant= :id_etudiant AND id_evaluation = :id_evaluation';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->bindParam(':id_evaluation', $id_evaluation);
        $statement->execute();
        $count = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($count[0]['count'] == 1){
            $result  = TRUE;
        }else{
            $result = FALSE;
        }
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function isAppreciation($db, $id_etudiant, $id_semestre, $id_matiere){
    try{
        $prepare = 'SELECT COUNT(*) FROM appreciation JOIN consulter ON appreciation.id_appreciation = consulter.id_appreciation WHERE appreciation.id_matiere = :id_matiere AND appreciation.id_semestre=:id_semestre AND consulter.id_etudiant = :id_etudiant';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_etudiant', $id_etudiant);
        $statement->bindParam(':id_semestre', $id_semestre);
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->execute();
        $count = $statement->fetchAll(PDO::FETCH_ASSOC);
        // print_r($count);
        if($count[0]['count'] == 1){
            $result  = TRUE;
        }else{
            $result = FALSE;
        }
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
?>