<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: http://localhost/php/CIR2_WebProject-1/web/identification.php");
?>
