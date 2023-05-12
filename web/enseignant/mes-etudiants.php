<?php
session_start();
if(!isset($_SESSION['mail'])){
    header('Location: identification.php');
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
    <title> mes étudiants</title>
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
                group
            </span>
            Mes étudiants
        </div>
        <!--------------------------- contenue ---------------------------------------------------->
        <!---------------------------affichae des classes avec les eleves ---------------------------------------------------->
       
    
        <div class="p-2">

        <select class="custom-select" required>
            <option value="">Tri</option>
            <option value="cir">Option 1</option>
            <option value="cgsi">Option 2</option>
            <option value="cest">Option 3</option>
        </select>
        
        <select class="custom-select" required>
            <option value="">Cycle</option>
            <option value="cir">CIR</option>
            <option value="cgsi">CGSI</option>
            <option value="cest">CEST</option>
        </select>
        <select class="custom-select" required>
            <option value="">Année</option>
            <option value="a1">A1</option>
            <option value="a2">A2</option>
            <option value="a3">A3</option>
            <option value="a2">M1</option>
            <option value="a3">M2</option>
        </select>      
        <select class="custom-select" required>
            <option value="">Matière</option>
            <option value="a1">Option 1</option>
            <option value="a2">Option 2</option>
            <option value="a3">Option 3</option>
            <option value="a2">Option 4</option>
            <option value="a3">Option 5</option>
        </select>
        <div class="d-flex flex-row-reverse">
            
            <button type="button" class="btn btn-danger" >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
            </svg>
            Rechercher</button>
            
        </div>
        
    
        
    </div>


        

        <div class="block ">
        <table class="table table table-striped"> <!--- permet d'alterner les colonnes de couleurs différentes -->
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Moyenne</th>
                    <th scope="col">Mail</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <th scope="row">1</th>
                    <td>CIR1</td>
                    <td>Text line</td>
                    <td>Edit</td>
                    <td>Edit</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>EST2</td>
                    <td>Text line</td>
                    <td>Edit</td>
                    <td>Edit</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>CSI3</td>
                    <td>Text line</td>
                    <td>Edit</td>
                    <td>Edit</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>EST2</td>
                    <td>Text line</td>
                    <td>Edit</td>
                    <td>Edit</td>
                </tr>
            </tbody>
        </table>
        </div>
        
                            
    </div>
    </div>

</body>

</html>
    </div>
    </div>

</body>

</html>