<?php 

    require '../server/serverConexion.php';
  
    
    $item = $_POST['item'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $genero = $_POST['genero'];
    $talla = $_POST['talla'];
    $precio = $_POST['precio'];


    $sql="INSERT INTO productos (item, categoria, descripcion,genero,talla,precio) VALUES ('$item','$categoria', '$descripcion','$genero','$talla','$precio')";
   //	$sql = "SELECT * FROM usuarios WHERE username = '$username' AND password='$password'";
	$resultado = $mysqli->query($sql);

?>
<!DOCTYPE html>
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
					//$_POST['cantidadVendida']=0; ?>
						<h3>Producto Creado Correctamente</h3>
						<?php } else { ?>
						<h3>ERROR AL REGISTRAR</h3>
					<?php } ?>
				
				
			    <div calss="row" style="text-align:center">		    
					<a href="https://uniformescolegio.000webhostapp.com/tablas/ingresoMercancia.php" class="btn btn-primary">Regresar</a>
					
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
