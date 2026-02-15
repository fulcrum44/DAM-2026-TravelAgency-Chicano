<?php

session_start();

// comprobamos si estamos logueados como administrador
if(($_SESSION["username"] ?? "" )!== "admin"){
    header("Location: ../public/welcome.php");
    exit;
}