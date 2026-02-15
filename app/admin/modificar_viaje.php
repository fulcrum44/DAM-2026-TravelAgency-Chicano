<?php

include '../clases/check_admin_loged_in.php';
include '../clases/database_connection.php';

$id = $_GET['id'] ?? "";

if ($id == "") {
    die("ID del viaje no proporcionado");
}


try {
    $sqlViaje = "
        SELECT * FROM Viajes
        WHERE id = $id;
        ";
    
    $stmt = $conn->query($sqlViaje);
    
    $v = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    die("Error al modificar: ". $ex->getMessage());
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Dodo Travel</title>
        <link rel="stylesheet" href="http://localhost/AgenciaViajes/app/assets/styles.css">
    </head>
    <body>
        <div class="form_data">
            <h1>Modificar viaje</h1>
            <form action="../clases/modificacion_viaje.php" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="id" value="<?= $v['id'] ?>"/>
                
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" value="<?= $v['titulo'] ?>" required> <br><br>
                
                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" value="<?= $v['descripcion'] ?>" required> <br><br>
                
                <label for="fecha_inicio">Fecha inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?= $v['fecha_inicio'] ?>" required> <br><br>
                
                <label for="fecha_fin">Fecha fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" value="<?= $v['fecha_fin'] ?>" required> <br><br>
                
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" value="<?= $v['precio'] ?>" required> <br><br>
                
                <label for="destacado">Viaje destacado
                    <input type="checkbox" id="destacado" name="destacado" value="<?= $v['destacado']? '1' : '0'?>" <?= $v['destacado']? 'checked' : ''?> >
                </label>
                <br><br>
                
                <label for="tipo_viaje">Tipo viaje</label>
                <input type="text" id="tipo_viaje" name="tipo_viaje" value="<?= $v['tipo_viaje'] ?>" required> <br><br>
               
                <label for="plazas">Plazas</label>
                <input type="number" id="plazas" name="plazas" value="<?= $v['plazas'] ?>" required> <br><br>
                
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen_archivo">
                    
                <input type="submit" name="confirm_modificacion" value="Modificar viaje">
            </form>
        </div>
    </body>
</html>
