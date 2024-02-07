<?php
require_once '../server/serverConexion.php';
require_once '../printer/tcpdf.php';

// Obtener datos del formulario
$documento = $_POST['documento'] ?? '';
//echo $documento;
$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$elid=$_POST['elid'] ?? '';
$recibido1=$_POST['recibido1'] ?? '0';
$recibido2=$_POST['recibido2'] ?? '0';
$total = $_POST['total'] ?? '';
$formapago1 = $_POST['formapago1'] ?? '';
$formapago2 = $_POST['formapago2'] ?? '';
$saldo = $_POST['resultado'] ?? '';
$sqlf = "SELECT numerofactura FROM facturas ORDER BY id DESC limit 1";
$resultadof = $mysqli->query($sqlf);
if ($resultadof->num_rows > 0){
    $fila = $resultadof->fetch_assoc();
    $numerofactura = $fila["numerofactura"];
    if ($numerofactura !== null && $numerofactura !== '') {
            //echo "Número de factura: " . $numerofactura;
            // Convertir a número, sumar uno y volver a convertir a cadena
            $ticket = str_pad((intval($numerofactura) + 1), strlen($numerofactura), '0', STR_PAD_LEFT);
       }else{
            $ticket="001";
        }
}else{
    $ticket="001";  //inicial
}
$fechaventa= date("d-m-Y, h:i:s A");  

$sql = "SELECT * FROM carrito";
$resultado = $mysqli->query($sql);
$total=0;
if ($resultado->num_rows > 0) {
    $medidas = array(80, 600);
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(80, 210), true, 'UTF-8', false);
    $pdf->SetMargins(3, 10, 3,5);
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->AddPage();
    $pdf->SetFont('helvetica','',9);
    $imageFile = '../images/logo.png';
    $pdf->Image($imageFile, 0, 0, 80, 0, 'PNG', '', '', false, 150, '', false, false, 0);
    date_default_timezone_set('America/Bogota');
    $fecha_actual = new DateTime('now');
    $fechaventa = $fecha_actual->format('d-m-Y, h:i:s A');
    $header = <<<EOD
TIENDA MILITAR
DUARTE ILES ALICIA MILENA
NIT: 52.364.573-1
BOGOTA DC
>No Responsable de IVA<

Cliente: $nombre
Fecha de venta: $fechaventa;
Autorización numeración de facturación
18764047085985  Prefijo -FE-
Fecha formalización 04/04/2023
Rango del 001 al 999
EOD;
$pdf->Write(0, $header, '',0, 'L', true, 0, false, true, 0);
$txt = <<<EOD

