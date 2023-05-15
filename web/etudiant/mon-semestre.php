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
    <title> mes semestres</title>
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
                school
            </span>
            Mon semestre
        </div>
        <!--------------------------- contenue ---------------------------------------------------->
        <div class="card text-bg-danger mb-3 align-self-center" style="max-width: 18rem; text-align : center;">
            <div class="card-body">
                <?php
                    $currentSemestre = getCurrentSemestre($db);

                    $nomSemestre = $currentSemestre['nom_semestre'];
                    $date_debut = $currentSemestre['date_debut'];
                    $date_fin = $currentSemestre['date_fin'];
                    echo "<h4 class='card-title'>$nomSemestre</h4>";
                    echo "<p class='card-text'>$date_debut - $date_fin</p>";
                ?>
            </div>
        </div>
        <div class="tableform">
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead style="color : #dc3545">
                    <tr>
                        <th scope="col">Matières</th>
                        <th scope='col'>Appréciation</th>
                        <th scope="col">Moyenne/20</th>
                        <th scope="col">Moyenne de classe/20</th>
                        <th scope="col">Rattrapage</th>
                        <th scope="col">Nombre de ds</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                        $matieres = dbGetIdMatieres($db);
                        $classe = getClasseById($db, $_SESSION['id']);
                        $rattrapage = 0;
                        // Display all matieres.
                        foreach($matieres as $matiere) {
                            $id_matiere = dbGetIdMatiere($db, $matiere['value_matiere']);
                            $nbDs = getNumberOfDsOfCurrentSemestreByMatiere($db, $id_matiere[0]['id_matiere'], $currentSemestre['id_semestre']);
                            $moyenneClasse = getAverageFromCurrentSemestreByMatiere($db, $id_matiere[0]['id_matiere'], $currentSemestre['id_semestre']);
                            $moyenneEtu = getAverageFromCurrentSemestreByMatiereAndId_etudiant($db, $id_matiere[0]['id_matiere'], $currentSemestre['id_semestre'], $_SESSION['id']);
                            $moyenneTotaleEtu = getTotalAverageFromCurrentSemestreForEtudiant($db, $_SESSION['id'], $currentSemestre['id_semestre']);
                            $moyenneTotale = getAverageFromClasseByCurrentSemestre($db, $classe[0]['id_classe'], $currentSemestre['id_semestre']);
                            if(isAppreciation($db, $_SESSION['id'], $currentSemestre['id_semestre'], $id_matiere[0]['id_matiere'])){
                                $appreciation = getAppreciationOfEtudiantOfMatiereOfSemestre($db, $_SESSION['id'], $id_matiere[0]['id_matiere'], $currentSemestre['id_semestre']);
                            }
                            else{
                                $appreciation = array(array('value_apprecition' => ''));
                            }
                            $nbDsTotal = getNumerOfDsOfSemestre($db, $currentSemestre['id_semestre']);
                            echo '<tr>';
                            echo '<td>' . $matiere['value_matiere'] . '</td>';
                            echo '<td>' . $appreciation[0]['value_apprecition'] . '</td>';
                            echo '<th>' . $moyenneEtu['numeric'] . '</th>';
                            echo '<td>' . $moyenneClasse['numeric'] . '</td>';
                            if(rattrapageByMatiereByEtu($db, $id_matiere[0]['id_matiere'], $currentSemestre['id_semestre'], $_SESSION['id'])){
                                $rattrapage = 1;
                                echo '<th>Oui</th>';
                            }
                            else{
                                echo '<td>Non</td>';
                            }
                            echo '<td>' . $nbDs['count'] . '</td>';



                            echo '</tr>';
                        }
                            echo '<tr>
                                    <th colspan="2" class="table-secondary">TOTAL : </th>';
                            echo '<th class="table-danger">' . $moyenneTotaleEtu['numeric'] . '</th>';
                            echo '<td class="table-danger">' . $moyenneTotale['numeric'] . '</td>';
                            echo '<th class="table-danger">' . ($rattrapage == 1 ? "Oui" : "Non") . '</th>';
                            echo '<td class="table-danger">' . $nbDsTotal['count'] . '</td>';
                            echo '</tr>';
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>