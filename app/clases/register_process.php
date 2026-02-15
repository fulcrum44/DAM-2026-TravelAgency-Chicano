<?php

//include "check_loged_in.php";

// Incluimos tu conexión PDO
require_once "../clases/database_connection.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    // validación usuario
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, introduce un nombre de usuario.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "El usuario solo puede contener letras, números y guiones bajos.";
    } else {
        // Comprobar si el usuario ya existe usando PDO
        $sql = "SELECT id FROM usuarios WHERE username = :username";
        if (($stmt = $conn->prepare($sql))) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "Este nombre de usuario ya está cogido.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "¡Uy! Algo salió mal. Por favor, inténtalo de nuevo.";
            }
        }
    }
    
    // validación contraseña
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, introduce una contraseña.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    // 3. Validar confirmación de contraseña
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor, confirma la contraseña.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }

    // insertamos usuario
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        
        // El created_at suele ponerse automático en MySQL (CURRENT_TIMESTAMP), 
        // pero si quieres enviarlo desde PHP:
        $sql = "INSERT INTO usuarios (username, password, created_at) VALUES (:username, :password, :created_at)";

        if (($stmt = $conn->prepare($sql))) {
            // Encriptamos la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $now = date("Y-m-d H:i:s");

            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
            $stmt->bindParam(":created_at", $now, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Registro completado con éxito.";
                // Aquí podrías redirigir al login: header("location: login.php");
            } else {
                echo "Algo salió mal al insertar el usuario.";
            }
        }
    }
}
