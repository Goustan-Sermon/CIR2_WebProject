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
    <title> acceuil enseignant</title>
</head>

<body>
    <!--------------------------- Navbar enseignant ---------------------------------------------------->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <!--------------------------- ISEN + type de page ---------------------------------------------------->
            <a class="navbar-brand" href="acceuil-enseignant.php">
                <img src="ISEN-blanc.png" alt="Logo" style="width : 4.5rem; margin-right : 8px"
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
                        <a class="nav-link " href="#">
                            Mes classes
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                table_restaurant
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Mes étudiants
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                group
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Saisir
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                edit
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
                school
            </span>
            Enseignant
        </div>
        <!--------------------------- Block 1 ---------------------------------------------------->
        <div class="blocks justify-content-evenly">
            <div class="card rounded-5 text-bg-danger mb-2 align-items-center align-self-center border-danger shadow-lg">
                <a href="test.php" class="stretched-link"></a>
                <span class="material-symbols-outlined logo " style="font-size: 8rem">
                    table_restaurant
                </span>
                <p class="type">
                    Mes <br> classes
                </p>

            </div>
            <!--------------------------- Block 2 ---------------------------------------------------->
            <div class="card rounded-5 text-bg-danger mb-2 align-items-center align-self-center border-danger shadow-lg">
                <a href="test.php" class="stretched-link"></a>
                <span class="material-symbols-outlined logo" style="font-size: 8rem">
                    group
                </span>
                <p class="type">
                    Mes <br> étudiants
                </p>

            </div>
            <!--------------------------- Block 3 ---------------------------------------------------->
            <div class="card rounded-5 text-bg-danger mb-2 align-items-center align-self-center border-danger shadow-lg">
                <a href="test.php" class="stretched-link"></a>
                <span class="material-symbols-outlined logo" style="font-size: 8rem">
                    edit
                </span>
                <p class="type">
                    <br> Edit
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