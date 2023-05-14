<?php
require_once('../../php/database.php');
// Enable all warnings and errors.
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection.
$db = dbConnect();
print(addAppreciationAndConsulter($db, '4', '1', '1', 'tb', '1'));
echo"test";
?>