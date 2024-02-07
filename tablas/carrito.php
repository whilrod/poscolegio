<?php
    require '../server/serverConexion.php';
    $sql="SELECT * FROM carrito";
    $resultado = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="../css/normaliza.css">
    <!---<link href="../css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
   <!--- <link rel="stylesheet" href="../css/estilotablas.css">-->
    <link rel="stylesheet"  type="text/css" href="../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> 
    <link rel="stylesheet" href="modal.css">
	<!---	<link href="../css/bootstrap-theme.css" rel="stylesheet">
    <link href="../css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilotablas.css">-->
</head>
<body>
<div style="height:50px" class="banner"></div>
    <div class="container caja">
        
    <div class="">
            <h6>&nbsp</h6>
    				<h2 style="text-align:center">CARRITO DE COMPRAS</h2><br>
    				
    			</div>
    			
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <a href="https://uniformescolegio.000webhostapp.com/" class="btn btn-primary">Regresar</a>
            <!--<a href="./venta.php" class="btn btn-success">Realizar Venta</a>-->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#clienteModal">
   Realizar Venta
</button>
            <!-- <a href="tablas/calzado.php"><img src="../images/carts.png" width="40" /></a>
            <a href="tablas/calzado.php"><img src="../images/trolley.png" width="40" /></a>
            <a href="tablas/calzado.php"><img src="../images/shopping-cart.png" width="40" /></a>
            <a href="./carrito.php"><img src="../images/shopping-cart2.png" width="40" /></a>-->
            <br>&nbsp;
            </div>    
        </div>    
    </div>			
    			
    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="carrito" style="width:100%" class="table table-hover table-striped table-bordered table-condensed">
            <thead class="text-center">
              <tr class="">
              <th >ID</th>    
              <th  >REF.</th>
              <th  >DESCRIPCION</th>
              <th  >CANTIDAD</th>
              <th  >PRECIO</th>
              <th  >ESTADO ENTREGA</th>
              <th  ></th>
              </tr>
            </thead>
            <tbody>
<?php
    if($resultado-> num_rows > 0){
        $total=0;
        while ($row= $resultado->fetch_assoc()) {
            echo "<tr class=''><th>".$row["idcarrito"]."</th>";
            echo "<th>".$row["itemcarrito"]."</th>";
            echo "<th>".$row["descripcioncarrito"]."</th>";
            echo "<th>".$row["cantidadcarrito"]."</th>";
            echo "<th>".$row["preciocarrito"]."</th>";
            echo "<th>".$row["formapagocarrito"]."</th>";
            echo "<td><a href='borracarrito.php?item=".$row['idcarrito']."'><span class='btn btn-danger'>Eliminar</span></a></td>";
            echo "</tr>";
            $total=$total+intval($row["preciocarrito"]);
            
        }
        echo "<b><h2 style='color:green'>Total $".number_format($total,0)."</h2></b>";
    }
    
?>
            </tbody>
          </table>               
            </div>
            </div>
        </div>  
    </div>
    
   <div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="clienteModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
             
            <h5 class="modal-title" id="clienteModalLabel">Facturar</h5>
           <br>
            <label  class="modal-title">$<?php if (isset($total)) {
    // Si está definida, mostrar el número formateado
    echo number_format($total, 0);
} else {
    // Si no está definida, mostrar un mensaje alternativo o realizar otra acción
    echo "0--";
} ?></label>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                
               <span aria-hidden="true">&times;</span>
            </button>
            
            
         </div>
         
         <div class="modal-body">
             
             
            <!-- Formulario para ingresar datos del cliente -->
            <form id="clienteForm">
                <div class="cliente">
                    <label class="label">Datos del Cliente: </label><br>
                <input type="hidden" id="total" name="total" value="<?php if (isset($total)) {
    // Si está definida, mostrar el número formateado
    echo $total;
} else {
    // Si no está definida, mostrar un mensaje alternativo o realizar otra acción
    echo "0--";
} ?>" /> 
               <!-- Campos del formulario -->
               <label for="nombre">Documento:</label>
               <input type="number" id="documento" name="documento" onclick="limpia('documento')" required>
               <br/>
               <label for="nombre">Nombre:</label>
               <input type="text" id="nombre" name="nombre" onclick="limpia('nombre')" autocomplete="off" required >
               <br/>
               <label for="nombre">Correo:</label>
               <input type="email" id="correo" name="correo" onclick="limpia('correo')" autocomplete="off" required>
               <br/>
               <input type="hidden" id="elid" name="elid">
               <!-- Otros campos según tus necesidades -->
               </div>
               <div id="valores" class="valores">
               <label class="label" for="nombre">Valor Recibido:</label>
               <label class="label" for="formapago">Forma de pago</label>
               <input type="number" id="recibido1" name="recibido1" onblur="sale('recibido1')" onclick="entra()" oninput="restar()" autocomplete="off" required>
               <select name ="formapago1" id ="formapago1" class="form_control col-sm-11">
                    <option value="efectivo"selected>EFECTIVO</option>
                    <option value="nequi">NEQUI</option>
                    <option value="daviplata">DAVIPLATA</option>
                    <option value="tarjeta">TARJETA</option>
                </select>
               <input type="number" id="recibido2" name="recibido2" onblur="sale('recibido2')" onclick="entra2()" oninput="restar()" autocomplete="off" required>
               <select name ="formapago2" id ="formapago2" class="form_control col-sm-11">
                   <option value="ninguno" selected>NO SELECCIONADO</option>
                    <option value="efectivo">EFECTIVO</option>
                    <option value="nequi">NEQUI</option>
                    <option value="daviplata">DAVIPLATA</option>
                    <option value="tarjeta">TARJETA</option>
                </select>
               <label class="label saldo">Saldo Pendiente:</label>
               <input class="resultado" type="text" id="resultado" readonly />
               
               
               <br/>
               </div>
               <button type="submit" id="envia" name="envia" class="guardar btn btn-danger" disabled>Cobrar</button>
            </form>
         </div>
      </div>
   </div>
