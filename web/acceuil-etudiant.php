<!DOCTYPE html>
<html lang="fr">

<head>
    <link href="file.css" rel="stylesheet">
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
    <title> acceuil étudiant</title>
</head>

<body>
    <!--------------------------- Navbar étudiant ---------------------------------------------------->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <!--------------------------- ISEN + type de page ---------------------------------------------------->
            <a class="navbar-brand" href="acceuil-etudiant.php">
                <img src="images/navbar/ISEN-blanc.png" alt="Logo" style="width : 4.5rem; margin-right : 8px"
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
                        <a class="nav-link " href="etudiant/mes-notes.php">
                            Mes notes
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                grade
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="etudiant/mes-semestres.php">
                            Mes semestres
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                school
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="etudiant/mon-annee.php">
                            Mon année
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                note
                            </span>
                        </a>
                    </li>
                </ul>
                <!--------------------------- Log out ---------------------------------------------------->
                <form class="d-flex" role="search">
                    <a class="btn btn-outline-danger" type="submit" href="identification.php">
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
                person
            </span>
            Etudiant
        </div>
        <!--------------------------- Block 1 ---------------------------------------------------->
        <div class="blocks justify-content-evenly">
            <div class="card rounded-5 text-bg-danger mb-2 align-items-center align-self-center border-danger ">
                <a href="etudiant/mes-notes.php" class="stretched-link"></a>
                <span class="material-symbols-outlined logo " style="font-size: 8rem">
                    grade
                </span>
                <p class="type">
                    Mes <br> notes
                </p>

            </div>
            <!--------------------------- Block 2 ---------------------------------------------------->
            <div class="card rounded-5 text-bg-danger mb-2 align-items-center align-self-center border-danger ">
                <a href="etudiant/mes-semestres.php" class="stretched-link"></a>
                <span class="material-symbols-outlined logo" style="font-size: 8rem">
                    school
                </span>
                <p class="type">
                    Mes <br> semestres
                </p>

            </div>
            <!--------------------------- Block 3 ---------------------------------------------------->
            <div class="card rounded-5 text-bg-danger mb-2 align-items-center align-self-center border-danger ">
                <a href="etudiant/mon-annee.php" class="stretched-link"></a>
                <span class="material-symbols-outlined logo" style="font-size: 8rem">
                    note
                </span>
                <p class="type">
                    Mon<br> année
                </p>
                <h3>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark ">
                        9
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </h3>
            </div>
        </div>
    </div>

</body>

</html>