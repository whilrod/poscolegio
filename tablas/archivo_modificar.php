<?php
	require '../server/serverConexion.php';
	
	$id = $_GET['item'];
	
	$sql = "SELECT * FROM almacen WHERE item = '$id'";
	$resultado = $mysqli->query($sql);
	$row = $resultado->fetch_array(MYSQLI_ASSOC);
	$elitem=$row['item'];
	$sql = "SELECT * FROM productos WHERE item = '$elitem'";
	$resultado = $mysqli->query($sql);
	$row2 = $resultado->fetch_array(MYSQLI_ASSOC);
	$producto= $row2['item'] ." ".$row2['descripcion'] ." ".$row2['genero']." TALLA: ".$row2['talla'];
?>
<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/normaliza.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/bootstrap-theme.css" rel="stylesheet">
    <link href="../css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilotablas.css">	
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<h3 style="text-align:center">REALIZAR VENTA</h3>
			</div>
			
			<form class="form-horizontal" method="POST" action="archivo_update.php" autocomplete="off">
				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label"><?php echo $producto; ?></label>
					<label for="nombre" class="col-sm-2 control-label"><?php echo "Cantidas en Almacén: ".$row['cantidada']; ?> </label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="mod_act" name="mod_act" placeholder="Nombre" value="<?php echo $row['cantidada']; ?>" required>
					</div>
				</div>
				
				<input type="hidden" id="item" name="item" value="<?php echo $row['item']; ?>" />
				
	
		
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="uniformes.php" class="btn btn-primary">Regresar</a>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>