<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación</title>
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
    				<h2 style="text-align:center">Facturacion</h2><br>
    				
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
                <table id="facturas" style="width:100%" class="table table-striped table-bordered table-condensed">
            <thead class="text-center">
              <tr>
              <th class="" >ID.</th>
              <th>Factura</th>
              <th>Cliente</th>
              <th>Descripcion</th>
              <th>Fecha</th>
              <th>Pago Parcial</th>
              <th>Valor Factura</th>
              <th>Saldo Pendiente</th>
              <th>Estado Factura</th>
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
    $('#facturas').DataTable({
        "order": [[1, "desc"]],
        "language": {
            // ... Configuración de idioma ...
        },
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "../server/serverfacturas.php",
        "columns": [
        { "id": "id" },
        { "numerofactura": "numerofactura" },
        { "cliente": "cliente" },
        {
    "numeroventa": "numeroventa",
    "render": function (data, type, row) {
                // Verificar si data no es nulo o indefinido
                if (data) {
                    try {
                        // Intentar parsear la cadena JSON
                        var numeroventaObject = JSON.parse(data);

                        // Verificar si numeroventaObject es un objeto
                        if (numeroventaObject && typeof numeroventaObject === 'object') {
                            var firstKey = Object.keys(numeroventaObject)[0];
                            var cantidada = numeroventaObject[firstKey].cantidada || "";
                            var item = numeroventaObject[firstKey].item || "";
                            var descripcion = numeroventaObject[firstKey].descripcion || "";
                            var detalle = numeroventaObject[firstKey].detalle || "";
                            var entrega = numeroventaObject[firstKey].entrega || "";
                            var precio = numeroventaObject[firstKey].precio || "";
                            // Acceder a las propiedades del objeto
                            return cantidada + " " + item + "<br/>" + descripcion + "<br/>" + 
                                detalle + " " + entrega + "<br/>" + precio;
                        }
                    } catch (error) {
                        console.error("Error al parsear JSON:", error);
                    }
                }
                return "";  // Puedes manejar el caso de objeto nulo como desees
            }
    
},

        { "fechafactura": "fechafactura" },
        {
            "abona": "abona",
            "render": function (data, type, row) {
                // Parsea los datos JSON y formatea la presentación
                var json = JSON.parse(data);
                var abonaInfo = "";
                for (var prop in json) {
                    if (json.hasOwnProperty(prop)) {
                        abonaInfo += prop + ": " + json[prop] + "<br/>";
                    }
                }
                return abonaInfo;
            }
        },
            { "valorfactura": "valorfactura" },
            { "saldopendiente": "saldopendiente" },
            { "estado_factura": "estado_factura" },
            {
            // Nueva columna "accion" con un enlace
            "accion": null,
            "render": function (data, type, row) {
                return "<td><a href='https://uniformescolegio.000webhostapp.com/tablas/reimp.php?factura=" + row[0] + "'><span class='btn btn-success'>Imprimir</span></a></td>";
            }
        }
            // Puedes agregar más columnas según tu estructura de datos
        ]
    });
});
</script>


</body>
</html>