<?php
/// Powered by Evilnapsis go to http://evilnapsis.com
include "PDF_MC_Table.php";

if (!isset($_GET["idcarro"])) {
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
  exit();
}
$idcarro = $_GET['idcarro'];

require_once "../modelo/ejecutarSQL.php";
// var_dump($idfactura);exit();

$categoria = new ejecutarSQL();
// $carro = $categoria->mostrar("select * from carro where idcarro='" . $factura['idcarro'] . "'");
// var_dump($fecha);exit();

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();

// Agregamos los datos del cliente
// $pdf->SetFont('Arial','B',10);    
// $pdf->setY(45);$pdf->setX(75);
// $pdf->Cell(5,$textypos,"PARA:");

    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(5, 6, '', 0, 0, 'C');
    $pdf->Cell(170, 6, 'DETALLE Y DESCRIPCION DE VEHICULO', 1, 0, 'C');

/// Apartir de aqui empezamos con la tabla de productos

    $pdf->Ln(8);
    $rspta = $categoria->listar("SELECT * FROM carros where idcarro='" . $idcarro . "'");
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

    
    $pdf->Cell(5, 6, '', 0);
    $pdf->Cell(85, 6, utf8_decode('Precio Venta: '.$reg->precioventa), 1);
    $pdf->Cell(85, 6, utf8_decode('Precio Compra: '.$reg->preciocompra), 1);
    $pdf->Ln();
    
    $pdf->Cell(5, 6, '', 0);
    $pdf->Cell(85, 6, utf8_decode('Gastos Extra: '.$reg->gastosextra), 1);
    $pdf->Cell(85, 6, utf8_decode('Fecha Ingreso: '.$reg->fechaingreso), 1);
    $pdf->Ln();
        
    $pdf->Cell(5, 6, '', 0);
    $pdf->Cell(170, 6, utf8_decode('Estado: '.$reg->estado), 1);
    $pdf->Ln();
    $pdf->Cell(5, 6, '', 0);
    $pdf->Cell(170, 6, utf8_decode('Observaciones: '.$reg->observaciones), 1);
    $pdf->Ln();


$pdf->output();
  


}

