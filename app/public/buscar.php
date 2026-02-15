<?php
include '../clases/database_connection.php';

$busqueda = "";
$resultados = [];

if (isset($_GET['buscador'])) {
    $busqueda = trim($_GET['buscador']);
    
    try {
        $sql = "SELECT * FROM Viajes 
                WHERE titulo LIKE :busqueda 
                OR descripcion LIKE :busqueda 
                OR tipo_viaje LIKE :busqueda";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([':busqueda' => "%" . $busqueda . "%"]);
        
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $ex) {
        die("Error: " . $ex->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resultados de: <?= htmlspecialchars($busqueda) ?></title>
        <link rel="stylesheet" href="../assets/styles.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    </head>
    <body>
        <?php include '../vistas/header_no_summary.php' ?>

        <div class="container">
            <h1>Viajes: "<em><?= htmlspecialchars($busqueda) ?></em>"</h1>

            <?php if (count($resultados) > 0): ?>
                <div class='grid'>
                    <?php foreach ($resultados as $viaje): ?>
                    <div class="card">
                        <img src="<?= $viaje["imagen"] ?>"/> 
                        <div class="titulo_viaje"><?= $viaje["titulo"] ?></div>
                        <div class="info_viajes">
                            <span><?= $viaje["fecha_inicio"] ?></span><br>
                            <span><strong><?= $viaje["precio"] ?>€</strong></span>
                        </div>
                        <div class="acciones"">
                            <a class="boton_modificar" href="detalle_viaje.php?id=<?= $viaje['id'] ?>">Ver Detalles</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="info">
                    <h3>No hay viajes que coinicidan</h3>
                    <p>Busca otro destino o tipo de viaje</p>
                    <a href="viajes.php" class="boton_modificar">Ver todos los viajes</a>
                </div>
            <?php endif; ?>
        </div>

        <?php include '../vistas/footer.php' ?>
    </body>
</html>