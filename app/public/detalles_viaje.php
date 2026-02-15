<?php
// Validamos que llegue un ID
if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: welcome.php");
    exit;
}

include '../clases/database_connection.php';

try {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Viajes WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    
    $viaje = $stmt->fetch(PDO::FETCH_ASSOC);

    // volvemos a inicio si la consulta falla
    if(!$viaje){
        header("Location: welcome.php");
        exit;
    }

} catch (Exception $ex) {
    die("Error: " . $ex->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $viaje['titulo'] ?> - Dodo Travel</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <?php include '../vistas/header_no_summary.php' ?>

    <div class="container">
        <div class="detalle-card">
            
            <div class="detalle-header">
                <h1><?= $viaje['titulo'] ?></h1>
                <span class="precio-tag"><?= $viaje['precio'] ?>€</span>
            </div>

            <div class="detalle-grid">
                <div class="detalle-img">
                    <img src="<?= $viaje['imagen'] ?>" alt="Foto de <?= $viaje['titulo'] ?>">
                </div>

                <div class="detalle-info">
                    <div class="info-bloque">
                        <h3>📅 Fechas</h3>
                        <p>Del <strong><?= $viaje['fecha_inicio'] ?></strong> al <strong><?= $viaje['fecha_fin'] ?></strong></p>
                    </div>

                    <div class="info-bloque">
                        <h3>🌍 Tipo de Viaje</h3>
                        <p><?= $viaje['tipo_viaje'] ?></p>
                    </div>

                    <div class="info-bloque">
                        <h3>👥 Plazas</h3>
                        <p><?= $viaje['plazas'] ?> disponibles</p>
                    </div>
                    
                    <a href="#" class="boton-reservar">Solicitar Reserva</a>
                </div>
            </div>

            <div class="detalle-descripcion">
                <h3>Sobre este viaje</h3>
                <p><?= $viaje['descripcion'] ?></p>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <a href="index.php" class="boton-volver">⬅ Volver al listado</a>
            </div>

        </div>
    </div>

    <?php include '../vistas/footer.php' ?>
</body>
</html>
