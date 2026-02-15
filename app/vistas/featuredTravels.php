<?php
include '../clases/database_connection.php';

try {
    $sqlViajes = "
        SELECT *
        FROM Viajes
        WHERE destacado = TRUE;
        ";
    
    $stmt = $conn->query($sqlViajes);
    
} catch (Exception $ex) {
    die("Error de conexión: ". $ex->getMessage());
}

?> 

<div class="container">
    <div class='grid'>
        <?php while ($viaje = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="card">
            <img src="<?= $viaje["imagen"] ?>"/> <div class="titulo_viaje"><?= $viaje["titulo"] ?></div>
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





