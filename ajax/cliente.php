<?PHP
session_start();
require_once "../modelo/ejecutarSQL.php";
$categoria = new ejecutarSQL();

$idcategoria = isset($_POST['idcategoria']) ? limpiarCadena($_POST['idcategoria']) : "";

$identidad        = isset($_POST['identidad']) ? limpiarCadena($_POST['identidad']) : "";
$nombre           = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$apellido         = isset($_POST['apellido']) ? limpiarCadena($_POST['apellido']) : "";
$telefono         = isset($_POST['telefono']) ? limpiarCadena($_POST['telefono']) : "";

$correo           = isset($_POST['correo']) ? limpiarCadena($_POST['correo']) : "";
$fecha_inicial    = isset($_POST['fecha_inicial']) ? limpiarCadena($_POST['fecha_inicial']) : "";
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? limpiarCadena($_POST['fecha_nacimiento']) : "";

$direccion        = isset($_POST['direccion']) ? limpiarCadena($_POST['direccion']) : "";
$tipo             = isset($_POST['tipo']) ? limpiarCadena($_POST['tipo']) : "";
$estado_civil     = isset($_POST['estado_civil']) ? limpiarCadena($_POST['estado_civil']) : "";

$trabaja          = isset($_POST['trabaja']) ? limpiarCadena($_POST['trabaja']) : "";
$empresa          = isset($_POST['empresa']) ? limpiarCadena($_POST['empresa']) : "";
$vehiculo_propio  = isset($_POST['vehiculo_propio']) ? limpiarCadena($_POST['vehiculo_propio']) : "";
$cargo            = isset($_POST['cargo']) ? limpiarCadena($_POST['cargo']) : "";

$estado_actual    = isset($_POST['estado_actual']) ? limpiarCadena($_POST['estado_actual']) : "";
$observaciones    = isset($_POST['observaciones']) ? limpiarCadena($_POST['observaciones']) : "";

switch ($_GET['opc']) {
	case 'listar':
		$resp = $categoria->listar("select * from personas");
		$data = array();

		while ($fila = $resp->fetch_object()) {
			$condicion = 0;
			if ($fila->estado_actual == "Activo")
				$condicion = 1;
			$btneditar = "";
			$btnanular = "";
			if ($_SESSION['editarcl'] == 1) {
				
				$btneditar = '<button type="button" onclick="mostrar(' . $fila->id . ')" class="btn btn-primary" ><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>';
			}
			if ($_SESSION['anularcl'] == 1) {
				$btnanular = '<button type="button" onclick="anular(' . $fila->id . ')" class="btn btn-danger" ><i class="fas fa-eraser"></i></button>';
			}
			$data[] = array(
				"0" => $btneditar .	$btnanular,
				"1" => $fila->nombre . ' ' . $fila->apellido,
				"2" => $fila->direccion,
				"3" => $fila->telefono,
				"4" => $fila->empresa,
				"5" => ($condicion) ? '<span class="label bg-green">Activado</span>'
					: '<span class="label bg-red">Desactivado</span>'
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

		$respx = $categoria->insertar("update personas set estado_actual='Bloqueado'  where id='$idcategoria'");

		echo $respx ? "El cliente ha sido anulado correctamente " : " No se puedo realizar";

		break;
	case 'activar':
		$respx = $categoria->insertar("update personas set estado_actual='Activo'  where id='$idcategoria'");

		echo $respx ? "El cliente ha sido activado correctamente " : " No se puedo realizar";

		break;

	case 'guardaryeditar':

		if (empty($idcategoria)) {
			$sql = "insert into personas(identidad,nombre,apellido,telefono,correo,direccion,fecha_inicial,fecha_nacimiento,tipo,estado_civil,trabaja,empresa,vehiculo_propio,cargo,estado_actual,observaciones)
 values('$identidad','$nombre','$apellido','$telefono','$correo','$direccion','$fecha_inicial','$fecha_nacimiento','$tipo','$estado_civil','$trabaja','$empresa','$vehiculo_propio','$cargo','$estado_actual','$observaciones')";
			// echo $sql;
			$resp = $categoria->insertar($sql);

			echo $resp ? "El cliente se registro correctante " : " No se puedo realizar";
		} else {
			$sql = "UPDATE `personas` SET `identidad`='$identidad',`nombre`='$nombre'," .
				"`apellido`='$apellido',`telefono`='$telefono',`correo`='$correo',`direccion`='$direccion'," .
				"`fecha_inicial`='$fecha_inicial',`fecha_nacimiento`='$fecha_nacimiento',`tipo`='$tipo'," .
				"`estado_civil`='$estado_civil',`trabaja`='$trabaja',`empresa`='$empresa',`vehiculo_propio`='$vehiculo_propio'" .
				",`cargo`='$cargo',`observaciones`='$observaciones' WHERE id='$idcategoria'";
			// echo $sql;
			$resp = $categoria->insertar($sql);
			echo $resp ? " El cliente se edito correctante " : " No se puedo realizar la edición";
		}


		break;
	case 'mostrar':
		$respx = $categoria->mostrar("select * from personas where id='$idcategoria'");
		echo json_encode($respx);

		break;
	default:
		// code...
		break;
}
