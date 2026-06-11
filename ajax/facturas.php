<?PHP
session_start();
require_once "../modelo/ejecutarSQL.php";
$categoria = new ejecutarSQL();

$idfactura = isset($_POST['idfactura']) ? limpiarCadena($_POST['idfactura']) : "";

$tipofactura = isset($_POST['tipofactura']) ? limpiarCadena($_POST['tipofactura']) : "";
$rtn        = isset($_POST['rtn']) ? limpiarCadena($_POST['rtn']) : "";
$nombre           = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$telefono         = isset($_POST['telefono']) ? limpiarCadena($_POST['telefono']) : "";

$correoelectronico           = isset($_POST['correoelectronico']) ? limpiarCadena($_POST['correoelectronico']) : "";

$direccion        = isset($_POST['direccion']) ? limpiarCadena($_POST['direccion']) : "";
$estado    = isset($_POST['estado']) ? limpiarCadena($_POST['estado']) : "";
$idcliente    = isset($_POST['idcliente']) ? limpiarCadena($_POST['idcliente']) : "";
$idcarro    = isset($_POST['idcarro']) ? limpiarCadena($_POST['idcarro']) : "";

switch ($_GET['opc']) {

	case 'listar':
		$resp = $categoria->listar("select * from facturas");
		$data = array();

		while ($fila = $resp->fetch_object()) {
			$condicion = 0;
			if ($fila->estado == "Activo")
				$condicion = 1;
			$btneditar = "";
			$btnanular = "";
			if ($_SESSION['editarcl'] == 1) {

				$btneditar = '<button type="button" onclick="mostrar(' . $fila->idfactura . ')" class="btn btn-primary" ><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>';
			}
			if ($_SESSION['anularcl'] == 1) {
				$btnanular = '<button type="button" onclick="anular(' . $fila->idfactura . ')" class="btn btn-danger" ><i class="fas fa-eraser"></i></button>';
			}

			$nombre = $categoria->mostrar("select nombre from clientes where idcliente='" . $fila->idcliente . "'");
			$usuario = $categoria->mostrar("select nombre from usuario where idusuario='" . $fila->idusuario . "'");

			$data[] = array(
				"0" => $btneditar .	$btnanular,
				"1" => $fila->numerofactura,
				"2" => $fila->fecha,
				"3" => $nombre['nombre'],
				"4" => $usuario['nombre'],
				"5" => $fila->subtotal,
				"6" => $fila->descuento,
				"7" => $fila->impuestos,
				"8" => $fila->total,
				"9" => $fila->metodopago,
				"10" => ($condicion) ? '<span class="label bg-green">Activado</span>'
					: '<span class="label bg-red">Inactivo</span>'
			);
		}
		$results = array(
			"sEcho" => 1, //Información para el datatables
			"iTotalRecords" => count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
			"aaData" => $data
		);
		echo json_encode($results);

		break;
	case 'anular':

		$respx = $categoria->insertar("update facturas set estado='Inactivo'  where idfactura='$idfactura'");

		echo $respx ? "El factura ha sido anulado correctamente " : " No se puedo realizar";

		break;
	case 'activar':
		$respx = $categoria->insertar("update facturas set estado='Activo'  where idfactura='$idfactura'");

		echo $respx ? "El factura ha sido activado correctamente " : " No se puedo realizar";

		break;

	case 'guardaryeditar':

		if (empty($idfactura)) {
			$sql = "INSERT INTO `facturas`(`tipofactura`, `rtn`, `nombre`, `telefono`, `correoelectronico`, `direccion`, `estado`) VALUES ('$tipofactura','$rtn','$nombre','$telefono','$correoelectronico','$direccion','$estado')";
			// echo $sql;
			$resp = $categoria->insertar($sql);

			echo $resp ? "El factura se registro correctante " : " No se puedo realizar";
		} else {
			$sql = "UPDATE `facturas` SET `tipofactura`='$tipofactura',`rtn`='$rtn',`nombre`='$nombre',`telefono`='$telefono',`correoelectronico`='$correoelectronico',`direccion`='$direccion',`estado`='$estado' WHERE idfactura='$idfactura'";
			// echo $sql;
			$resp = $categoria->insertar($sql);
			echo $resp ? " El factura se edito correctante " : " No se puedo realizar la edición";
		}


		break;
	case 'mostrar':
		$respx = $categoria->mostrar("select * from facturas where idfactura='$idfactura'");
		echo json_encode($respx);

		break;
	
	case 'datosFactura':
		$resp = $categoria->listar("select * from clientes where estado='Activo'");
		$datos = "<option value='0'>Cliente Nuevo</option>";
		while ($fila = $resp->fetch_object()) {
			
			$datos .= "<option value='$fila->idcliente'>$fila->rtn - $fila->nombre</option>";
		}
		
		echo $datos;
		break;
	case 'datosCliente':
		$respx = $categoria->mostrar("select * from clientes where idcliente='$idcliente'");
		echo json_encode($respx);
		break;
		
	case 'mostrarCarro':
		$respx = $categoria->mostrar("select * from carros where idcarro='$idcarro'");
		echo json_encode($respx);
		break;
	case 'datosCarro':
		$resp = $categoria->listar("select * from carros where estado='Disponible'");
		$datos = "";
		while ($fila = $resp->fetch_object()) {
			$datos .= "<option value='$fila->idcarro'>Placa: $fila->placa - Vin: $fila->vin - $fila->marca $fila->modelo </option>";
		}

		echo $datos;
		break;
	default:
		// code...
		break;
}
