<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: /web/identification.php");
?>
