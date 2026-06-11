<?php
/// Powered by Evilnapsis go to http://evilnapsis.com
include "PDF_MC_Table.php";

if (!isset($_GET["idfactura"])) {
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
  exit();
}
$idfactura = $_GET['idfactura'];

require_once "../modelo/ejecutarSQL.php";
// var_dump($idfactura);exit();

$categoria = new ejecutarSQL();
$factura = $categoria->mostrar("select * from facturas where idfactura='" . $idfactura . "'");
$cliente = $categoria->mostrar("select * from clientes where idcliente='" . $factura['idcliente'] . "'");
// $carro = $categoria->mostrar("select * from carro where idcarro='" . $factura['idcarro'] . "'");
$fecha = $categoria->mostrar("select DATE(fecha) as fecha from facturas where idfactura='" . $idfactura . "'");
$fechav = $categoria->mostrar("SELECT DATE(DATE_ADD(fecha, INTERVAL 1 YEAR)) as fechav from facturas where idfactura='" . $idfactura . "'");
// var_dump($fecha);exit();

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);    
$textypos = 5;
$pdf->setY(12);
$pdf->setX(15);
// Agregamos los datos de la empresa
$pdf->Cell(5,$textypos,"Inversiones Mercantiles Villegas S.A. de C.V.");
// $pdf->SetFont('Arial','B',10);    
// $pdf->setY(30);$pdf->setX(10);
// $pdf->Cell(5,$textypos,"DE:");
$pdf->SetFont('Arial','',10);    
$pdf->setY(20);$pdf->setX(15);
$pdf->Cell(40,$textypos,"Colonia Los Maestros");
$pdf->setY(20);$pdf->setX(65);
$pdf->Cell(40,$textypos,"Tel. 9980-2450");
$pdf->setY(20);$pdf->setX(105);
$pdf->Cell(5,$textypos,"Email: info@inversionesvillegas.com");
$pdf->setY(25);$pdf->setX(15);
$pdf->Cell(5,$textypos,"RTN: 08011985123960");
$pdf->setY(25);$pdf->setX(65);
$pdf->Cell(5,$textypos,"inversionesvillegas.com");


    $pdf->SetFont('Arial', 'B', 12);


    $pdf->Ln(10);
    $pdf->Cell(5, 6, '', 0, 0, 'C');
    $pdf->Cell(170, 6, 'FACTURA DEL CLIENTE', 1, 0, 'C');



// Agregamos los datos del cliente
// $pdf->SetFont('Arial','B',10);    
// $pdf->setY(45);$pdf->setX(75);
// $pdf->Cell(5,$textypos,"PARA:");
$pdf->SetFont('Arial','',10);    
// $pdf->setY(35);$pdf->setX(75);
// $pdf->Cell(5,$textypos,"");

$pdf->setY(42);$pdf->setX(15);
$pdf->Cell(90, 30, '', 1, 0, 'C');

$pdf->setY(45);$pdf->setX(15);
$pdf->Cell(5,$textypos,"RTN: " . $cliente['rtn']);
$pdf->setY(50);$pdf->setX(15);
$pdf->Cell(5,$textypos,"Cliente: " . $cliente['nombre']);
$pdf->setY(55);$pdf->setX(15);
$pdf->Cell(5,$textypos,"Direccion: " . $cliente['direccion']);
$pdf->setY(60);$pdf->setX(15);
$pdf->Cell(5,$textypos,"Email: " . $cliente['correoelectronico']);

// Agregamos los datos del cliente

$pdf->setY(42);$pdf->setX(105);
$pdf->Cell(80, 30, '', 1, 0, 'C');

$pdf->SetFont('Arial','',10);    
$pdf->setY(45);$pdf->setX(110);
$pdf->Cell(5,$textypos,"No. Factura: $factura[numerofactura]");
$pdf->SetFont('Arial','',10);    
$pdf->setY(50);$pdf->setX(110);
$pdf->Cell(5,$textypos,"Fecha: $fecha[fecha]");
$pdf->setY(55);$pdf->setX(110);
$pdf->Cell(5,$textypos,"Vencimiento: $fechav[fechav]");
$pdf->setY(60);$pdf->setX(110);
    $pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(5,$textypos,"Estado Factura: $factura[estado]");