</div>
    
    <br>
  &nbsp;

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
<script>
   $(document).ready(function() {
    // Manejar el evento de ingreso del documento
    $('#documento').on('blur', function() {
        var documento = $(this).val().trim();
        //console.log("documento" + documento);
        if (documento !== '') {
            // Realizar solicitud al servidor para obtener datos del cliente
            $.ajax({
                url: 'buscar_cliente.php',
                method: 'POST',
                data: { documento: documento },
                dataType: 'json',
                success: function(data) {
                    //console.log("Respuesta del servidor:", data);
                    // Rellenar los demás campos con los datos obtenidos
                    if (data) {
                        $('#elid').val(data.id_cliente);
                        $('#nombre').val(data.nombre);
                        $('#correo').val(data.correo);
                        // Rellena otros campos según sea necesario
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error al buscar cliente:', textStatus, errorThrown);
                },
            });
        } else {
            $('#documento').val("0");
            $('#documento').focus();
            $('#recibido1').focus();
        }
    });

    $('#envia').on('click', function(event) {
        event.preventDefault();
        var validadocumento = document.getElementById('documento').value;
        if (validadocumento==""){
            document.getElementById('documento').focus();
            return;
        }
        // console.log("click");
        var formData = {
            documento: $('#documento').val(),
            nombre: $('#nombre').val(),
            correo: $('#correo').val(),
            elid: $('#elid').val(),
            recibido1: $('#recibido1').val(),
            recibido2: $('#recibido2').val(),
            formapago1: $('#formapago1').val(),
            formapago2: $('#formapago2').val(),
            resultado: $('#resultado').val(),
            total: $('#total').val()
            // Agregar otros campos según sea necesario
        };
        // console.log("formdata-->", formData);
        $('#clienteModal').modal('hide');
        $.ajax({
            url: 'venta.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(data) {
                console.log("Respuesta del servidor:", data);
                // Abre el PDF en una nueva ventana después de completar la llamada AJAX
                console.log("Descargado");
            },
            complete: function() {
                window.open('../../printer/TicketVenta.pdf', '_blank');
                window.location.href = './carrito.php';
            }
        });
    });

    var documento = $('#documento').val().trim();
    var recibido2 = $('#recibido2').val();
    if (recibido2 === "") {
        $('#recibido2').val("0");
    }
});

   
</script>
<script>
    function restar() {
        // Obtener los valores de los inputs
        var valorInput1 = parseFloat(document.getElementById('total').value) || 0;
        var valorInput2 = parseFloat(document.getElementById('recibido1').value)|| 0 ; // Aquí puedes establecer el valor que deseas restar
        var valorInput3 = parseFloat(document.getElementById('recibido2').value) || 0
        // Realizar la resta
        var resultado = valorInput1 - (valorInput2+valorInput3);
        if (resultado>=0){
             document.getElementById('resultado').style.color = 'blue';
             document.getElementById('valores').style.color = 'black';
             document.getElementById('valores').style.background = 'lightyellow';
        }else{
            document.getElementById('resultado').style.color = 'red';
            document.getElementById('valores').style.color = 'white';
            document.getElementById('valores').style.background = 'red';
        }
        // Actualizar el valor del segundo input
        document.getElementById('resultado').value = resultado;
        var valor=document.getElementById('total').value;
        if (valor>0){
            document.getElementById('envia').disabled = false; // para deshabilitar
        }else{
             document.getElementById('envia').disabled = true; // para deshabilitar
        }
        

    };
    
    function entra(){
         document.getElementById('recibido1').value = "";
         document.getElementById('recibido2').value = "0";
         var validadocumento=document.getElementById('documento').value;
         if (validadocumento=""){
             document.getElementById('documento').focus();
         }
         restar()
         event.preventDefault();
       // console.log("click");
          
        var formData = {
        documento: $('#documento').val(),
        nombre: $('#nombre').val(),
        correo: $('#correo').val()
        // Agregar otros campos según sea necesario
        };
        // console.log("formdata-->", formData);
        //$('#clienteModal').modal('hide');
         $.ajax({
    url: 'guardar_cliente.php',
    method: 'POST',
    data: formData,
    dataType: 'json',
    })
    };
    
    function entra2(){
         document.getElementById('recibido2').value = "";
         restar()
    };
    
    function limpia(idInput){
        console.log("idInput");
        //document.getElementByID().value=""
        var inputElement = document.getElementById(idInput);
        console.log(idInput);
        if (inputElement) {
                inputElement.value = "";
            }
    };
    
    function sale(idInput){
        //document.getElementById('recibido1').value = "";
        var outputElement=document.getElementById(idInput);
        console.log(idInput);
        if (outputElement.value==""){
            outputElement.value=0;
        }
    };
    
    function buscacliente(){
        
    }
</script>
  <!--
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>	
<script src="../js/jquery.dataTables.min.js"></script>-->



</body>
</html>