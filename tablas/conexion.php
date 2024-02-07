<?php
    //$mysqli= new mysqli('localhost','root','password','sid3');
    function getConnexion(){
    $mysqli = new mysqli('localhost', 'id19519796_user_inventario', 'cynL@9G\]qBFdsIp', 'id19519796_inventario');
    if ($mysqli->connect_error){
        die('Error en la conexion'.$mysqli->connect_error);
    }
    return $mysqli;
    }
?>