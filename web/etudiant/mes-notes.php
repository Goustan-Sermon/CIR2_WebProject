<?php
session_start();
if(!isset($_SESSION['id'])OR $_SESSION['statut'] != 'etudiant'){
    header('Location: identification.php');
}
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
    <title>mes notes</title>
</head>

<body>
    <!--------------------------- Navbar étudiant ---------------------------------------------------->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <!--------------------------- ISEN + type de page ---------------------------------------------------->
            <a class="navbar-brand" href="../acceuil-etudiant.php">
                <img src="../images/navbar/ISEN-blanc.png" alt="Logo" style="width : 4.5rem; margin-right : 8px"
                    class="d-inline-block align-text-top">
                Etudiant
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
                        <a class="nav-link " href="mes-notes.php">
                            Mes notes
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                grade
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mon-semestre.php">
                            Mon semestre
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                school
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mon-annee.php">
                            Mon année
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                note
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
                grade
            </span>
            Mes notes
        </div>
        <!--------------------------- contenue ---------------------------------------------------->


        <div class="form-group d-flex flex-row">
            <form action="mes-notes.php" method="post" class="d-flex flex-row">
                <select class="form-select" name="semestre" required>
                    <option selected disabled>Semestre</option>
                    <?php
                            require_once('../../php/database.php');

                            // Enable all warnings and errors.
                            ini_set('display_errors', 1);
                            error_reporting(E_ALL);
                
                            // Database connection.
                            $db = dbConnect();
                            $semestres = dbGetSemestreOfEtudiant($db, $_SESSION['id']);
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

        </div>



        <div class="tableform">
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead style="color : #dc3545">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Matière</th>
                        <th scope="col">Libellé</th>
                        <th scope="col">Note/20</th>
                        <th scope="col">Enseignant</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                        // Get the student's id.
                        $id = $_SESSION['id'];
                        if(isset($_SESSION['semestre'])){
                            $semestre = $_SESSION['semestre'];
                            // Get the student's notes.
                            $notes = getNoteInfoOfEtudiantOfSemestre($db, $id, $semestre);
                            foreach ($notes as $note) {
                                $id_matiere = getMatiereOfNote($db, $note['id_evaluation']);
                                $matiere = dbGetMatiereById($db, $id_matiere[0]['id_matiere']);
                                $dateds = dbGetDateById_evaluation($db, $note['id_evaluation']);
                                $enseignant = dbGetEnseignantOfNoteById_evaluation($db, $note['id_evaluation']);
                                $nomEnseignant = dbGetNomEnseignantByMail($db, $enseignant[0]['mail']);
                                $nomDs = dbGetNomdsById_evaluation($db, $note['id_evaluation']);
                                echo '<tr>';
                                echo '<td>' . $dateds[0]['date_ds'] . '</td>';
                                echo '<td><b>' . $matiere[0]['value_matiere']. '<b></td>';
                                echo '<td>' . $nomDs['nom_ds'] . '</td>';
                                echo '<td>' . $note['value_note'] . '</td>';
                                echo '<td>' . $nomEnseignant[0]['nom'] . '</td>';
                                echo '</tr>';
                            } 
                        }else {
                            echo '<tr>';
                            echo '<td colspan="5">Aucune note</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>