Venta al mostrador
EOD;
// print a block of text using Write()
    $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
    $pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0);
    $pdf->Write(0, "Factura No. FE$ticket", '', 0, 'C', true, 0, false, false, 0);
    $pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0);
    $datosventa = array();
    $ultimo_id="";
    $cantiitems=0;
 while ($row= $resultado->fetch_assoc()) {
    $cat = $row["idcarrito"];
    $item = $row["itemcarrito"];
    $cantidada= ($row["cantidadcarrito"]);
    $tipo= strtolower($row["categoriacarrito"]);
    $descripcion=$row['descventas'];
    $genero=$row['generoventas'];
    $talla=$row['tallaventas'];
    $cantidad=$row['cantidadcarrito'];
    $valor=$row['preciocarrito'];
    $formapago=strtoupper($row['formapagocarrito']);
    $precio=intval($valor)/intval($cantidad);
    $sqla = "SELECT * FROM ".$tipo." WHERE item = \"$item\";";
    $resultadoa = $mysqli->query($sqla);
    if ($resultadoa) {
    $fila = $resultadoa->fetch_assoc();
    $tmpcandidada = $fila['cantidada'];
    $tmpcandidada =$tmpcandidada - $cantidada;
    }
    $sql2="";
    $sqlu = "UPDATE ".$tipo." SET cantidada=".$tmpcandidada." WHERE item =  \"$item\";";
    //echo $sqlu;
    $resultado2 = $mysqli->query($sqlu);
    if ($resultado2){
    //    echo "ok";
    }
    $sql2="";
	$sql2 = "INSERT INTO ventas (fecha_venta,item_venta,tipo_venta,descripcion_venta,genero_venta,talla_venta,precio_venta,cantidad_venta,valor_venta,forma_pago) VALUES ('$fechaventa','$item','$tipo','$descripcion','$genero','$talla','$precio','$cantidad','$valor', '$formapago')";
    if ($mysqli->query($sql2) === TRUE) {
        $ultimo_id = $mysqli->insert_id;
        //$datos_venta = $cantidada . "-" . $item . "-" . $descripcion . "\nTx: " . $talla . " " . $genero . "\nENTREGA: " . $formapago . " Precio: $" . $precio;
       //$datosventa[$ultimo_id]=$datos_venta;
       $datosventa[$ultimo_id] = array(
        'cantidada' => $cantidada,
        'item' => $item,
        'descripcion' => $descripcion,
        'detalle' => "Tx: " . $talla . " " . $genero,
        'entrega'=> "ENTREGA: " . $formapago,
        'precio'=> " Precio: $" . $precio
    );
    $jsonventas = json_encode($datosventa, JSON_PRETTY_PRINT);
    }
    $total += $valor;
    $valor=number_format($valor,0);
    
    $txt=<<<EOD
$cantidada-$item : $descripcion
Tx :$talla $genero
EOD;
    $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
    $txt = <<<EOD
ENTREGA: $formapago         Precio: $ $valor
EOD;
$pdf->Write(0, $txt, '', 0, 'R', true, 0, false, false, 0);
$cantiitems=$cantiitems+1; 
}
    
    if (isset($pdf)) {
    $sql3 = "TRUNCATE TABLE carrito";
	$resultado3 = $mysqli->query($sql3);
    }
	if ($recibido2=="" || $recibido2==null){
	    $recibido2="0";
	}
	if ($recibido1==""){
	    $recibido1=="0";
	}
	$recibido1=number_format($recibido1,0);
	$recibido2=number_format($recibido2,0);
	$abonos=array(
        $formapago1 => $recibido1,
        $formapago2 => $recibido2
        ) ;
	$pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0);      
    $cantidaditems=$cantiitems;
    $total = number_format($total,0);   //Cant.     
    $pdf->Cell(20, 5, "Items: $cantidaditems", 0, 0);
    $pdf->Cell(55, 5, "Valor Total de Venta:  $ $total", 0, 1);
    $pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0);
    $pdf->Cell(50, 5, "1 Valor parcial recibido: $formapago1 :", 0, 0);
    $t2=$recibido1+$recibido2;
    //$recibido1=number_format($recibido1,0);
    $pdf->Cell(20, 5, "$ $recibido1", 0, 1);
    $pdf->Cell(50, 5, "2 Valor parcial recibido: $formapago2 :", 0, 0);
    //$recibido2=number_format($recibido2,0);
    $pdf->Cell(20, 5, "$ $recibido2", 0, 1);
    $t2=number_format($t2,0);
    $pdf->Cell(50, 5, "Abono Total Recibido: ", 0, 0);
    $pdf->Cell(20, 5, "$ $t2", 0, 1);
    $pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0);
    $pdf->Cell(50, 5, "Saldo Pendiente: ", 0, 0);
    //$saldo=$saldo;
    $pdf->Cell(20, 5, "$ $saldo", 0, 1);
    $pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0);
    $jsonAbonos = json_encode($abonos);
    $fechaventa=date("d-m-Y, h:i:s A");
    $valorfactura=$valorfactura*1000;
    $tabonos=$recibido1+$recibido2;
    if ($saldo <= 0){
        $estado_factura="PAGADA";
    }else{
        $estado_factura="CON SALDO";
    }
    $sql3 = "INSERT INTO facturas (numerofactura,cliente,numeroventa,fechafactura,abona,valorfactura,saldopendiente,estado_factura) VALUES ('$ticket','$nombre','$jsonventas','$fechaventa','$jsonAbonos','$total','$saldo','$estado_factura')";
    $resultado3 = $mysqli->query($sql3);
    //echo $sql3;
    
    $pdf->Write(0, "$ultimo_id", '', 0, 'L', true, 0, false, false, 0);
    $pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0); 
    $pdf->Write(0, "GARANTIA DE 3 MESES - LEY 1480 DE 2011", '', 0, 'C', true, 0, false, false, 0);
    $pdf->Output('/storage/ssd2/796/19519796/public_html/printer/TicketVenta.pdf', 'F');
} else {
    echo "No se encontraron datos para generar el PDF.";
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>
