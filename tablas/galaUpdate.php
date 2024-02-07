<?php
	
	require '../server/serverConexion.php';
	
$item = $_POST['item'];
	$descripcion=$_POST['descripcion'];
	$cantidad = $_POST['cantidadVendida'];
	$valor = $_POST['valor'];
	$stock = $_POST['stock'];
	$formapago = $_POST['formapago'];
	$tipo = $_POST['tipo'];
	$genero = $_POST['genero'];
	$talla = $_POST['talla'];
	$precio = $_POST['precio'];
	//echo $tipo.$genero.$talla.$cantidad;
	//echo $item. " - ". $cantidad." - ". $stock;
	$cantidada=intval($stock)-intval($cantidad);
	//echo "=". $cantidada;
	$sql = "UPDATE gala SET cantidada='$cantidada' WHERE item = '$item'";
	$resultado = $mysqli->query($sql);
	
	$descripcion= strtoupper($descripcion);
    date_default_timezone_set('America/Bogota');
    $fechaventa= date("d-m-Y, h:i:s A");
	$sql2 = "INSERT INTO ventas (fecha_venta,item_venta,tipo_venta,descripcion_venta,genero_venta,talla_venta,precio_venta,cantidad_venta,valor_venta,forma_pago) VALUES ('$fechaventa','$item','$tipo','$descripcion','$genero','$talla','$precio','$cantidad','$valor', '$formapago')";
	$resultado2 = $mysqli->query($sql2);
?>

<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
   <!--- <link rel="stylesheet" href="../css/estilotablas.css">-->
    <link rel="stylesheet"  type="text/css" href="../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> 
	</head>
	
	<body>
		<div class="container">
			
				<div class="row" style="text-align:center">
				    
					<?php if($resultado) { 
					//echo $descripcion;
					$_POST['cantidadVendida']=0; ?>
						<h3>Venta realizada correctamente</h3>
						<?php } else { ?>
						<h3>ERROR AL REGISTRAR</h3>
					<?php } ?>
				
				
			    <div calss="row" style="text-align:center">		    
					<a href="gala.php" class="btn btn-primary">Regresar</a>
					
				</div>
				</div>
			
		</div>
	<script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>   
	</body>
</html>
