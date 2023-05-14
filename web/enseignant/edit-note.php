<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location: ../identification.php');
}
require_once('../../php/database.php');
// Enable all warnings and errors.
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection.
$db = dbConnect();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link href="../file.css" rel="stylesheet">
    <meta charset="utf-8">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <!-- Google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>edit : Note</title>
</head>

<body>
    <!--------------------------- Navbar enseignant ---------------------------------------------------->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <!--------------------------- ISEN + type de page ---------------------------------------------------->
            <a class="navbar-brand" href="../acceuil-enseignant.php">
                <img src="../images/navbar/ISEN-blanc.png" alt="Logo" style="width : 4.5rem; margin-right : 8px"
                    class="d-inline-block align-text-top">
                Enseignant
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--------------------------- Les parties de chaque type  ---------------------------------------------------->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Enseignant</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link " href="mes-classes.php">
                            Mes classes
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                table_restaurant
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mes-etudiants.php">
                            Mes étudiants
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                group
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="edit-note.php">
                            Saisir
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                edit
                            </span>
                        </a>
                    </li>
                </ul>
                <!--------------------------- Log out ---------------------------------------------------->
                <form class="d-flex" role="search">
                    <a class="btn btn-outline-danger" type="submit" href="../deconnexion.php">
                        Déconnexion
                        <span class="material-symbols-outlined" style="font-size: 1rem">
                            logout
                        </span>
                    </a>
                </form>
            </div>
        </div>
    </nav>

    <!--------------------------- Corps de la page ---------------------------------------------------->
    <div class="corps corps-enseignant d-flex flex-column mb-2">
        <!--------------------------- Titre + Logo ---------------------------------------------------->
        <div class="titre d-flex flex-column mb-2 align-items-center align-self-center">
            <span class="material-symbols-outlined logo" style="font-size: 4rem">
                edit
            </span>
            Note
        </div>
        <div class="btn-group" style="width : 30%">
            <a href="edit-note.php" class="btn btn-danger active">Note</a>
            <a href="edit-appreciation.php" class="btn btn-danger ">Appréciation</a>
            <a href="edit-coefficient.php" class="btn btn-danger">Coefficient</a>
        </div>
        <!--------------------------- contenue ---------------------------------------------------->
        <div class="edition d-flex flex-row justify-content-around">
            <!--------------------------- tableau ---------------------------------------------------->
            <div class="tableform" >
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead style="color : #dc3545">
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Note/20</th>
                            <th scope="col">Libelé</th>
                            <th scope="col">Matière</th>
                            <th scope="col">Date</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $notes = getNoteOfEnseignant($db, $_SESSION['id']);
                            foreach($notes as $note){
                                // print_r($note);
                                echo "<tr>";
                                echo "<td>".dbGetPersonneOfEtudiant($db, $note['id_etudiant'])[0]['nom']."</td>"; 
                                echo "<td>".dbGetPersonneOfEtudiant($db, $note['id_etudiant'])[0]['prenom']."</td>"; 
                                if(!isset($_POST['edit-'.$note['id_note'].''])){
                                    echo "<td>".$note['value_note']."</td>"; 
                                    
                                }else{
                                    echo "<td> <form action=\"edit-note.php\" method=\"post\">
                                    <input type=\"text\"name=\"new-note-".$note['id_note']."\"/>
                                    <button name='edit-".$note['id_note']."-done' type=\"submit\" class=\"btn btn-outline-danger\" >DONE</button>
                                    </form></td>"; 
                                }
                                if(isset($_POST['edit-'.$note['id_note'].'-done'])){
                                    editeNote($db, $note['id_note'], $_POST['new-note-'.$note['id_note'].'']);
                                    echo"<meta http-equiv=\"refresh\" content=\"0\">";
                                }
                                echo "<td>".$note['nom_ds']."</td>"; 
                                echo "<td>".dbGetMatiereById($db, $note['id_matiere'])[0]['value_matiere']."</td>"; 
                                echo "<td>".$note['date_ds']."</td>"; 
                                echo "<td> <form action=\"edit-note.php\" method=\"post\">
                                <button name='edit-".$note['id_note']."' type=\"submit\" class=\"btn btn-outline-danger\">EDIT</button>
                                <button name='supr-".$note['id_note']."' type=\"submit\" class=\"btn btn-outline-danger\">X</button>
                                </form></td>"; 
                                echo "</tr>";
                                if(isset($_POST['supr-'.$note['id_note'].''])){
                                    deleteNote($db, $note['id_note']);
                                    echo"<meta http-equiv=\"refresh\" content=\"0\">";
                                }
                                
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="connection d-flex flex-column ">
                <!--------------------------- création ---------------------------------------------------->
                <div class="titre  text-body-tertiary h2">
                    Entrer les informations
                </div>

                <div class="d-flex flex-column justify-content-center align-self-center align-items-center">
                    <div class="form-group d-flex flex-row">
                        <form action="edit-note.php" method="post">
                            <select class="form-select" name="semestre" required>
                                <option selected disabled>Semestre</option>
                                <?php
                                    $semestres = getSemestreOfEnseignant($db, $_SESSION['id']);
                                    foreach($semestres as $semestre){
                                        echo '<option value="'.$semestre['id_semestre'].'">'.$semestre['nom_semestre'].'</option>';
                                    } 
                                    
                                ?>
                            </select>
                            <button type="submit" class="btn btn-outline-danger" name="submit-semestre"><?php if(!empty($_SESSION['semestre'])){print(getSemestreOne($db, $_SESSION['semestre']))[0]['nom_semestre'];}else{print('SET');}  ?></button>
                        </form>
                        <?php
                            if(isset($_POST['submit-semestre'])){
                                $_SESSION['semestre'] = $_POST['semestre'];  
                                echo"<meta http-equiv=\"refresh\" content=\"0\">";
                            }
                        ?>
                        <form action="edit-note.php" method="post">
                            <select class="form-select" name="classe">
                                <option selected disabled value="">Classe</option>
                                <?php
                                    if(isset($_SESSION['semestre'])){                                                                                                                                              
                                        $classes = getClasseOfSemestreOfEnseignant($db, $_SESSION['semestre'],$_SESSION['id']);
                                        foreach($classes as $classe){
                                            echo '<option value="'.$classe['id_classe'].'">'.$classe['cycle'].$classe['annee'].'</option>';
                                        } 
                                        
                                    }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-outline-danger" name="submit-classe"><?php if(!empty($_SESSION['classe'])){$classe = getClasse($db, $_SESSION['classe']); print($classe[0]['cycle'].' '.$classe[0]['annee']);}else{print('SET');}  ?></button>
                        </form>
                        <?php
                            if(isset($_POST['submit-classe'])){
                                $_SESSION['classe'] = $_POST['classe'];  
                                echo"<meta http-equiv=\"refresh\" content=\"0\">";
                            }
                        ?>         
                        <form action="edit-note.php" method="post">
                            <select class="form-select" name="ds">
                                <option selected disabled value="">DS</option>
                                <?php
                                if(isset($_SESSION['classe'])){
                                    $dss = getDsOfEnseignantOfClasseOfSemestre($db, $_SESSION['id'], $_SESSION['classe'], $_SESSION['semestre']);
                                    foreach($dss as $ds){
                                        echo '<option value="'.$ds['id_evaluation'].'">'.$ds['nom_ds'].'</option>';
                                    } 
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-outline-danger" name="submit-ds"><?php if(!empty($_SESSION['ds'])){print(getDs($db, $_SESSION['ds']))[0]['nom_ds'];}else{print('SET');}  ?></button>
                        </form>
                        <?php
                            if(isset($_POST['submit-ds'])){
                                $_SESSION['ds'] = $_POST['ds'];  
                                echo"<meta http-equiv=\"refresh\" content=\"0\">";
                            }
                        ?>  
                        <form action="edit-note.php" method="post">
                            <select class="form-select" name="eleve">
                                <option selected disabled value="">Elève</option>
                                <?php
                                if(isset($_SESSION['ds'])){
                                    $eleves = getEtudiantOfDs($db, $_SESSION['ds'] );
                                    foreach($eleves as $eleve){
                                        $personne = dbGetPersonneOfEtudiant($db, $eleve['id_etudiant']);
                                        if(!isNoteOfEtudiantOfDS($db, $eleve['id_etudiant'], $_SESSION['ds'])){
                                            echo '<option value="'.$eleve['id_etudiant'].'">'.$personne[0]['prenom']." ".$personne[0]['nom'].'</option>';
                                        }
                                    } 
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-outline-danger" name="submit-eleve"><?php if(!empty($_SESSION['eleve'])){$personne = dbGetPersonneOfEtudiant($db, $_SESSION['eleve']); print($personne[0]['prenom']." ".$personne[0]['nom']);}else{print('SET');}  ?></button>
                        </form>
                    <?php
                            if(isset($_POST['submit-eleve'])){
                                $_SESSION['eleve'] = $_POST['eleve'];  
                                echo"<meta http-equiv=\"refresh\" content=\"0\">";
                            }
                        ?> 
                    </div>
                    <form action="edit-note.php" method="post" class="d-flex flex-column justify-content-center align-self-center align-items-center">
                        <div class="p-2">
                            <?php
                                if(isset($_SESSION['eleve'])){
                                    echo"<input type=\"text\" class=\"form-control\" id=\"note\" name=\"value-note\"
                                    placeholder=\"Entrer la note \" required>";
                                }
                            ?>
                            
                        </div>
                        <button type="submit" name="add-note" class="btn btn-danger">Ajouter une note</button>

                    </form>
                    <form action="edit-note.php" method="post">
                        <button name="clear-note" class="btn btn-outline-danger" style="font-size: 0.5em;">Supprimer les informations</button>
                    </form>
                    <?php
                            if(isset($_POST['add-note'])){
                                if(isset($_SESSION["semestre"]) and isset($_SESSION["classe"]) and isset($_SESSION["ds"]) and isset($_SESSION["eleve"])){
                                    addNotes($db, $_POST['value-note'], $_SESSION['eleve'], $_SESSION['ds']);
                                    unset($_SESSION["semestre"]);
                                    unset($_SESSION["classe"]);
                                    unset($_SESSION["ds"]);
                                    unset($_SESSION["eleve"]);   
                                    echo"<meta http-equiv=\"refresh\" content=\"0\">";
                                    
                                }else{
                                    echo "<div class=\"alert alert-danger\" role=\"alert\">Veuillez renplit tout les champs</div>";

                                }
                            }
                            if(isset($_POST['clear-note'])){
                                unset($_SESSION["semestre"]);
                                unset($_SESSION["classe"]);
                                unset($_SESSION["ds"]);
                                unset($_SESSION["eleve"]);   
                                echo"<meta http-equiv=\"refresh\" content=\"0\">";
                            }
                        ?>
                </div>

            </div>

        </div>

</body>

</html>