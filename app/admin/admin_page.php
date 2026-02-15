<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["username"] !== "admin") {
    header("location: login_screen.php");
    exit;
}

include '../clases/database_connection.php';

$vista = isset($_GET['vista']) ? $_GET['vista'] : 'lista';

if ($vista === "lista") {
    include 'admin_page_list.php';
} else {
    include 'admin_page_table.php';
}