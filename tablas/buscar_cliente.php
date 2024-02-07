<?php

require '../server/serverConexion.php';
$documento= $_POST['documento'];
// Lee el cuerpo de la solicitud
$json = file_get_contents('php://input');
//echo $json;
// Decodifica el JSON
//$dato = json_decode($json, true);
// Obtener el valor del parámetro documento desde la solicitud POST
//$documento = $dato['documento'] ?? '';
//echo "el documento:".$documento;
// Consulta SQL para buscar al cliente


$sql = "SELECT id_cliente,nombre, correo FROM clientes WHERE documento = '$documento'";
//echo $sql;
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
   // Obtener datos del cliente
   $row = $result->fetch_assoc();
   $clienteData = [
      'id_cliente' => $row['id_cliente'],
      'nombre' => $row['nombre'],
      'correo' => $row['correo'],
      // Agrega otros campos según sea necesario
   ];
   
   echo json_encode($clienteData);
} else {
   // No se encontró al cliente, devolver un array vacío
   echo json_encode([]);
}

$mysqli->close();

?>