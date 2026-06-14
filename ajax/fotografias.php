<?php
session_start();
require_once "../modelo/ejecutarSQL.php";

$categoria = new ejecutarSQL();

$idfotografia = isset($_POST['idfotografia']) ? limpiarCadena($_POST['idfotografia']) : "";
$idcarro = isset($_POST['idcarro']) ? limpiarCadena($_POST['idcarro']) : "";

switch ($_GET['opc']) {

    case 'datosCarro':
        $resp = $categoria->listar("select * from carros");
        $datos = "<option value=''>Seleccione un carro</option>";
        while ($fila = $resp->fetch_object()) {
            $datos .= "<option value='$fila->idcarro'>
                        Placa: $fila->placa - Vin: $fila->vin - $fila->marca $fila->modelo
                       </option>";
        }
        echo $datos;
    break;

    case 'mostrarFotos':
        $resp = $categoria->listar("
            select *
            from fotos_carro
            where idcarro='$idcarro'
        ");
        $html = '<div class="row">';
        while($fila = $resp->fetch_object()){
            $html .= '
           <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <a href="../files/carros/'.$fila->ruta.'" target="_blank">
                    <img
                        src="../files/carros/'.$fila->ruta.'"
                        class="card-img-top"
                        style="height:200px;object-fit:cover;">
                </a>
            </div>
        </div>';

        }
        $html .= '</div>';
       if($html == '<div class="row"></div>'){

    $html = '
    <div class="alert alert-warning">
        Este vehículo no tiene fotografías registradas.
    </div>';
}

echo $html;
    break;
}
?>