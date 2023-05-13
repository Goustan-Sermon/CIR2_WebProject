<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location: identification.php');
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
                        <a class="nav-link" href="edit.php">
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
        <div class="edition d-flex flex-row">
            <!--------------------------- tableau ---------------------------------------------------->
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
                        <tr>
                            <td>20/11/2003</td>
                            <th>maths</th>
                            <td>ds 4</td>
                            <th>20</th>
                            <td>abdc</td>
                        </tr>
                        <tr>
                            <td>20/11/2003</td>
                            <th>maths</th>
                            <td>ds 4</td>
                            <th>20</th>
                            <td>abdc</td>
                        </tr>
                        <tr>
                            <td>20/11/2003</td>
                            <th>maths</th>
                            <td>ds 4</td>
                            <th>20</th>
                            <td>abdc</td>
                        </tr>
                        <tr>
                            <td>20/11/2003</td>
                            <th>maths</th>
                            <td>ds 4</td>
                            <th>20</th>
                            <td>abdc</td>
                        </tr>



                    </tbody>
                </table>
            </div>
            <div class="connection">
                <!--------------------------- création ---------------------------------------------------->
                <div class="titre d-flex flex-column mb-2 align-items-center align-self-center text-body-tertiary h2">
                    Entrer les informations
                </div>

                <div class="d-flex flex-column justify-content-center">
                    <div class="form-group d-flex justify-content-center">
                        <form action="edit-note.php" method="post">
                            <select class="form-select" name="semestre" required>
                                <option selected disabled value="">Semestre</option>
                                <?php
                                    $semestres = getSemestreOfEnseignant($db, $_SESSION['id']);
                                    foreach($semestres as $semestre){
                                        echo '<option value="'.$semestre['id_semestre'].'">'.$semestre['nom_semestre'].'</option>';
                                    } 
                                ?>
                            </select>
                        </form>
                        <form action="edit-note.php" method="post">
                            <select class="form-select" name="classe">
                                <option selected disabled value="">Classe</option>
                                <?php
                                    $classes = getClasseOfSemestreOfEnseignant($db, $_GET['semestre'],$_SESSION['id']);
                                    foreach($classes as $classe){
                                        echo '<option value="'.$classe['id_classe'].'">'.$classe['cycle'].$classe['annee'].'</option>';
                                    } 
                                ?>
                            </select>
                        </form>
                        <form action="edit-note.php" method="post">
                            <select class="form-select" name="ds">
                                <option selected disabled value="">DS</option>
                                <?php
                                    $dss = getDsOfEnseignantOfClasseOfSemestre($db, $_SESSION['id'], $_GET['classe'], $_GET['semestre']);
                                    foreach($ds as $ds){
                                        echo '<option value="'.$ds['id_evaluation'].'">'.$ds['nom_ds'].'</option>';
                                    } 
                                ?>
                            </select>
                        </form>
                        <form action="edit-note.php" method="post">
                            <select class="form-select" name="eleve">
                                <option selected disabled value="">Elève</option>
                                <?php
                                    $eleves = getEtudiantOfDs($db, $_GET['ds'] );
                                    foreach($eleves as $eleve){
                                        $personne = dbGetPersonneOfEtudiant($db, $eleve['id_etudiant']);
                                        echo '<option value="'.$eleve['id_etudiant'].'">'.$personne['prenom'].$personne['nom'].'</option>';
                                    } 
                                ?>
                            </select>
                        </form>
                    </div>
                    <form action="edit-note.php" method="post">
                        <div class="p-2">
                            <label for="note" class="form-label">Note*</label>
                            <input type="text" class="form-control" id="note" name="note"
                                placeholder="Entrer une note sur 20" required>
                        </div>
                        <button type="submit" name="add" class="btn btn-danger">Ajouter une note</button>
                    </form>
                </div>

            </div>

        </div>

</body>

</html>