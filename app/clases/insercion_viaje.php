<?php
include 'check_admin_loged_in.php';
include '../clases/database_connection.php';

if (isset($_POST['confirm_insercion'])) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $precio = $_POST['precio'];
    $destacado = isset($_POST['destacado']) ? 1 : 0;
    $tipo_viaje = $_POST['tipo_viaje'];
    $plazas = $_POST['plazas'];
    
    //IMAGEN
    $nombre_archivo = $_FILES['imagen_archivo']['name'];
    $ruta_temporal = $_FILES['imagen_archivo']['tmp_name'];
    
    $directorio = "../assets/images/";
    $ruta_final = $directorio . basename($nombre_archivo);
    
    $check = getimagesize($ruta_temporal);
    
   
    if ($check === false) {
        echo "El fichero no es una imagen";
    }
    
    if (!(move_uploaded_file($ruta_temporal, $ruta_final))) {
        echo "No se ha cargado la imagen correctamente";
    }
    
    try {
        $sqlInsert = "INSERT INTO Viajes (titulo, descripcion, fecha_inicio, fecha_fin, precio, destacado, tipo_viaje, plazas, imagen) 
                      VALUES (:titulo, :descripcion, :fecha_inicio, :fecha_fin, :precio, :destacado, :tipo_viaje, :plazas, :imagen)";
        
        $stmt = $conn->prepare($sqlInsert);
        
        $viaje = [
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':fecha_inicio' => $fecha_inicio,
            ':fecha_fin' => $fecha_fin,
            ':precio' => $precio,
            ':destacado' => $destacado,
            ':tipo_viaje' => $tipo_viaje,
            ':plazas' => $plazas,
            ':imagen' => $ruta_final
        ];
        
        $insert = $stmt->execute($viaje);
        
        if ($insert) {
            header("Location: ../admin/admin_page.php");
            exit();
        }
    } catch (Exception $ex) {
        echo "Error al insertar: " . $ex->getMessage();
    }
}