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

function dbGetLastPersonneID($dbh){
    try{
        $statement = $dbh->query('SELECT id_personne FROM personne WHERE id_personne = (SELECT MAX(id_personne) FROM personne)');
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception){
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

function addEtudiant($db, $id_etu, $id_cycle){
    try{
        $statement = $db->prepare('INSERT INTO etudiant (id_etudiant, id_cycle) VALUES (:id_etudiant, :id_cycle)');
        $statement->bindParam(':id_etudiant', $id_etu);
        $statement->bindParam(':cycle', $id_cycle);
        $statement->execute();
    }
    catch (PDO $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return true;
}
function checkIdentification($db, $id, $mdp){
    try{
        $prepare = 'SELECT mot_de_passe FROM personne WHERE mail= :id';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $hash = $statement->fetchAll(PDO::FETCH_ASSOC);
        // echo $hash[0]['mot_de_passe'];
        $result = password_verify($mdp, $hash[0]['mot_de_passe']);
        echo $result.'-> checkIdentification';   
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
    }
    return $result;
}
function getPoste($db , $id_personne){
    try{
        $prepare = 'SELECT mot_de_passe FROM personne WHERE mail= :id';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $hash = $statement->fetchAll(PDO::FETCH_ASSOC);
        // echo $hash[0]['mot_de_passe'];
        $result = password_verify($mdp, $hash[0]['mot_de_passe']);
        echo $result.'re';   
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
    }
    return $result;
}
?>