$pdf->setY(65);$pdf->setX(100);
$pdf->Cell(5,$textypos,"");
$pdf->setY(70);$pdf->setX(100);
$pdf->Cell(5,$textypos,"");


    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(5, 6, '', 0, 0, 'C');
    $pdf->Cell(170, 6, 'DETALLE Y DESCRIPCION DE VEHICULO', 1, 0, 'C');

/// Apartir de aqui empezamos con la tabla de productos

    $pdf->Ln(8);
    $rspta = $categoria->listar("SELECT * FROM carros where idcarro='" . $factura['idcarro'] . "'");
    while ($reg = $rspta->fetch_object()) {

    $pdf->SetFont('Arial', '', 8);

    $pdf->Cell(5, 6, '', 0);
    $pdf->Cell(85, 6, 'VIN: '.$reg->vin, 1);
    $pdf->Cell(85, 6, 'Placa: '.$reg->placa, 1);
    $pdf->Ln();

    $pdf->Cell(5, 6, '', 0);
    $pdf->Cell(85, 6, utf8_decode('Marca: '.$reg->marca), 1);
    $pdf->Cell(85, 6, utf8_decode('Modelo: '.$reg->modelo), 1);
    $pdf->Ln();

    $pdf->Cell(5, 6, '', 0);
    $pdf->Cell(85, 6, utf8_decode('Año: '.$reg->anio), 1);
    $pdf->Cell(85, 6, utf8_decode('Color: '.$reg->color), 1);
    $pdf->Ln();

    $pdf->Cell(5, 6, '', 0);
    $pdf->Cell(85, 6, 'Kilometraje: '.number_format($reg->kilometraje).' km', 1);
    $pdf->Cell(85, 6, utf8_decode('Combustible: '.$reg->tipocombustible), 1);
    $pdf->Ln();

    $pdf->Cell(5, 6, '', 0);
    $pdf->Cell(85, 6, utf8_decode('Transmisión: '.$reg->transmision), 1);
    $pdf->Cell(85, 6, utf8_decode('Carrocería: '.$reg->tipocarroceria), 1);
    $pdf->Ln();


  


}


$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
/////////////////////////////
//// Array de Cabecera


/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$yposdinamic = 120;

$descuento = $factura['descuento'];
$subtotal = $factura['subtotal'];
$total = $factura['total'];

if ($factura['impuestoporcentaje'] == "18%") {
  $impuesto18 = $factura['impuestos'];
  $impuesto15 = 0;
  $totalexento = 0;
} else if ($factura['impuestoporcentaje'] == "15%") {
  $impuesto15 = $factura['impuestos'];
  $impuesto18 = 0;
  $totalexento = 0;
} else {
  $totalexento = $factura['subtotal'];
  $impuesto18 = 0;
  $impuesto15 = 0;
}


$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln();
/////////////////////////////
$header = array("", "");
$data2 = array(
	array("Descuento", $descuento),
	array("Subtotal",$subtotal),
  array("Total Exento", $totalexento),
  array("Impuesto 18%", $impuesto18),
  array("Impuesto 15%", $impuesto15),
	array("Total Lps.", $total),
);
    $w2 = array(40, 40);


    $pdf->Ln();

    foreach($data2 as $row)
    {
$pdf->setX(105);
        $pdf->Cell($w2[0],6,$row[0],1);
        $pdf->Cell($w2[1],6,"L. ".number_format($row[1], 2, ".",","),'1',0,'R');

        $pdf->Ln();
    }
/////////////////////////////

$yposdinamic += (count($data2)*10);
$pdf->SetFont('Arial','B',10);    

$pdf->setY($yposdinamic);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"TERMINOS Y CONDICIONES");
$pdf->SetFont('Arial','',10);    

$pdf->setY($yposdinamic+10);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"El cliente se compromete a pagar la factura.");
$pdf->setY($yposdinamic+20);
$pdf->setX(10);


$pdf->output();