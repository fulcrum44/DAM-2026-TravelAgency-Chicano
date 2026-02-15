<?php
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
        <div class="admin_table_title">
            <h2>Gestión de Viajes</h2>
            <div class="admin_view">
                <button type="button" class="vista">
                    <a class="view_icons" href="?vista=grid">
                        <span class="material-symbols-outlined" style="font-size: 18px">view_comfy_alt</span>
                    </a>
                </button>
                <button type="button" class="vista">
                    <a class="view_icons" href="?vista=lista">
                        <span class="material-symbols-outlined">list</span>
                    </a>
                </button>
            </div>
        </div>
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
                    <a class="boton_modificar" href="../admin/modificar_viaje.php?id=<?=$viaje['id']?>">Modificar</a>
                    <a class="boton_eliminar" href="javascript:void(0)" onclick="abrirModalEliminacion(<?=$viaje['id']?>)">Eliminar</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        
        <h2 class="admin_table_title">Gestión de Usuarios</h2>
        <table class="admin_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = $stmtUsuarios->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td>#<?= $usuario["id"] ?></td>
                    <td><strong><?= $usuario["username"] ?></strong></td>
                    <td><?= $usuario["created_at"] ?></td>
                    <td>
                        <?php if($usuario["username"] !== "admin"): ?>
                            <a class="boton_eliminar" href="#">Eliminar</a>
                        <?php else: ?>
                            <span style="color: grey;">Administrator</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
    <?php include '../vistas/footer.php'?>;

</body>
</html>