<?php
session_start();
if(!isset($_SESSION['id'])OR $_SESSION['statut'] != 'admin'){
    header('Location: ../identification.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link href="../file.css" rel="stylesheet">
    <meta charset="utf-8">

    <!-- CSS -->
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <!-- Google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>créer un étudiant</title>
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
                        <a class="nav-link " href="creer-un-compte.php">
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
                            Créer une epreuve
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
                account_circle
            </span>
            Créer un étudiant
        </div>
        <!--------------------------- form  ---------------------------------------------------->
        <div class="blocks justify-content-evenly">
            <!--------------------------- contenue  ---------------------------------------------------->
            <div class="mb-2 align-items-baseline align-self-baseline">
                <div class="text-body-tertiary h2">
                    Les étudiants existants
                </div>
                <!-- Exemple -->
                <div class="tableform">
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead style="color : #dc3545">
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Classe</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                                require_once('../../php/database.php');

                                // Enable all warnings and errors.
                                ini_set('display_errors', 1);
                                error_reporting(E_ALL);
                    
                                // Database connection.
                                $db = dbConnect();

                                // Get all semesters.
                                $etudiants = dbGetPersonnesName($db);

                                foreach ($etudiants as $etudiant) {
                                    $id_classe = dbGetClasseFromEtudiantByPrenomAndNomInPersonne($db, $etudiant['prenom'], $etudiant['nom']);
                                    $classe = getClasseNameById($db, $id_classe);
                                    echo '<tr>';
                                    echo '<td>' . $etudiant['nom'] . '</td>';
                                    echo '<td>' . $etudiant['prenom'] . '</td>';
                                    echo '<td>' . $classe[0]['cycle'] .$classe[0]['annee'] . '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mb-2 align-items-center align-self-center">

                <div class="titre d-flex flex-column mb-2 align-items-center align-self-center text-body-tertiary h2">
                    Entrer les informations
                </div>
                <?php
                    if(isset($_POST['add']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mailconf']) && isset($_POST['mdp']) && isset($_POST['mdpconf']) && $_POST['mailconf'] == $_POST['mail'] && $_POST['mdp'] == $_POST['mdpconf']){
                        echo "<p class='alert alert-success'>Élève ajouté avec succès !</p>";
                    } else if(isset($_POST['add']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mailconf']) && isset($_POST['mdp']) && isset($_POST['mdpconf']) && $_POST['mailconf'] == $_POST['mail'] && $_POST['mdp'] != $_POST['mdpconf']){
                        echo "<p class='alert alert-danger'>Les mots de passe ne correspondent pas !</p>";
                    } else if(isset($_POST['add']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mailconf']) && isset($_POST['mdp']) && isset($_POST['mdpconf']) && $_POST['mailconf'] != $_POST['mail'] && $_POST['mdp'] == $_POST['mdpconf']){
                        echo "<p class='alert alert-danger'>Les mails ne correspondent pas !</p>";
                    } else if(isset($_POST['add']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mailconf']) && isset($_POST['mdp']) && isset($_POST['mdpconf']) && $_POST['mailconf'] != $_POST['mail'] && $_POST['mdp'] != $_POST['mdpconf']){
                        echo "<p class='alert alert-danger'>Les mails et les mots de passe ne correspondent pas !</p>";
                    }
                ?>
                <form action="creer-un-etudiant.php" method="post">
                    <div class="d-flex flex-column justify-content-center">
                        <div class="p-2">
                            <label for="nom" class="form-label">Nom*</label>
                            <input type="text" class="form-control" id="nom" name="nom" aria-describedby="emailHelp"
                                placeholder="Nom" required>
                        </div>
                        <div class="p-2">
                            <label for="prenom" class="form-label">Prénom*</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
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
                            </div>
                        </div>
                        <div class="p-2">
                            <label for="telephone" class="form-label">Téléphone*</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Téléphone">
                        </div>
                        <div class="p-2">
                            <label for="email" class="form-label">Mail*</label>
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="Mail" required>
                        </div>
                        <div class="p-2">
                            <label for="email" class="form-label">Mail (confirmation)*</label>
                            <input type="email" class="form-control" id="mailconf" name="mailconf"
                                placeholder="Confirmez le mail" required>
                        </div>
                        <div class="p-2">
                            <label for="mdp" class="form-label">Mot de passe*</label>
                            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe"
                                required>
                        </div>
                        <div class="p-2">
                            <label for="mdp" class="form-label">Mot de passe (confirmation)*</label>
                            <input type="password" class="form-control" id="mdpconf" name="mdpconf"
                                placeholder="Confirmez le mot de passe" required>
                        </div>
                        <!--
                        <div class="p-2">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        -->
                        <button type="submit" name="add" class="btn btn-danger">Créer un étudiant</button>
                    </div>
                </div>
                <?php
                    require_once('../../php/database.php');

                    // Enable all warnings and errors.
                    ini_set('display_errors', 1);
                    error_reporting(E_ALL);
        
                    // Database connection.
                    $db = dbConnect();

                    if(isset($_POST['add']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mailconf']) && isset($_POST['mdp']) && isset($_POST['mdpconf'])){
                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $telephone = $_POST['telephone'];
                        $mail = $_POST['mail'];
                        $mailconf = $_POST['mailconf'];
                        $mdp = $_POST['mdp'];
                        $mdphash = password_hash($mdp, PASSWORD_DEFAULT);
                        $mdpconf = $_POST['mdpconf'];
                        $annee = $_POST['annee'];
                        $cycle = $_POST['cycle'];
                        if($mdpconf != $mdp || $mail != $mailconf){
                            return 0;
                        }
                        addPersonne($db, $nom, $prenom, $mail, $mdphash, $telephone);
                        $id_classe = getClasseId($db, $annee, $cycle);
                        addEtudiant($db, $mail, $id_classe[0]['id_classe']);
                    }
                    ?>
            </form>
            <?php
                if(isset($_POST['add'])){
                    echo"<meta http-equiv=\"refresh\" content=\"0\">";
                }
            ?>
        </div>
    </div>
</body>

</html>