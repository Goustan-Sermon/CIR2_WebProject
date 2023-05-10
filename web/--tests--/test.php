<!DOCTYPE html>
<html lang="fr">

<head>
    <link href="test.css" rel="stylesheet">
    <meta charset="utf-8">
    <title> index </title>
</head>

<body>
<?php
    require_once('../../php/database.php');

    // Enable all warnings and errors.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    // Database connection.
    $db = dbConnect();
    $a=getStatut($db, 'test@gmail.com');
    print($a);
?>
</body>

</html>