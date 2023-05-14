<?php
require_once('../../php/database.php');
// Enable all warnings and errors.
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection.
$db = dbConnect();
addAppreciation($db, '1', '1', '1', 'super');
?>