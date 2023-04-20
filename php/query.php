<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'database.php';

$connection = dbConnect();

echo 'Connected to database';
print_r (dbGetPersonnes($connection));


?>