<?php 

    require '../server/serverConexion.php';
  
    
    $item = strtoupper($_POST['item']);
    $tipo = strtoupper($_POST['tipo']);
    $descripcion = strtoupper($_POST['descripcion']);
    $genero = strtoupper($_POST['genero']);
    $talla = strtoupper($_POST['talla']);
    //$precio = $_POST['precio'];
    $almacen = $_POST['almacen'];
    $bodega = $_POST['bodega'];
    //echo $almacen;
    //echo $bodega;
    $sql="UPDATE creaProducto SET cantidadb='$bodega' WHERE item='$item'";
    //  echo $sql; 
    $resultado = $mysqli->query($sql);

    $sql2="UPDATE creaProducto SET cantidada='$almacen' WHERE item='$item'";
    $resultado2 = $mysqli->query($sql2);
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
				    
					<?php if($resultado2) { 
					//echo $descripcion;
					//$_POST['cantidadVendida']=0; ?>
						<h3>Stock Editado Correctamente</h3>
						<?php } else { ?>
						<h3>ERROR AL EDITAR</h3>
					<?php } ?>
				
				
			    <div calss="row" style="text-align:center">		    
					<a href="https://uniformescolegio.000webhostapp.com/tablas/mueveMercancia.php" class="btn btn-primary">Regresar</a>
					
				</div>
				</div>
			
		</div>
	<script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>  
    <script type="text/javascript">
   //Redireccionamiento tras 5 segundos
   var link = document.getElementById('link');
   
   setTimeout( function() { window.location.href = "./mueveMercancia.php"; }, 100 )    
</script>
	</body>
</html>