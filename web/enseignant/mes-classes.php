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
    <title> mes classes</title>
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
                        <?php print($_SESSION['nom']." ".$_SESSION['prenom'])?>
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
                table_restaurant
            </span>
            Mes classes
        </div>
        <!--------------------------- contenue ---------------------------------------------------->
        <div class="form-group d-flex flex-row">
            <form action="mes-classes.php " class="d-flex flex-row" method="post">
                <select class="form-select" name="semestre" required>
                    <option selected disabled>Semestre</option>
                    <?php
                        $semestres = getSemestreOfEnseignant($db, $_SESSION['id']);
                        foreach($semestres as $semestre){
                            echo '<option value="'.$semestre['id_semestre'].'">'.$semestre['nom_semestre'].'</option>';
                        } 
                        
                    ?>
                </select>
                <button type="submit" class="btn btn-outline-danger"
                    name="submit-semestre"><?php if(!empty($_SESSION['semestre'])){print(getSemestreOne($db, $_SESSION['semestre']))[0]['nom_semestre'];}else{print('SET');}  ?></button>
            </form>
            <?php
                if(isset($_POST['submit-semestre'])){
                    $_SESSION['semestre'] = $_POST['semestre'];  
                    echo"<meta http-equiv=\"refresh\" content=\"0\">";
                }
            ?>
            <form action="mes-classes.php" class="d-flex flex-row" method="post">
                <select class="form-select" name="matiere" required>
                    <option selected disabled>Matiere</option>
                    <?php
                        $matieres = getMatiereOfEnseignantOfSemestre($db, $_SESSION['id'], $_SESSION['semestre']);
                        foreach($matieres as $matiere){
                            echo '<option value="'.$matiere['id_matiere'].'">'.$matiere['value_matiere'].'</option>';
                        } 
                        
                    ?>
                </select>
                <button type="submit" class="btn btn-outline-danger"
                    name="submit-matiere"><?php if(!empty($_SESSION['matiere'])){print(dbGetMatiereById($db, $_SESSION['matiere']))[0]['value_matiere'];}else{print('SET');}  ?></button>
            </form>
            <?php
                if(isset($_POST['submit-matiere'])){
                    $_SESSION['matiere'] = $_POST['matiere'];  
                    echo"<meta http-equiv=\"refresh\" content=\"0\">";
                }
            ?>
            <div class="d-flex flex-column mb-2 align-items-center align-self-center">
                <form action="mes-classes.php" method="post">
                    <button type="submit" name="afficher" class="btn btn-danger">Afficher</button>

                </form>
                <form action="mes-classes.php" method="post">
                    <button name="clear-note" class="btn btn-outline-danger" style="font-size: 0.5em;">Supprimer les
                        informations</button>
                </form>
            </div>
            <?php
                if(isset($_POST['afficher'])){
                    if(!isset($_SESSION["semestre"]) or !isset($_SESSION["matiere"])){
                        echo "<div class=\"alert alert-danger\" role=\"alert\">Veuillez remplir tout les champs</div>";

                    }
                }
                if(isset($_POST['clear-note'])){
                    unset($_SESSION["semestre"]);
                    unset($_SESSION["matiere"]);
                    echo"<meta http-equiv=\"refresh\" content=\"0\">";
                }
            ?>
        </div>
        <div class="tableform">
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead style="color : #dc3545">
                    <tr>
                        <th scope="col">Cycle</th>
                        <th scope="col">Année</th>
                        <th scope="col">Matière</th>
                        <th scope="col">Nombre d'élève</th>
                        <th scope="col">Moyenne /20 *</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    if(isset($_POST['afficher'] )){
                        if(isset($_SESSION["semestre"]) and isset($_SESSION["matiere"])){
            
                            $classes = getClasseOfSemestreOfEnseignantOfMatiere($db,$_SESSION['semestre'], $_SESSION['id'], $_SESSION['matiere']);
                            foreach($classes as $classe){
                                // print_r($classe);
                                echo "<tr>";
                                echo "<td>".$classe['cycle']."</td>"; 
                                echo "<td>".$classe['annee']."</td>";
                                echo "<td>".dbGetMatiereById($db, $_SESSION['matiere'])[0]['value_matiere']."</td>";
                                echo "<td>".getNumberEtudiantOfClasse($db, $classe['id_classe'])[0]['count']."</td>";
                                $moyenne = getAverageFromCurrentSemestreByMatiere($db,$_SESSION['matiere'], $_SESSION['semestre'])['numeric'];
                                if($moyenne < 12){                                    
                                    echo "<td style=\"color : #dc3545\">".$moyenne."</td>";
                                }else{
                                    echo "<td>".$moyenne."</td>";
                                }
                                echo "</tr>";                                
                            }
                        }
                    }
                        ?>
                </tbody>
            </table>
            <p>* Rouge si inférieur à 12
            <p>
        </div>

    </div>

</body>

</html>