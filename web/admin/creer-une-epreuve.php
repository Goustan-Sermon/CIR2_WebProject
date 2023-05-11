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
    <title>créer une épreuve</title>
</head>

<body>
    <!--------------------------- Navbar admin ---------------------------------------------------->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <!--------------------------- ISEN + type de page ---------------------------------------------------->
            <a href="../acceuil-admin.php"><img src="../images/navbar/ISEN-blanc.png"
                    style="width : 4.5rem; margin-right : 8px" class="img-fluid"></a>
            <a class="navbar-brand" href="../acceuil-admin.php">Administrateur</a>
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
                        <a class="nav-link " href="creer-un-compteV2.php">
                            Créer un compte
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                account_circle
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="creer-un-semestre.php">
                            Créer un semestre
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                school
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="creer-une-epreuve.php">
                            Créer une preuve
                            <span class="material-symbols-outlined" style="font-size: 1rem">
                                note
                            </span>
                        </a>
                    </li>
                </ul>
                <!--------------------------- Log out ---------------------------------------------------->
                <form class="d-flex" role="search">
                    <a class="btn btn-outline-danger" type="submit" href="../identification.php">
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
                note
            </span>
            Créer une épreuve
        </div>
        <!--------------------------- contenue  ---------------------------------------------------->
        <div class="blocks justify-content-evenly">
            <!--------------------------- Block 1 ---------------------------------------------------->
            <div class="mb-2 align-items-center align-self-center">
                <div class="text-body-tertiary h2">
                    Les dernières épreuves créées       
                </div>
                <!-- Exemple -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Semestre</th>
                            <th scope="col">Date</th>
                            <th scope="col">Cycle</th>
                            <th scope="col">Année</th>
                            <th scope="col">Matière</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td>S1</td>
                            <td>01/09/2020</td>
                            <td>CIR</td>
                            <td>A2</td>
                            <td>Maths</td>
                        </tr>
                        <tr>
                            <td>S2</td>
                            <td>01/02/2021</td>
                            <td>CGSI</td>
                            <td>A1</td>
                            <td>Physique</td>
                        </tr>
                        <tr>
                            <td>S3</td>
                            <td>01/09/2021</td>
                            <td>CEST</td>
                            <td>A3</td>
                            <td>Anglais</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--------------------------- Block 2 ---------------------------------------------------->
            <div class="mb-2 align-items-center align-self-center">
                <div class="text-body-tertiary h2">
                    Entrer les informations        
                </div>
                <form action="creer-un-semestre.php" method="post">
                    <div class="d-flex flex-column justify-content-center">  
                        <div class="p-2">
                            <label for="nom" class="form-label">Nom*</label>
                            <input type="text" class="form-control" id="nom" name="nom" aria-describedby="emailHelp" placeholder="Nom" required>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="p-2">
                                <select class="custom-select" name="cycle" required>
                                    <option value="">Cycle</option>
                                    <option value="CIR">CIR</option>
                                    <option value="CGSI">CGSI</option>
                                    <option value="CEST">CEST</option>
                                </select>
                                <select class="custom-select" name="annee" required>
                                    <option value="">Année</option>
                                    <option value="A1">A1</option>
                                    <option value="A2">A2</option>
                                    <option value="A3">A3</option>
                                    <option value="M1">M1</option>
                                    <option value="M2">M2</option>
                                </select>
                                <select class="custom-select" name="matiere" required>
                                    <option value="">Matière</option>
                                    <option value="Mathématiques">Mathématique</option>
                                    <option value="Physique">Physique</option>
                                    <option value="Web">Web</option>
                                    <option value="C++">C++</option>
                                    <option value="Python">Python</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="p-2">
                                <select class="custom-select" name="semestre" required>
                                    <option value="">Semestre</option>
                                    <?php
                                        require_once('../../php/database.php');

                                        // Enable all warnings and errors.
                                        ini_set('display_errors', 1);
                                        error_reporting(E_ALL);
                            
                                        // Database connection.
                                        $db = dbConnect();
                        
                                        $semestres = dbGetSemestre($db);

                                        // Display all semesters.
                                        foreach($semestres as $semestre){
                                            echo '<option value="'.$semestre['id'].'">'.$semestre['nom'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="p-2">
                            <label for="date" class="form-label">Date*</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                        </div>
                        <button type="submit" name="add" class="btn btn-danger">Créer un semestre</button>
                        <?php
                            require_once('../../php/database.php');

                            // Enable all warnings and errors.
                            ini_set('display_errors', 1);
                            error_reporting(E_ALL);
                
                            // Database connection.
                            $db = dbConnect();
        
                            if(isset($_POST['add']) && isset($_POST['nom']) && isset($_POST['date']) && isset($_POST['cycle']) && isset($_POST['annee']) && isset($_POST['matiere']) && isset($_POST['semestre'])){
                                $nom = $_POST['nom'];
                                $date = $_POST['date'];
                                $cycle = $_POST['cycle'];
                                $annee = $_POST['annee'];
                                $matiere = $_POST['matiere'];
                                $semestre = $_POST['semestre'];

                                dbAddEpreuve($db, $nom, $date, $cycle, $annee, $matiere, $semestre);
                            }
                        ?>
                    </div>
                </form>
            </div>
        </div>

</body>

</html>