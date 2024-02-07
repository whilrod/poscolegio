<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
      <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
   <link rel="stylesheet" href="../css/normaliza.css">
   <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet"  type="text/css" href="../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
   
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> 
      <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" src="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" src="https://cdn.datatables.net/searchpanes/2.0.2/css/searchPanes.dataTables.min.css">
    <link rel="stylesheet" src="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
    <link rel="stylesheet" src="https://cdn.datatables.net/searchbuilder/1.3.4/css/searchBuilder.dataTables.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Historial de Ventas</title>
  </head>
  <body>
      <div style="height:50px" class="banner"></div>
    <div class="container caja">
        
    <div class="">
            <h6>&nbsp</h6>
    				<h2 style="text-align:center">Historial de Ventas</h2><br>
    </div>
        <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <a href="https://uniformescolegio.000webhostapp.com/" class="btn btn-primary">Regresar</a>
            </div>    
        </div>    
    </div>
    <div>&nbsp;</div>
    
          <div class="container caja">
      <div class="row">
        <div class="col-lg-12">
          <div class="table-responsive">
 <table id="ventas"  class="table table-hover table-striped table-bordered table-condensed" style="width:100%">
    <thead class="text-center">
              <tr>
              <th>No. VENTA</th>
              <th>FECHA</th>
              <th>REF.</th>
              <th>CATEGORIA</th>
              <th>DESCRIPCION</th>
              <th>GENERO</th>
              <th>TALLA</th>
              <th>PRECIO</th>
              <th>CANTIDAD</th>
              <th>TOTAL</th>
              <th>ESTADO</th>
              
              
              
              
            </tr>
        </thead>
        <tbody>
       
        </tbody>
 
    </table>
    

          </div>
        </div>
      </div>
    </div>
      
      
      
   
</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div class="foot">
        Autor: Whilman Rodriguez
        <a href="mailto:whilrod@gmail.com">whilrod@gmail.com</a>
        
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    
    
    <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.3.4/js/dataTables.searchBuilder.min.js"></script>
 
    <script>
    $(document).ready(function() {
    $('#ventas').DataTable( {
        dom: 'Bfrltip',
        order: [[0, "desc"]],
        language:{
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
        buttons: [
            'excel', 'pdf', 'print'
        ],
        bProcessing: true,
		bServerSide: true,
		sAjaxSource: "../server/serverVentas.php",
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'All'],
        ],
    } );
} );</script>
  </body>
</html>
