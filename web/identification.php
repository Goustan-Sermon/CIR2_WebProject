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
    <!-- stack overflow -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
        integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">


    <title>identification</title>
</head>

<body>
    <!--------------------------- Navbar enseignant ---------------------------------------------------->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <!--------------------------- ISEN + type de page ---------------------------------------------------->
            <a href="identification.php"><img src="ISEN-blanc.png" style="width : 4.5rem; margin-right : 8px" class="img-fluid"></a>
            <a class="navbar-brand" href="identification.php">Identification</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
            <span class="material-symbols-outlined logo" style="font-size: 3rem">
                login
            </span>
            Identification
        </div>

        <!--------------------------- Form de connection ---------------------------------------------------->
        <div class="connection">
            <!--------------------------- Yncrea ---------------------------------------------------->
            <div class="text-center">
                <img src="logo-yncrea-slider.png" class="img-fluid yncrea">
            </div>
            <h2 class="text-center ">Connexion à votre espace</h2>
            <p class="text-center" style="color : grey">Bienvenue ! Veuillez rentrer vos informations.</p>
            <!--------------------------- Infos ---------------------------------------------------->
            <form class="form-identification">
                <div class="mb-2">
                    <label for="exampleInputEmail1" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="InputEmail" placeholder="Entré votre E-mail">
                </div>
                <div class="mb-2">
                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="InputPassword"
                        placeholder="Entré votre mot de passe">
                </div>
                <!--------------------------- Souvenir +  oublier ---------------------------------------------------->
                <div class="mb-2 form-check custom-control custom-checkbox" style=" margin-top: 20px;">
                    <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                    <label class="custom-control-label d-flex justify-content-between" for="exampleCheck1">
                        Se souvenir de moi
                        <a class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover  "
                            href="#">Mot de passe oublier</a>
                    </label>
                </div>
                <style>
                .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
                    background-color: red;
                }
                </style>
                <!--------------------------- Se connecter ---------------------------------------------------->
                <button type="submit" class="btn btn-danger"
                    style=" width:100% ; margin-top: 20px;">Seconnecter</button>
                <!--------------------------- Pas de compte ---------------------------------------------------->
                <div classe="sub" style="font-size: 13px; text-align : center; margin-top : 20px">
                    Vous n'avez pas de compte?
                    <a class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                        href="#">S'enregistrer</a>
                </div>
            </form>
        </div>
        <div class="btn-group" role="group" style="margin : 180px auto">
            <a type="button" class="btn btn-outline-danger" href="acceuil-enseignant.php">Enseignant</a>
            <a type="button" class="btn btn-outline-danger" href="acceuil-etudiant.php">Etudiant</a>
            <a type="button" class="btn btn-outline-danger" href="acceuil-admin.php">Administrateur</a>
        </div>
</body>

</html>