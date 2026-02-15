<?php

//include "check_loged_in.php";

require_once "../clases/database_connection.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, introduce tu usuario.";
    } else {
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, introduce tu contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validar credenciales
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password FROM usuarios WHERE username = :username";
        
        if(($stmt = $conn->prepare($sql))){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = $username;
            
            if($stmt->execute()){
                // comprobamos si el usuario existe
                if($stmt->rowCount() == 1){
                    if(($row = $stmt->fetch())){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        
                        // comprobamos si contraseña introducida es correcta
                        if(password_verify($password, $hashed_password)){
                            // Contraseña correcta, iniciamos sesión
                            session_start();
                            
                            // Guardamos datos en variables de sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirigir a la página principal
                            if ($username === "admin") {
                                header("Location: ../admin/admin_page.php");
                            } else {
                                header("Location: ../public/welcome.php");
                            }
                        } else {
                            $login_err = "Usuario o contraseña no válidos.";
                        }
                    }
                } else {
                    $login_err = "Usuario o contraseña no válidos.";
                }
            } else {
                echo "Algo salió mal";
            }
        }
    }
}
