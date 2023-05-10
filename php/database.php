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

function id_classe($annee, $cycle){
    if($cycle == 'cir' && $annee == '1'){
        return 1;
    } else if($cycle == 'cir' && $annee == '2'){
        return 2;
    } else if($cycle == 'cir' && $annee == '3'){
        return 3;
    } else if($cycle == 'cir' && $annee == '4'){
        return 4;
    } else if($cycle == 'cir' && $annee == '5'){
        return 5;
    } else if($cycle == 'cir' && $annee == '1'){
        return 6;
    } else if($cycle == 'cgsi' && $annee == '2'){
        return 7;
    } else if($cycle == 'cgsi' && $annee == '3'){
        return 8;
    } else if($cycle == 'cgsi' && $annee == '4'){
        return 9;
    } else if($cycle == 'cgsi' && $annee == '5'){
        return 10;
    } else if($cycle == 'cest' && $annee == '1'){
        return 16;
    } else if($cycle == 'cest' && $annee == '2'){
        return 17;
    } else if($cycle == 'cest' && $annee == '3'){
        return 18;
    } else if($cycle == 'cest' && $annee == '4'){
        return 19;
    } else if($cycle == 'cest' && $annee == '5'){
        return 20;
    }
    return 0;
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
    }
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
    }
    return $result;
}
function getStatut($db , $id){
    try{
        if (isExistPersonne($db, $id)){
            $prepare = 'SELECT * FROM enseignant WHERE mail= :id';
            $statement = $db->prepare($prepare);
            $statement->bindParam(':id', $id);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }   
    catch (PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
    }
    return $result;
}
function isExistPersonne($db, $id_personne){
    try{
        $prepare='SELECT COUNT(*) FROM personne WHERE :id_personne';
        $statement = $db->prepare($prepare);
        $statement->bindParam(':id_personne', $id_personne);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($result == 1){
            $return = TRUE;
        } else{
            $return = FALSE;
        }
    }
    catch(PDOException $exception){
        error_log('Request error: '.$exception->getMessage());
        return false;
    }
    return $result;
}
?>

