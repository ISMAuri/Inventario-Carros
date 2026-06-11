<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
} else {
  if (1 == 1) {

    //Inlcuímos a la clase PDF_MC_Table
    require('PDF_MC_Table.php');
    require_once "../modelo/ejecutarSQL.php";
    //Instanciamos la clase para generar el documento pdf
    $pdf = new PDF_MC_Table();

    //Agregamos la primera página al documento pdf
    $pdf->AddPage();

    //Seteamos el inicio del margen superior en 25 pixeles 
    $y_axis_initial = 25;

    $pdf->SetFont('Arial', '', 12);
    
    $categoria = new ejecutarSQL();

    $rspta = $categoria->listar("SELECT * FROM empresa where id_empresa=1");
        

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $espacio ="                                                                                                                 ";
    while ($reg = $rspta->fetch_object()) {
      $pdf->SetFont('Arial', 'B', 8);
      // $pdf->Row(array(utf8_decode($nombre)));
      $pdf->Cell(30, 6, $espacio  ."Nombre de Empresa: " . utf8_decode($reg->nombre), 0);
      $pdf->SetFont('Arial', '', 8);
      $pdf->Ln();
      $pdf->Cell(30, 6, $espacio . 'Razon Social: '.utf8_decode($reg->razon_social), 0);
      $pdf->Ln();
      $pdf->Cell(30, 6, $espacio . 'RTN: ' . utf8_decode($reg->rtn), 0);
      $pdf->Ln();
      $pdf->Cell(15, 6, $espacio . 'Direccion: ' . utf8_decode($reg->direccion), 0);
      $pdf->Ln();
      $pdf->Cell(30, 6, $espacio . 'Telefono: ' . utf8_decode($reg->telefono), 0);
      $pdf->Ln();
      $pdf->Cell(28, 6, $espacio . 'Correo: ' . utf8_decode($reg->correo), 0);
      $pdf->Ln();
      
      if ($reg->logotipo != "") {
        $pdf->Image('../files/empresa/' . $reg->logotipo, $x+50, $y+2, 34);
      }
      else {
        $pdf->Cell(25, 6,  $espacio .'Logotipo: No se ha cargado una imagen', 0);
        $pdf->Ln();
      }
      // $pdf->Cell(25, 6, 'Logotipo: ' . utf8_decode($reg->logotipo), 0);
      // $pdf->Ln();
    }


    //Seteamos el tipo de letra y creamos el título de la página. No es un encabezado no se repetirá
    $pdf->SetFont('Arial', 'B', 12);


    $pdf->Ln(10);
    $pdf->Cell(40, 6, '', 0, 0, 'C');
    $pdf->Cell(100, 6, 'Lista de Clientes', 1, 0, 'C');

    $pdf->Ln(10);

    //Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
    
    $pdf->SetFillColor(255, 0, 0);

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(30, 6, 'Nombre', 1, 0, 'C', 1);
    $pdf->Cell(30, 6, 'Telefono', 1, 0, 'C', 1);
    $pdf->Cell(30, 6, 'Direccion', 1, 0, 'C', 1);
    $pdf->Cell(15, 6, 'Tipo', 1, 0, 'C', 1);
    $pdf->Cell(30, 6, 'Empresa', 1, 0, 'C', 1);
    $pdf->Cell(28, 6, 'Vehiculo Propio', 1, 0, 'C', 1);
    $pdf->Cell(25, 6, 'Cargo', 1, 0, 'C', 1);

    $pdf->Ln(10);
    //Comenzamos a crear las filas de los registros según la consulta mysql

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $rspta = $categoria->listar("SELECT * FROM personas WHERE id='$id'");
    } 
    $rspta = $categoria->listar("SELECT * FROM personas");

    //Table with 20 rows and 4 columns
    $pdf->SetWidths(array(70));
    $pdf->SetWidths(array(30));
    $pdf->SetWidths(array(60));
    $pdf->SetWidths(array(28));

    $contar=0;
    $contaractivos=0;
    while ($reg = $rspta->fetch_object()) {
      $nombre = $reg->nombre . ' ' . $reg->apellido;
      $pdf->SetFont('Arial', '', 7);
      // $pdf->Row(array(utf8_decode($nombre)));
      $pdf->Cell(30, 6, utf8_decode($nombre), 1);
      $pdf->Cell(30, 6, utf8_decode($reg->telefono), 1);
      $pdf->Cell(30, 6, utf8_decode($reg->direccion), 1);
      $pdf->Cell(15, 6, utf8_decode($reg->tipo), 1);
      $pdf->Cell(30, 6, utf8_decode($reg->empresa), 1);
      $pdf->Cell(28, 6, utf8_decode($reg->vehiculo_propio), 1);
      $pdf->Cell(25, 6, utf8_decode($reg->cargo), 1);
      $pdf->Ln();
      $contar++;
      if ($reg->estado_actual == "Activo") {
        $contaractivos++;
      }
    }
      $pdf->Cell(20, 6, "Total de Clientes Registrados: $contar", 0,0,'L');
      $pdf->Ln();
      $pdf->Cell(20, 6, "Total de Clientes Activos: $contaractivos", 0,0,'L');


    //Mostramos el documento pdf
    $pdf->Output();

?>
<?php
  } else {
    echo 'No tiene permiso para visualizar el reporte';
  }
}
ob_end_flush();
?>