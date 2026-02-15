<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <ul>
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
            
            <?php if($_SESSION["username"] === "admin"): ?>
                <li><a href="../admin/admin_page.php">Home</a></li>
                <li><a href="../admin/nuevo_viaje.php">Crear Viaje</a></li>
                <li><strong>Admin</strong></li>
                
            <?php else : ?>
                
                <li><a href="welcome.php">Home</a></li>
                <li><a href="viajes.php">Viajes</a></li>
                <li><strong>Mi cuenta</strong></li>
                
            <?php endif; ?>

            
            <li><a href="../clases/logout.php">Cerrar Sesión</a></li>
            <li>
                <form action="buscar.php" method="GET" class="form_search">
                    <input type="text" name="buscador" placeholder="Buscar destino..." required>
                    <button type="submit"><span class="material-symbols-outlined">search</span></button>
                </form>
            </li>

        <?php else: ?>
            <li><a href="welcome.php">Home</a></li>
            <li><a href="viajes.php">Viajes</a></li>
            <li><a href="login_screen.php">Iniciar sesión</a></li>
            <li><a href="register_screen.php">Registrarse</a></li>
            <li>
                <form action="buscar.php" method="GET" class="form_search">
                    <input type="text" name="buscador" placeholder="Buscar destino...">
                    <button type="submit"><span class="material-symbols-outlined">search</span></button>
                </form>
            </li>
            
        <?php endif; ?>
    </ul>
</nav>

