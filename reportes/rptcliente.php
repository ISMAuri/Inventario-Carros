<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

    //Inlcuímos a la clase PDF_MC_Table
    require('PDF_MC_Table.php');
    require_once "../modelo/ejecutarSQL.php";
    //Instanciamos la clase para generar el documento pdf
    $pdf = new PDF_MC_Table();

    //Agregamos la primera página al documento pdf
    $pdf->AddPage("L");

    //Seteamos el inicio del margen superior en 25 pixeles 
    $y_axis_initial = 25;

    $pdf->SetFont('Arial', '', 12);
    
    $categoria = new ejecutarSQL();

    //Seteamos el tipo de letra y creamos el título de la página. No es un encabezado no se repetirá
    $pdf->SetFont('Arial', 'B', 12);


    $pdf->Ln(10);
    $pdf->Cell(88, 6, '', 0, 0, 'C');
    $pdf->Cell(100, 6, 'Lista de Clientes', 1, 0, 'C');

    $pdf->Ln(10);

    //Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
    
    $pdf->SetFillColor(255, 0, 0);

    // Cell(float width [, float height [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link)
    $pdf->SetFont('Arial', 'B', 8);
    // $pdf->Cell(2, 6, '', 0, 0, 'C', 0);
    $pdf->Cell(25, 6, 'Tipo de Cliente', 1, 0, 'C', 1);
    $pdf->Cell(25, 6, 'RTN', 1, 0, 'C', 1);
    $pdf->Cell(40, 6, utf8_decode('Nombre / Razón Social'), 1, 0, 'C', 1);
    $pdf->Cell(20, 6, 'Telefono', 1, 0, 'C', 1);
    $pdf->Cell(40, 6, utf8_decode('Correo Electrónico'), 1, 0, 'C', 1);
    $pdf->Cell(70, 6, utf8_decode('Dirección'), 1, 0, 'C', 1);
    $pdf->Cell(30, 6, utf8_decode('Fecha Registro'), 1, 0, 'C', 1);
    $pdf->Cell(20, 6, utf8_decode('Estado'), 1, 0, 'C', 1);

    $pdf->Ln(10);
    //Comenzamos a crear las filas de los registros según la consulta mysql

    if (isset($_GET['idcliente'])) {
    $id = $_GET['idcliente'];

    $rspta = $categoria->listar("SELECT * FROM clientes WHERE idcliente='$id'");

    } else {
      $rspta = $categoria->listar("SELECT * FROM clientes");
    }
 
    // $rspta = $categoria->listar("SELECT * FROM personas");

    //Table with 20 rows and 4 columns
    $pdf->SetWidths(array(70));
    $pdf->SetWidths(array(30));
    $pdf->SetWidths(array(60));
    $pdf->SetWidths(array(28));

    $contar=0;
    $contaractivos=0;
    while ($reg = $rspta->fetch_object()) {
      $pdf->SetFont('Arial', '', 7);
      // $pdf->Cell(2, 6, '', 0, 0, 'C', 0);
      // $pdf->Row(array(utf8_decode($nombre)));
      $pdf->Cell(25, 6, utf8_decode($reg->tipocliente), 1);
      $pdf->Cell(25, 6, utf8_decode($reg->rtn), 1);
      $pdf->Cell(40, 6, utf8_decode($reg->nombre), 1);
      $pdf->Cell(20, 6, utf8_decode($reg->telefono), 1);
      $pdf->Cell(40, 6, utf8_decode($reg->correoelectronico), 1);
      $pdf->Cell(70, 6, utf8_decode($reg->direccion), 1);
      $pdf->Cell(30, 6, utf8_decode($reg->fecharegistro), 1);
      $pdf->Cell(20, 6, utf8_decode($reg->estado), 1);
      $pdf->Ln();
      $contar++;
      if ($reg->estado == "Activo") {
        $contaractivos++;
      }
    }
    if (isset($_GET['idcliente'])) {
      $pdf->Cell(20, 6, "Total de Clientes Registrados: $contar", 0,0,'L');
      $pdf->Ln();
      $pdf->Cell(20, 6, "Total de Clientes Activos: $contaractivos", 0,0,'L');
    }

    //Mostramos el documento pdf
    $pdf->Output();

?>
<?php

ob_end_flush();
?>