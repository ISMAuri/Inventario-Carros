<?PHP
session_start();
require_once "../modelo/ejecutarSQL.php";
$categoria = new ejecutarSQL();

$idcliente = isset($_POST['idcliente']) ? limpiarCadena($_POST['idcliente']) : "";

$tipocliente = isset($_POST['tipocliente']) ? limpiarCadena($_POST['tipocliente']) : "";
$rtn        = isset($_POST['rtn']) ? limpiarCadena($_POST['rtn']) : "";
$nombre           = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$telefono         = isset($_POST['telefono']) ? limpiarCadena($_POST['telefono']) : "";

$correoelectronico           = isset($_POST['correoelectronico']) ? limpiarCadena($_POST['correoelectronico']) : "";

$direccion        = isset($_POST['direccion']) ? limpiarCadena($_POST['direccion']) : "";
$estado    = isset($_POST['estado']) ? limpiarCadena($_POST['estado']) : "";

switch ($_GET['opc']) {
	case 'listar':
		$resp = $categoria->listar("select * from clientes");
		$data = array();

		while ($fila = $resp->fetch_object()) {
			$condicion = 0;
			if ($fila->estado == "Activo")
				$condicion = 1;
			$btneditar = "";
			$btnanular = "";
			if ($_SESSION['editarcl'] == 1) {
				
				$btneditar = '<button type="button" onclick="mostrar(' . $fila->idcliente . ')" class="btn btn-primary" ><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>';
			}
			if ($_SESSION['anularcl'] == 1) {
				$btnanular = '<button type="button" onclick="anular(' . $fila->idcliente . ')" class="btn btn-danger" ><i class="fas fa-eraser"></i></button>';
			}
			$data[] = array(
				"0" => $btneditar .	$btnanular,
				"1" => $fila->tipocliente,
				"2" => $fila->rtn,
				"3" => $fila->nombre,
				"4" => $fila->telefono,
				"5" => $fila->correoelectronico,
				"6" => $fila->direccion,
				"7" => $fila->fecharegistro,
				"8" => ($condicion) ? '<span class="label bg-green">Activado</span>'
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

		$respx = $categoria->insertar("update clientes set estado='Inactivo'  where idcliente='$idcliente'");

		echo $respx ? "El cliente ha sido anulado correctamente " : " No se puedo realizar";

		break;
	case 'activar':
		$respx = $categoria->insertar("update clientes set estado='Activo'  where idcliente='$idcliente'");

		echo $respx ? "El cliente ha sido activado correctamente " : " No se puedo realizar";

		break;

	case 'guardaryeditar':

		if (empty($idcliente)) {
			$sql = "INSERT INTO `clientes`(`tipocliente`, `rtn`, `nombre`, `telefono`, `correoelectronico`, `direccion`, `estado`) VALUES ('$tipocliente','$rtn','$nombre','$telefono','$correoelectronico','$direccion','$estado')";
			// echo $sql;
			$resp = $categoria->insertar($sql);

			echo $resp ? "El cliente se registro correctante " : " No se puedo realizar";
		} else {
			$sql = "UPDATE `clientes` SET `tipocliente`='$tipocliente',`rtn`='$rtn',`nombre`='$nombre',`telefono`='$telefono',`correoelectronico`='$correoelectronico',`direccion`='$direccion',`estado`='$estado' WHERE idcliente='$idcliente'";
			// echo $sql;
			$resp = $categoria->insertar($sql);
			echo $resp ? " El cliente se edito correctante " : " No se puedo realizar la edición";
		}


		break;
	case 'mostrar':
		$respx = $categoria->mostrar("select * from clientes where idcliente='$idcliente'");
		echo json_encode($respx);

		break;
	default:
		// code...
		break;
}
