<?php
	require '../server/serverConexion.php';
	
	$id = $_GET['item'];
	
	$sql = "SELECT * FROM creaProducto WHERE item = '$id'";
	$resultado = $mysqli->query($sql);
	//$row = $resultado->fetch_array(MYSQLI_ASSOC);
	//$elitem=$row['item'];
	//$sql = "SELECT * FROM productos WHERE item = '$elitem'";
	//$resultado = $mysqli->query($sql);
	$row2 = $resultado->fetch_array(MYSQLI_ASSOC);
	$item=$row2['item'];
	$tipo=$row2['tipo'];
	$descripcion=$row2['descripcion'];
	$genero=$row2['genero'];
	$talla=$row2['talla'];
	$precio=$row2['precio'];
	
	$producto= $row2['item'] ." ".$row2['descripcion'] ." ".$row2['genero']." TALLA: ".$row2['talla'];
?>
<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/normaliza.css">
    <!---<link href="../css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
   <!--- <link rel="stylesheet" href="../css/estilotablas.css">-->
    <link rel="stylesheet"  type="text/css" href="../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"	
	</head>
	
	<body>
         <div><p>&nbsp;</p></div>
			
    <div class="signUp_user caja col-sm-4">
        <div class="container_signUp_user">
            
            <div class="table table-dark">        
                	
			<div class="">
				<h3 style="text-align:center">EDITAR PRECIO</h3>
			</div>
			
					
                <form class="form-horizontal" method="POST" action="guardaprecio.php" autocomplete="off">
				<div class="form-group">
				    <div class="">
				    <label for="nombre" class="col control-label"><?php echo $producto; ?></label>
				    </div>
				    <div class="">
				<label for="nombre" class="col control-label"><?php echo " Precio: $".$row2['precio']; ?> </label>
				</div>
				
			
				<div class="col-md-8">
				
                <br>
                
    <div class="input-group mb-14">
        
  <span class="input-group-text">Total $
  <input name="precio" name="precio" id="precio" class="form-control col-sm-9" value=<?php echo $precio; ?> /></span>
  
  
                
              
</div> <br>
                
				</div>

				</div>
				<input type="hidden" id="categoria" name="categoria" value="uniforme" />
				
				
				<input type="hidden" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" />

				<input type="hidden" id="item" name="item" value="<?php echo $row2['item']; ?>" />
				<input type="hidden" id="tipo" name="tipo" value="<?php echo $row2['tipo']; ?>" />
				<input type="hidden" id="genero" name="genero" value="<?php echo $row2['genero']; ?>" />
				<input type="hidden" id="talla" name="talla" value="<?php echo $row2['talla']; ?>" />
				
				
				
			    <div class="form-group">
					<div class="col-sm-offset-6 col-sm-12 ">
						<a href="precios.php" class="btn btn-primary">Regresar</a>
						<button type="submit" class="btn btn-success">Guardar</button>
					</div>
				</div> 
				<div class="">
				    <?php 
				    
                   date_default_timezone_set('America/Bogota');
                   echo date("F j, Y, g:i a");?> 
				</div>
			</form>
            </div>
           
       
    </div>
    
			
			
		</div>

		    <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="main.js"></script>
	</body>
</html>