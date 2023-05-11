<?php
session_start();
if(!isset($_SESSION['mail'])){
    header('Location: http://localhost/php/CIR2_WebProject-1/web/identification.php');
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
                        <a class="nav-link" href="mes-semestres.php">
                            Mes semestres
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
            Mes semestres
        </div>
        <!--------------------------- contenue ---------------------------------------------------->
        <div class="card text-bg-danger mb-3 align-self-center" style="max-width: 18rem; text-align : center;">
            <div class="card-body">
                <h4 class="card-title">S4</h4>
                <p class="card-text">20/05/2022 - 20/09/2023</p>
            </div>
        </div>
        <div class="tableform">
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead style="color : #dc3545">
                    <tr>
                        <th scope="col">Matières</th>
                        <th scope="col">Nombre de ds</th>
                        <th scope="col">Moyenne/20</th>
                        <th scope="col">Moyenne de classe/20</th>
                        <th scope="col">Rattrapage</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        <td>Maths</td>
                        <th>3</th>
                        <td>13.2</td>
                        <th>12.5</th>
                        <td>/</td>
                    </tr>
                    <tr>
                        <td>Maths</td>
                        <th>3</th>
                        <td>13.2</td>
                        <th>12.5</th>
                        <td>/</td>
                    </tr>
                    <tr>
                        <td>Maths</td>
                        <th>3</th>
                        <td>13.2</td>
                        <th>12.5</th>
                        <td>/</td>
                    </tr>
                    <tr>
                        <td>Maths</td>
                        <th>3</th>
                        <td>13.2</td>
                        <th>12.5</th>
                        <td>/</td>
                    </tr>

                    <tr>
                        <th colspan="2" class="table-secondary">TOTAL : </th>
                        <th class="table-danger">15</th>
                        <th class="table-danger">12</th>
                        <th class="table-danger">/</th>
                    </tr>



                </tbody>
            </table>
        </div>
    </div>

</body>

</html>