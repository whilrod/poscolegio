<?php

require '../server/serverConexion.php';
$documento= $_POST['documento'];
$nombre= $_POST['nombre'];
$correo= $_POST['correo'];
$fechacreacion= date("d-m-Y");
// Consulta para verificar si el documento ya existe
$sql = "SELECT documento FROM clientes WHERE documento=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $documento);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows < 1) {
    // El documento no existe, procede a la inserción
    $stmt->close();

    $sql2 = "INSERT INTO clientes (documento, nombre, correo, fecha_creacion) VALUES (?, ?, ?, ?)";
    $stmt2 = $mysqli->prepare($sql2);
    $stmt2->bind_param("ssss", $documento, $nombre, $correo, $fechacreacion);
    $stmt2->execute();
    $stmt2->close();
} else {
    // El documento ya existe, manejar según sea necesario
    echo "El documento ya existe en la base de datos.";
}


$mysqli->close();

?>