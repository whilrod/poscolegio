<?php
//Change credentials
$mysqli = new mysqli('localhost', 'username', 'pass', 'database');
if($mysqli->connect_error){
    die('Error en la conexion' . $mysqli->connect_error);
    
}
?>