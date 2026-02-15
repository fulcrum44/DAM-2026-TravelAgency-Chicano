<?php

session_start();
 
$_SESSION = array();
 
session_destroy();

// volvemos a pagina principal
header("location: ../public/index.php");
exit;

