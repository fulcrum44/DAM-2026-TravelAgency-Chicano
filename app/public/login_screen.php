<?php 

include "../clases/check_loged_in.php";
include "../clases/login_process.php" ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login - Dodo Travel</title>
        <link rel="stylesheet" href="http://localhost/AgenciaViajes/app/assets/styles.css">
    </head>
    <body>
        <div class="form_data">
            <h2>Iniciar Sesión</h2>
            <p>Por favor, introduce tus credenciales para acceder.</p>

            <?php 
            if(!empty($login_err)){
                echo '<div style="background-color: #ffab91; color: white; padding: 10px; border-radius: 10px; margin-bottom: 20px; text-align: center;">' . $login_err . '</div>';
            }        
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <label>Usuario</label>
                    <input type="text" name="username" class="<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span><?php echo $username_err; ?></span>
                </div>    
                
                <div>
                    <label>Contraseña</label>
                    <input type="password" name="password" class="<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span><?php echo $password_err; ?></span>
                </div>

                <div>
                    <input type="submit" value="Entrar">
                </div>
                
                <p>¿No tienes cuenta? <a href="register_screen.php">Regístrate ahora</a>.</p>
            </form>
        </div>    
    </body>
</html>