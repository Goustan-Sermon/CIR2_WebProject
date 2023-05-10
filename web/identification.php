
<?php
session_start();
require_once('../php/database.php');

// Enable all warnings and errors.
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Database connection.
$db = dbConnect();
$redirection=FALSE;
if (isset($_POST['connect'])){
    if(checkIdentification($db, $_POST['InputEmail'], $_POST['InputPassword'])){
        if(isset($_POST['btn-check'])) {
            setcookie('email',$_POST['InputEmail'],time()+365*24*3600);
            setcookie('password',$_POST['InputPassword'],time()+365*24*3600);
        }
        $personne = dbGetPersonne($db, $_POST['InputEmail']);   
        print_r($personne);
        $_SESSION['nom'] = $personne['nom'];
        $_SESSION['prenom'] = $personne['prenom'];
        $_SESSION['mail'] = $personne['mail'];
        $_SESSION['satut'] = getStatut($db, $_POST['InputEmail']);
            // $_SESSION['statut'] = 'etudiant';
            // print($_SESSION['statut']);
        // header('Location: http://localhost/php/CIR2_WebProject-1/web/acceuil-'.$_SESSION['satut'].'.php?id='.$_SESSION['mail']);
        exit;
    
    }
}
?>
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


    <title>identification</title>
</head>

<body>
    <!--------------------------- Navbar enseignant ---------------------------------------------------->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <!--------------------------- ISEN + type de page ---------------------------------------------------->
            <a class="navbar-brand" href="identification.php">
                <img src="images/navbar/ISEN-blanc.png" alt="Logo" style="width : 4.5rem; margin-right : 8px"
                    class="d-inline-block align-text-top">
                Inscription
            </a>
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
    </nav>

    <!--------------------------- Corps de la page ---------------------------------------------------->
    <div class="corps corps-enseignant d-flex flex-column mb-2">
        <!--------------------------- Titre + Logo A SUPPRIMPER ---------------------------------------------------->
        <div class="titre d-flex flex-column mb-2 align-items-center align-self-center">
            <span class="material-symbols-outlined logo" style="font-size: 3rem">
                <!-- login -->
            </span>
            <!-- Identification -->
        </div>

        <!--------------------------- Form de connection ---------------------------------------------------->
        <div class="connection">
            <!--------------------------- Yncrea ---------------------------------------------------->
            <div class="text-center">
                <img src="images/identification/logo-yncrea-slider.png" class="img-fluid yncrea">
            </div>
            <h2 class="text-center ">Connexion à votre espace</h2>
            <p class="text-center" style="color : grey">Bienvenue ! Veuillez rentrer vos informations.</p>
            <!--------------------------- Infos ---------------------------------------------------->
            <form class="form-identification" style="margin-bottom : 20px" method="post">
                <div class="mb-2">
                    <label for="exampleInputEmail1" class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="InputEmail" placeholder="Entrer votre E-mail">
                </div>
                <div class="mb-2">
                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="InputPassword"
                        placeholder="Entré votre mot de passe">
                </div>
                <!--------------------------- Se souvenir +  oublier ---------------------------------------------------->

                <div style="margin-top: 20px" class="d-flex justify-content-between">
                    <input type="checkbox" class="btn-check" id="btn-check-2-outlined" autocomplete="off">
                    <label class="btn btn-outline-danger" for="btn-check-2-outlined"
                        style="margin : 5px; padding : 6.5px"></label>
                    Se souvenir de moi
                    <a class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover  "
                        href="#">Mot de passe oublié</a>
                </div>
                <!--------------------------- Se connecter ---------------------------------------------------->
                <button type="submit" class="btn btn-danger" style=" width:100% ; margin-top: 20px;" name="connect">
                    Se connecter</button>
                <!--------------------------- Pas de compte ---------------------------------------------------->
                <div classe="sub" style="font-size: 13px; text-align : center; margin-top : 20px">
                    Vous n'avez pas de compte?
                    <a class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                        href="#">S'enregistrer</a>
                </div>
            </form>
            <!--######################### Erreurs ##################################################-->
            <?php
                // getPoste($db, '1');
                if (isset($_POST['connect'])){
                    if( $_POST['InputEmail'] == null and $_POST['InputPassword'] == null){
                        echo "<div class=\"alert alert-danger\" role=\"alert\">
                            Veuillez rentrer votre mot de passe et votre E-mail
                            </div>";
                    }
                    elseif( $_POST['InputEmail'] == null){
                        echo "<div class=\"alert alert-danger\" role=\"alert\">
                        Veuillez rentrer votre E-mail
                            </div>";
                    }
                    elseif( $_POST['InputPassword'] == null){
                        echo "<div class=\"alert alert-danger\" role=\"alert\">
                        Veuillez rentrer votre mot de passe
                            </div>";
                    }
                    // <!--------------------------- Dev ---------------------------------------------------->
                    else{
                        if(!checkIdentification($db, $_POST['InputEmail'], $_POST['InputPassword'])){
                            echo "<div class=\"alert alert-danger\" role=\"alert\">
                                Mot de passe ou E-mail invalid
                            </div>";
                        }
                    }
            }
            ?>

        </div>
        <div class="btn-group" role="group" style="margin : 180px auto">
            <a type="button" class="btn btn-outline-danger" href="acceuil-enseignant.php">Enseignant</a>
            <a type="button" class="btn btn-outline-danger" href="acceuil-etudiant.php">Etudiant</a>
            <a type="button" class="btn btn-outline-danger" href="acceuil-admin.php">Administrateur</a>
        </div>



</body>

</html>