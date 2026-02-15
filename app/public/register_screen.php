<?php 

include '../clases/check_loged_in.php';
include "../clases/register_process.php" ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link rel="stylesheet" href="http://localhost/AgenciaViajes/app/assets/styles.css">
    </head>
    <body>
        <div class="form_data">
            <h2>Registro</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="">
                    <label>Usuario</label>
                    <input type="text" name="username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>    
                <div class="">
                    <label>Contraseña</label>
                    <input type="password" name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="">
                    <label>Confirmar contraseña</label>
                    <input type="password" name="confirm_password" <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                
                <input type="submit" class="btn btn-primary" value="Registrarse">
                
                <p>¿Tienes una cuenta? <a href="login_screen.php">Inicia sesión</a>.</p>
            </form>
        </div>    
    </body>
</html>