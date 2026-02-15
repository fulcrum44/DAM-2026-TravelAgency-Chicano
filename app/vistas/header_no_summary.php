<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <div class="container">
        <div class="logo_menu">
            <a href="<?php (($_SESSION["username"] ?? "") === "admin")? '../admin/admin_page.php' : 'welcome.php' ?>">
                <img src="../assets/logo.png" width="150"/>
            </a>
            <?php include "nav_menu.php"?>
        </div>
    </div>
</header>