<?php
require_once('../../php/database.php');
// Enable all warnings and errors.
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection.
$db = dbConnect();
$test = getClassementOfEtudiantBySemestreBymatiere($db, '6', '5', '5', '3', '4');
print_r($test);
?>