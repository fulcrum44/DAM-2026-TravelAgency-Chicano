<?php

include '../clases/database_connection.php';

try {
    $sqlViajes = "SELECT * FROM Viajes";
    $stmtViajes = $conn->query($sqlViajes);

    $sqlUsuarios = "SELECT id, username, created_at FROM Usuarios";
    $stmtUsuarios = $conn->query($sqlUsuarios);

} catch (Exception $ex) {
    die("Error: ". $ex->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="http://localhost/AgenciaViajes/app/assets/styles.css">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=list,search,view_comfy_alt" />
    <script src="http://localhost/AgenciaViajes/app/assets/js/scripts.js"></script>
</head>
<body>
    <?php include '../vistas/header_no_summary.php' ?>

    <div class="container">
        <h2>Viajes</h2>
        <div class='grid'>
            <?php while ($viaje = $stmtViajes->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="card">
                <?php if($viaje['destacado']): ?>
                    <div class="etiqueta_destacado">★ Destacado</div>
                <?php endif; ?>

                <img src="<?= $viaje["imagen"] ?>"/> 
                <div class="titulo_viaje"><?= $viaje["titulo"] ?></div>
                <div class="info_viajes">
                    <span><?= $viaje["fecha_inicio"] ?></span><br>
                    <span><strong><?= $viaje["precio"] ?>€</strong></span>
                </div>
                
                <div class="acciones">
                    <a class="boton_modificar" " href="detalles_viaje.php?id=<?=$viaje['id']?>">Ver Detalles</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    <?php include '../vistas/footer.php' ?>
</body>
</html>

