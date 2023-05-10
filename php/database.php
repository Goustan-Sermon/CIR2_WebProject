<?php
include 'constants.php';

function dbConnect(){
    $dsn = 'pgsql:dbname='.DB_NAME.';host='.DB_SERVER.';port='.DB_PORT;
    $user = DB_USER;
    $password = DB_PASSWORD;

    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
        return false;
    }
    return $dbh;
}

function dbGetPersonnes($dbh){
    try{
        $statement = $dbh->query('SELECT * FROM personne');
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
function dbGetPersonne($db, $id){
    try{
        $statement = $db->prepare('SELECT * FROM personne WHERE mail =:id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}

function addPersonne($db, $nom, $prenom, $mail, $mot_de_passe, $telephone){
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
    return true;
}

function addEtudiant($db, $mail, $id_classe){
    try{
        $statement = $db->prepare('INSERT INTO etudiant (mail, id_classe) VALUES (:mail, :id_classe)');
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':id_classe', $id_classe);
        $statement->execute();
    }
    catch (PDO $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}

function addEnseignant($db, $mail, $id_matiere){
    try{
        $statement = $db->prepare('INSERT INTO enseignant (mail, id_matiere) VALUES (:mail, :id_matiere)');
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':id_matiere', $id_matiere);
        $statement->execute();
    }
    catch (PDO $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
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

function checkIdentification($db, $id, $mdp){
    try{
        if(isExistPersonne($db, $id)){
            $prepare = 'SELECT mot_de_passe FROM personne WHERE mail= :id';
            $statement = $db->prepare($prepare);
            $statement->bindParam(':id', $id);
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
function getStatut($db , $id){
    try{
        if (isExistPersonne($db, $id)){
            $prepare = 'SELECT COUNT(*) FROM etudiant WHERE mail= :id';
            $statement = $db->prepare($prepare);
            $statement->bindParam(':id', $id);
            $statement->execute();
            $etudiant = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            $prepare = 'SELECT COUNT(*) FROM enseignant WHERE mail= :id';
            $statement = $db->prepare($prepare);
            $statement->bindParam(':id', $id);
            $statement->execute();
            $enseignant = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($etudiant[0]['count'] == 1 ){
                $result = 'etudiant';
            } elseif ($enseignant[0]['count'] == 1 ){
                $result = 'enseignant';
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
?>

