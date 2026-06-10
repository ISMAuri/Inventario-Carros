<?PHP
require_once "../modelo/ejecutarSQL.php";
$categoria = new ejecutarSQL();

$idcategoria = isset($_POST['idcategoria']) ? limpiarCadena($_POST['idcategoria']) : "";

$idcarro = isset($_POST['idcarro']) ? limpiarCadena($_POST['idcarro']) : "";
$vin = isset($_POST['vin']) ? limpiarCadena($_POST['vin']) : "";
$marca = isset($_POST['marca']) ? limpiarCadena($_POST['marca']) : "";
$modelo = isset($_POST['modelo']) ? limpiarCadena($_POST['modelo']) : "";
$anio = isset($_POST['anio']) ? limpiarCadena($_POST['anio']) : "";
$color = isset($_POST['color']) ? limpiarCadena($_POST['color']) : "";
$placa = isset($_POST['placa']) ? limpiarCadena($_POST['placa']) : "";
$kilometraje = isset($_POST['kilometraje']) ? limpiarCadena($_POST['kilometraje']) : "";
$tipo_combustible  = isset($_POST['tipocombustible']) ? limpiarCadena($_POST['tipocombustible']) : "";
$transmision    = isset($_POST['transmision']) ? limpiarCadena($_POST['transmision']) : "";
$tipo_carroceria    = isset($_POST['tipocarroceria']) ? limpiarCadena($_POST['tipocarroceria']) : "";
$precio_compra   = isset($_POST['preciocompra']) ? limpiarCadena($_POST['preciocompra']) : "";
$precio_venta   = isset($_POST['precioventa']) ? limpiarCadena($_POST['precioventa']) : "";
$gastosextra   = isset($_POST['gastosextra']) ? limpiarCadena($_POST['gastosextra']) : "";
$fecha_ingreso   = isset($_POST['fechaingreso']) ? limpiarCadena($_POST['fechaingreso']) : "";
$estado  = isset($_POST['estado']) ? limpiarCadena($_POST['estado']) : "";
$observaciones = isset($_POST['observaciones']) ? limpiarCadena($_POST['observaciones']) : "";


switch ($_GET['opc']) {
	case 'listar':
		$resp = $categoria->listar("select * from carros");
		$data = array();

		while ($fila = $resp->fetch_object()) {
			$condicion = 0;
			if ($fila->estado == "Disponible")
				$condicion = 1;

			$data[] = array(
				"0" => ($condicion) ?
					'<button type="button" onclick="mostrar(' . $fila->idcarro . ')" class="btn btn-primary" ><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>' .
					'<button type="button" onclick="anular(' . $fila->idcarro . ')" class="btn btn-success" ><i class="fas fa-eraser"></i></button>' :
					'<button type="button" onclick="mostrar(' . $fila->idcarro . ')" class="btn btn-primary" ><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>' .

					'<button type="button" onclick="activar(' . $fila->idcarro . ')" class="btn btn-danger" ><i class="fas fa-calendar-check"></i></button>',
				"1" => $fila->marca,
				"2" => $fila->modelo,
				"3" => $fila->anio,
				"4" => $fila->kilometraje,
				"5" => $fila->precioventa,
				"6" => $fila->estado
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

		$respx = $categoria->insertar("update carros set estado='Vendido' where id='$idcarro'");

		echo $respx ? "El carro ha sido anulado correctamente " : " No se puedo realizar";

		break;

	case 'activar':

		$respx = $categoria->insertar("update carros set estado='Disponible' where id='$idcarro'");

		echo $respx ? "El carro nuevamente activo correctante " : " No se puedo realizar";

		break;

	case 'guardaryeditar':

		// $fotos = [];
		// for ($i = 0; $i < count($_FILES['fotos']['name']); $i++) {

		// 	$nombre = $_FILES['fotos']['name'][$i];
		// 	$tmp    = $_FILES['fotos']['tmp_name'][$i];
		// 	$tipo   = $_FILES['fotos']['type'][$i];

		// 	if (!empty($tmp) && is_uploaded_file($tmp)) {
		// 		if ($tipo == "image/*") {
		// 			$ext = pathinfo($nombre, PATHINFO_EXTENSION);
		// 			$foto = round(microtime(true)) . "_" . $i . "." . $ext;
		// 			move_uploaded_file($tmp, "../files/carros/" . $foto);
		// 			array_push($fotos, $foto);
		// 		}
		// 	}
		// }


		if (empty($idcarro)) {
			$exito = true;
			$sql = "INSERT INTO `carros`(`vin`, `marca`, `modelo`, `anio`, `color`, `placa`, `kilometraje`, `tipocombustible`, `transmision`, `tipocarroceria`, `preciocompra`, `precioventa`, `gastosextra`, `fechaingreso`, `estado`, `observaciones`) VALUES ('$vin','$marca','$modelo','$anio','$color','$placa','$kilometraje','$tipo_combustible','$transmision','$tipo_carroceria','$precio_compra','$precio_venta','$gastosextra','$fecha_ingreso','$estado','$observaciones')";

			$resp = $categoria->insertar($sql);


			// foreach($fotos as $foto) {
			// 	$sql_foto = "INSERT INTO `fotos_carro`(`idcarro`, `ruta`) VALUES ((SELECT idcarro FROM carros WHERE vin='$vin'), '$foto')";
			// 	$categoria->insertar($sql_foto);
			// }


			echo $resp ? "El carro se registro correctante " : " No se puedo realizar";
		} else {


			$sql = "UPDATE `carros` SET `vin`='$vin',`marca`='$marca',`modelo`='$modelo',`anio`='$anio',`color`='$color',`placa`='$placa',`kilometraje`='$kilometraje',`tipocombustible`='$tipo_combustible',`transmision`='$transmision',`tipocarroceria`='$tipo_carroceria',`preciocompra`='$precio_compra',`precioventa`='$precio_venta',`gastosextra`='$gastosextra',`fechaingreso`='$fecha_ingreso',`estado`='$estado',`observaciones`='$observaciones' WHERE idcarro='$idcarro'";
			$resp = $categoria->insertar($sql);
			
			
			// if (count($fotos) > 0) {
			// 	$categoria->insertar("DELETE FROM fotos_carro WHERE idcarro='$idcarro'");

			// 	foreach($fotos as $foto) {
			// 	$sql_foto = "INSERT INTO `fotos_carro`(`idcarro`, `ruta`) VALUES ((SELECT idcarro FROM carros WHERE vin='$vin'), '$foto')";
			// 	$categoria->insertar($sql_foto);
			// 	}	
			// }			
			
			// var_dump($fotos);

			echo $resp ? " El carro se edito correctante " : " No se puedo realizar la edición";
		}


		break;
	case 'mostrar':
		$respx = $categoria->mostrar("select * from carros where idcarro='$idcarro'");
		// var_dump($respx);
		echo json_encode($respx);

		break;
	default:
		// code...
		break;
}
