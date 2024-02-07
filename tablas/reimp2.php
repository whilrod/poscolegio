<?php
	require '../server/serverConexion.php';
	require_once '../printer/tcpdf.php';
	$id = $_GET['factura'];
	
	$sql = "SELECT * FROM facturas WHERE id = '$id'";
	$resultado = $mysqli->query($sql);
	if ($resultado->num_rows > 0){
	$row = $resultado->fetch_array(MYSQLI_ASSOC);
	$numerodefactura=$row["numerofactura"];
	$cliente=$row["cliente"];
	$numeroventa=$row["numeroventa"];
	//echo $numeroventa;
	$fechafactura=$row["fechafactura"];
	$abona=$row["abona"];
	$valorfactura=$row["valorfactura"];
	$saldopendiente=$row["saldopendiente"];
	$estadofactura=$row["estado_factura"];
	}

//	$medidas = array(80, 600);
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(80, 210), true, 'UTF-8', false);
    
    $pdf->SetMargins(3, 10, 3,5);
   // $pdf->SetFormat(array(80, 210));
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 9);
    $imageFile = '../images/logo.png';  
    $pdf->Image($imageFile, 0, 0, 80, 0, 'PNG', '', '', false, 150, '', false, false, 0);
    date_default_timezone_set('America/Bogota');
    $timezone = new DateTimeZone('America/Bogota');
    
//$fechafactura = new DateTime('now', $timezone);
  //      $fechaventa= date("d-m-Y, h:i:s A");    
   $header = <<<EOD
TIENDA MILITAR
DUARTE ILES ALICIA MILENA
NIT: 52.364.573-1
BOGOTA DC
>No Responsable de IVA<

Cliente: $cliente
Fecha de venta: $fechafactura;
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
$pdf->Write(0, "Factura No. FE$numerodefactura", '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0);
$numeroventaj=json_decode($numeroventa,true);
if ($numeroventaj !== null) {
    // Obtener el número de claves en el array asociativo
    $numeroDeClaves = count($numeroventaj);

    // Imprimir la cantidad de claves
    echo "El JSON tiene $numeroDeClaves claves.";
}
//echo $numeroventaj;
$cantiitems=0;
if ($numeroventaj !== null) {
    // Iterar sobre las claves del array resultante
    if (is_array($numeroventaj) || is_object($numeroventaj)) {
        foreach ($numeroventaj as $clave => $numero_venta) {
            //echo "ok";
           // $numeroventaj=$numero_venta[0];
            $cantidada = isset($numero_venta['cantidada']) ? $numero_venta['cantidada'] : '';
            $item = isset($numero_venta['item']) ? $numero_venta['item'] : '';
            $descripcion = isset($numero_venta['descripcion']) ? $numero_venta['descripcion'] : '';
            $detalle = isset($numero_venta['detalle']) ? $numero_venta['detalle'] : '';
            $entrega = isset($numero_venta['entrega']) ? $numero_venta['entrega'] : '';
            $precio = isset($numero_venta['precio']) ? $numero_venta['precio'] : '';
            $cantiitems=$cantiitems+1; 
            // Puedes usar las variables $cantidada, $item, $descripcion según tus necesidades
            //echo "Clave: $clave, Cantidada: $cantidada, Item: $item, Descripcion: $descripcion";
        }
    } else {
        echo "La variable \$numeroventa no es un array u objeto iterable.";
    }
    
} else {
    // Manejar el caso de decodificación fallida
    echo "Error al decodificar el JSON";
}
//echo "-->".$descripcion;

$pdf->Write(0, "$cantidada-$item : $descripcion", '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, "$detalle", '', 0, 'L', true, 0, false, false, 0);
    $txt = <<<EOD
$entrega               $precio
EOD;
$pdf->Write(0, $txt, '', 0, 'R', true, 0, false, false, 0);
$abonaInfo = "";
$pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0);  
$cantidaditems=$cantiitems;
$pdf->Cell(20, 5, "Items: $cantidaditems", 0, 0);
$pdf->Cell(55, 5, "Valor Total de Venta:  $ $valorfactura", 0, 1);
$pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0);      
    
$abonaArray = json_decode($abona, true);

// Check if decoding was successful
if ($abonaArray !== null) {
    // Iterate over the key-value pairs
    $num=0;
    
    $parcial=0;
    foreach ($abonaArray as $key => $value) {
        //echo "Key: $key, Value: $value<br>";
        $num += 1;
        $parcial += ((int)$value*1000);
        
        //$value=number_format($value,0);
        $pdf->Write(0,"$num Valor parcial recibido: $key  $ $value " , '', 0, 'L', true, 0, false, false, 0);
    }
       $pdf->Cell(50, 5, "Abono Total Recibido: ", 0, 0);
       $pdf->Cell(20, 5, "$ $parcial", 0, 1);
} else {
    // Handle the case of decoding failure
    echo "Error decoding JSON";
}
//     $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
/*
      $txt = <<<EOD
      
$abona
EOD;
*/
$numeroventa=isset($numero_venta['firstKey']);
    // print a block of text using Write()
   // $pdf->Write(0, $txt, '', 0, 'R', true, 0, false, false, 0);
	$pdf->Cell(55, 5, "Valor Total de Venta:  $ $valorfactura", 0, 1);
    $pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0);
    $pdf->Cell(50, 5, "Saldo Pendiente: ", 0, 0);
   // $saldo=number_format($saldopendiente,0);
    $pdf->Cell(20, 5, "$ $saldopendiente", 0, 1);
    $pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0);
    $pdf->Write(0, "$clave", '', 0, 'L', true, 0, false, false, 0);
    $pdf->Write(0, "======================================", '', 0, 'L', true, 0, false, false, 0); 
    $pdf->Write(0, "GARANTIA DE 3 MESES - LEY 1480 DE 2011", '', 0, 'C', true, 0, false, false, 0);
    //$pdf->Write(0, "LEY 1480 DE 2011", '', 0, 'R', true, 0, false, false, 0);
    $pdf->Output('/storage/ssd2/796/19519796/public_html/printer/TicketVentaa.pdf', 'F');
    $mysqli->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
     <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    </head>
<body>
    <script>
         $(document).ready(function() {
        window.open('../printer/TicketVentaa.pdf', '_self');
        //window.location.href = './facturas.php';
    });
    </script>
</body>
</html>