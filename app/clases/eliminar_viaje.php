<?php

include 'check_admin_loged_in.php';
include 'database_connection.php';

$id = $_GET['id'] ?? "";

if ($id == "") {
    die("ID del viaje no proporcionado");
}


try {
    $sqlDelete = "DELETE FROM Viajes WHERE id = :id";
    $stmt = $conn->prepare($sqlDelete);
    
    $vDelete = $stmt->execute([':id' => $id]);

    if ($vDelete) {
        header("Location: ../admin/admin_page.php");
        exit();
    }

} catch (Exception $ex) {
    die("Error al eliminar: " . $ex->getMessage());
}

