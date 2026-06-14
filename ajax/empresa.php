<?PHP
session_start();
require_once "../modelo/ejecutarSQL.php";
$categoria = new ejecutarSQL();

$idcategoria = isset($_POST['idcategoria']) ? limpiarCadena($_POST['idcategoria']) : "";

$nombre           = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$razon_social     = isset($_POST['razon_social']) ? limpiarCadena($_POST['razon_social']) : "";
$rtn     = isset($_POST['rtn']) ? limpiarCadena($_POST['rtn']) : "";
$telefono         = isset($_POST['telefono']) ? limpiarCadena($_POST['telefono']) : "";
$sitio_web         = isset($_POST['sitio_web']) ? limpiarCadena($_POST['sitio_web']) : "";

$correo           = isset($_POST['correo']) ? limpiarCadena($_POST['correo']) : "";

$direccion        = isset($_POST['direccion']) ? limpiarCadena($_POST['direccion']) : "";
$logotipo        = isset($_POST['logotipo']) ? limpiarCadena($_POST['logotipo']) : "";
$fecha_registro        = isset($_POST['fecha_registro']) ? limpiarCadena($_POST['fecha_registro']) : "";
$fecha_actualizacion        = isset($_POST['fecha_actualizacion']) ? limpiarCadena($_POST['fecha_actualizacion']) : "";
$estado        = isset($_POST['estado']) ? limpiarCadena($_POST['estado']) : "";
switch ($_GET['opc']) {
	case 'listar':
		$resp = $categoria->listar("select * from empresa");
		$data = array();

		while ($fila = $resp->fetch_object()) {
			$condicion = 0;
			if ($fila->estado == "Activa")
				$condicion = 1;
			$btneditar = "";
			$btnanular = "";
			if ($_SESSION['editarempresa'] == 1) {
				
				$btneditar = '<button type="button" onclick="mostrar(' . $fila->id_empresa . ')" class="btn btn-primary" ><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>';
			}
			if ($_SESSION['anularempresa'] == 1) {
				$btnanular = '<button type="button" onclick="anular(' . $fila->id_empresa . ')" class="btn btn-danger" ><i class="fas fa-eraser"></i></button>';
			}
			$data[] = array(
				"0" => $btneditar .	$btnanular,
				"1" => $fila->nombre,
				"2" => $fila->razon_social,
				"3" => $fila->rtn,
				"4" => $fila->telefono,
				"5" => $fila->correo,
				"6" => $fila->sitio_web,
				"7" => $fila->logotipo ? '<img width="64" height="64" src="../files/empresa/' . $fila->logotipo . '">' : '',
				"8" => ($condicion) ? '<span class="label bg-green">' . $fila->estado . '</span>'
					: '<span class="label bg-red">' . $fila->estado . '</span>'
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

		$respx = $categoria->insertar("update empresa set estado='Inactiva'  where id_empresa='$idcategoria'");

		echo $respx ? "El empresa ha sido anulado correctamente " : " No se puedo realizar";

		break;
	case 'activar':
		$respx = $categoria->insertar("update empresa set estado='Activa'  where id_empresa='$idcategoria'");

		echo $respx ? "El empresa ha sido activado correctamente " : " No se puedo realizar";

		break;

	case 'guardaryeditar':

		if (!file_exists($_FILES['logotipo']['tmp_name']) || !is_uploaded_file($_FILES['logotipo']['tmp_name'])) {
			if (isset($_POST["logotipoactual"])) {
				$logotipo = $_POST["logotipoactual"];
			}
		} else {
			$ext = explode(".", $_FILES["logotipo"]["name"]);
			if ($_FILES['logotipo']['type'] == "image/jpg" || $_FILES['logotipo']['type'] == "image/jpeg" || $_FILES['logotipo']['type'] == "image/png") {
				$logotipo = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["logotipo"]["tmp_name"], "../files/empresa/" . $logotipo);
			}
		}

		if (empty($idcategoria)) {
			$sql = "insert into empresa(nombre,razon_social,rtn,direccion,telefono,correo,sitio_web,logotipo,estado)
 values('$nombre','$razon_social','$rtn','$direccion','$telefono','$correo','$sitio_web','$logotipo','$estado')";
			// echo $sql;
			$resp = $categoria->insertar($sql);

			echo $resp ? "La empresa se registro correctamente " : " No se puedo realizar";
		} else {
			$sql = "UPDATE `empresa` SET `nombre`='$nombre',`razon_social`='$razon_social',`rtn`='$rtn',`direccion`='$direccion',`telefono`='$telefono',`correo`='$correo',`sitio_web`='$sitio_web',`estado`='$estado' WHERE id_empresa='$idcategoria'";
			$categoria->insertar($sql);

			if ($logotipo != "") {
				$sql = "update empresa set logotipo='$logotipo' where id_empresa='$idcategoria'";
				$categoria->insertar($sql);
			}

			// echo $sql;
			$resp = $categoria->insertar($sql);
			echo $resp ? " La empresa se edito correctamente " : " No se puedo realizar la edición";
		}


		break;
	case 'mostrar':
		$respx = $categoria->mostrar("select * from empresa where id_empresa='$idcategoria'");
		echo json_encode($respx);

		break;
	default:
		// code...
		break;
}
