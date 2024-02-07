<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diario y Sudaderas</title>
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="../css/normaliza.css">
    <!---<link href="../css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
   <!--- <link rel="stylesheet" href="../css/estilotablas.css">-->
    <link rel="stylesheet"  type="text/css" href="../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> 
    
	<!---	<link href="../css/bootstrap-theme.css" rel="stylesheet">
    <link href="../css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilotablas.css">-->
</head>
<body>
<div style="height:50px" class="banner"></div>
    <div class="container caja">
        
    <div class="">
            <h6>&nbsp</h6>
    				<h2 style="text-align:center">Uniformes de diario y sudaderas</h2><br>
    				
    			</div>
    			
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <a href="https://uniformescolegio.000webhostapp.com/" class="btn btn-primary">Regresar</a>
            <!-- <a href="tablas/calzado.php"><img src="../images/carts.png" width="40" /></a>
            <a href="tablas/calzado.php"><img src="../images/trolley.png" width="40" /></a>
            <a href="tablas/calzado.php"><img src="../images/shopping-cart.png" width="40" /></a>-->
            <a href="./carrito.php"><img src="../images/shopping-cart2.png" width="40" /></a>
            <br>&nbsp;
            </div>
           
        </div>    
    </div>			
    			
    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="uniformes" style="width:100%" class="table table-striped table-bordered table-condensed">
            <thead class="text-center">
              <tr>
              <th class="" >REF.</th>
              <th>DESCRIPCION</th>
              <th>SEXO</th>
              <th>TALLA</th>
              <th>PRECIO</th>
              <th>BODEGA</th>
              <th>ALMACEN</th>
              <th></th>
              
            </tr>
            </thead>
            <tbody>
    
            </tbody>
          </table>               
            </div>
            </div>
        </div>  
    </div>
    
  

<div class="foot">
        Autor: Whilman Rodriguez
        <a href="mailto:whilrod@gmail.com">whilrod@gmail.com</a>
        
    </div>

<!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="main.js"></script>

  <!--
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>	
<script src="../js/jquery.dataTables.min.js"></script>-->
<script>
 $(document).ready(function(){
				$('#uniformes').DataTable({
					"order": [[1, "asc"]],
					"language":{
					"lengthMenu": "Mostrar _MENU_ registros por pagina",
					"info": "Mostrando pagina _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrada de _MAX_ registros)",
						"loadingRecords": "Cargando...",
						"processing":     "Procesando...",
						"search": "Buscar:",
						"zeroRecords":    "No se encontraron registros coincidentes",
						"paginate": {
							"next":       "Siguiente",
							"previous":   "Anterior"
						},					
					},
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "../server/serverSide.php"
				});	
			});
</script>


</body>
</html>