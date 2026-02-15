<?php include '../clases/check_admin_loged_in.php'; ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dodo Travel</title>
        <link rel="stylesheet" href="../assets/styles.css">
    </head>
    <body>
        <?php include '../vistas/header_no_summary.php' ?>

        <div class="form_data">
            <h1>Nuevo Viaje</h1>
            <form action="../clases/insercion_viaje.php" method="POST" enctype="multipart/form-data">

                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" required>

                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" required>

                <label for="fecha_inicio">Fecha inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" required>

                <label for="fecha_fin">Fecha fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" required>

                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" required>

                <label for="tipo_viaje">Tipo de viaje</label>
                <input type="text" id="tipo_viaje" name="tipo_viaje" required>

                <label for="plazas">Plazas</label>
                <input type="number" id="plazas" name="plazas" placeholder="Número de plazas disponibles para el viaje" required>

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen_archivo" required>

                <label for="destacado"> ¿Viaje destacado?
                    <input type="checkbox" id="destacado" name="destacado" value="1">
                </label>

                <input type="submit" name="confirm_insercion" value="Añadir viaje">
            </form>
        </div>

        <?php include '../vistas/footer.php' ?>
    </body>
</html>