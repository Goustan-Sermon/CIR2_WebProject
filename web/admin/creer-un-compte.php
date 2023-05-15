<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location: identification.php');
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
    <title>créer un compte</title>
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
                            Créer une preuve
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
            Créer un compte
        </div>
        <!--------------------------- contenue  ---------------------------------------------------->
        <div class="titre d-flex flex-column mb-2 align-items-center align-self-center text-body-tertiary h2">
            Entrer les informations
        </div>
        <form action="creer-un-compte.php" method="post">
            <div class="d-flex justify-content-center">
                <div class="p-2">Enseignant</div>
                <div class="p-2">
                    <div class="form-check form-switch form-check-reverse" for="etu">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" name="etu">
                    </div>
                </div>
                <div class="p-2">Etudiant</div>
            </div>

            <div class="d-flex flex-column justify-content-center">
                <div class="p-2">
                    <label for="nom" class="form-label">Nom*</label>
                    <input type="text" class="form-control" id="nom" name="nom" aria-describedby="emailHelp"
                        placeholder="Nom">
                </div>
                <div class="p-2">
                    <label for="prenom" class="form-label">Prénom*</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
                </div>
                <?php
                    if(!empty($_POST['etu'])){
                        echo '<div class="p-2">ok</div>';
                    }

                ?>
                <div class="p-2">
                    <label for="telephone" class="form-label">Téléphone*</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Téléphone">
                </div>
                <div class="p-2">
                    <label for="email" class="form-label">Mail*</label>
                    <input type="email" class="form-control" id="mail" name="mail" placeholder="Mail">
                </div>
                <div class="p-2">
                    <label for="email" class="form-label">Mail (confirmation)*</label>
                    <input type="email" class="form-control" id="mailconf" name="mailconf"
                        placeholder="Confirmez le mail">
                </div>
                <div class="p-2">
                    <label for="mdp" class="form-label">Mot de passe*</label>
                    <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe">
                </div>
                <div class="p-2">
                    <label for="mdp" class="form-label">Mot de passe (confirmation)*</label>
                    <input type="password" class="form-control" id="mdpconf" name="mdpconf"
                        placeholder="Confirmez le mot de passe">
                </div>
                <div class="p-2">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>
                <button type="submit" name="add" class="btn btn-outline-danger">Créer un enseignant</button>
            </div>
            <?php
                require_once('../../php/database.php');

                // Enable all warnings and errors.
                ini_set('display_errors', 1);
                error_reporting(E_ALL);
    
                // Database connection.
                $db = dbConnect();
            
                if(isset($_POST['add'])){
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    if(!empty($_POST['etu'])){
                        $etu = 1;
                    }else{
                        $etu = 0;
                    }
                    $telephone = $_POST['telephone'];
                    $mail = $_POST['mail'];
                    $mailconf = $_POST['mailconf'];
                    $mdp = $_POST['mdp'];
                    $mdpconf = $_POST['mdpconf'];
                    $photo = $_POST['photo'];
                    echo $nom;
                    echo $prenom;
                    echo $etu;
                }?>
        </form>
    </div>
</body>

</html>