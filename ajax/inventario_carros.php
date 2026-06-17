<?PHP

session_start();
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
// $fotos = isset($_POST['fotos']) ? limpiarCadena($_POST['fotos']) : [];


switch ($_GET['opc']) {
	case 'listar':
		$resp = $categoria->listar("select * from carros");
		$data = array();

		while ($fila = $resp->fetch_object()) {
			$condicion = 0;
			if ($fila->estado == "Disponible")
				$condicion = 1;


			$btndetalles = "";
			$btnestado = "";
			$btneditar = "";
			if ($_SESSION['verinventario'] == 1) {
				
				$btndetalles = "<a class='btn btn-secondary' href='../reportes/rptcarro.php?idcarro=" . $fila->idcarro . "' target='_blank'><i class='fas fa-info-circle' data-toggle='modal' data-target='#exampleModal'></i></a>";
			}

			if ($_SESSION['editarinventario'] == 1) {
				
				$btneditar = '<button type="button" onclick="mostrar(' . $fila->idcarro . ')" class="btn btn-primary mr-1" ><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>';
			}

			if ($condicion == 1) {
			if ($_SESSION['cambiarestadoinventario'] == 1) {
				$btnestado = '<button type="button" onclick="anular(' . $fila->idcarro . ')" class="btn btn-warning mr-1" ><i class="fas fa-wrench"></i></button>';
			}
			} else {
				if ($_SESSION['cambiarestadoinventario'] == 1) {
					$btnestado = '<button type="button" onclick="activar(' . $fila->idcarro . ')" class="btn btn-success mr-1" ><i class="fas fa-check"></i></button>';
				}
			}

			$estado ="<span class='badge badge-success'>Disponible</span>";

			if ($fila->estado == "Disponible") {
				$estado = "<span class='badge badge-success'>Disponible</span>";
			} else if ($fila->estado == "Mantenimiento") {
				$estado = "<span class='badge badge-warning'>Mantenimiento</span>";
			} else if ($fila->estado == "Reservado") {
				$estado = "<span class='badge badge-secondary'>Reservado</span>";
			} else if ($fila->estado == "Vendido") {
				$estado = "<span class='badge badge-danger'>Vendido</span>";
			}

			$data[] = array(
				"0" => $btneditar.$btnestado.$btndetalles,
				"1" => $fila->vin,
				"2" => $fila->marca,
				"3" => $fila->modelo,
				"4" => $fila->anio,
				"5" => $fila->kilometraje,
				"6" => $fila->precioventa,
				"7" => $estado
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

		$respx = $categoria->insertar("update carros set estado='Mantenimiento' where idcarro='$idcarro'");

		echo $respx ? "El carro ha sido puesto en mantenimiento correctamente " : " No se puedo realizar";

		break;

	case 'activar':

		$respx = $categoria->insertar("update carros set estado='Disponible' where idcarro='$idcarro'");

		echo $respx ? "El carro ha sido activado correctamente " : " No se puedo realizar";

		break;

	case 'guardaryeditar':
		// var_dump($_FILES['fotos']);
		// exit();
		$fotos = [];
		if (isset($_FILES['fotos']) && count($_FILES['fotos']['name']) > 0) {
		for ($i = 0; $i < count($_FILES['fotos']['name']); $i++) {

			$nombre = $_FILES['fotos']['name'][$i];
			$tmp    = $_FILES['fotos']['tmp_name'][$i];
			$tipo   = $_FILES['fotos']['type'][$i];

			if (!empty($tmp) && is_uploaded_file($tmp)) {
				if ($tipo == "image/jpeg" || $tipo == "image/jpg" || $tipo == "image/png") {
					$ext = pathinfo($nombre, PATHINFO_EXTENSION);
					$foto = round(microtime(true)) . "_" . $i . "." . $ext;
					move_uploaded_file($tmp, "../files/carros/" . $foto);
					array_push($fotos, $foto);

				}
			}
		}
		}


		if (empty($idcarro)) {
			$exito = true;

			if ($gastosextra == "") {
				$gastosextra = 0;
			}
			
			$sql = "SELECT vin FROM carros WHERE vin='$vin'";
			$verificar = $categoria->mostrar($sql);

			if ($verificar) {
				echo "existe vin";
				exit();
			}
			// var_dump(boolean($verificar));exit();


			$sql = "INSERT INTO `carros`(`vin`, `marca`, `modelo`, `anio`, `color`, `placa`, `kilometraje`, `tipocombustible`, `transmision`, `tipocarroceria`, `preciocompra`, `precioventa`, `gastosextra`, `fechaingreso`, `estado`, `observaciones`) VALUES ('$vin','$marca','$modelo','$anio','$color','$placa','$kilometraje','$tipo_combustible','$transmision','$tipo_carroceria','$precio_compra','$precio_venta','$gastosextra','$fecha_ingreso','$estado','$observaciones')";

			$resp = $categoria->insertar($sql);


			foreach($fotos as $foto) {
				$sql_foto = "INSERT INTO `fotos_carro`(`idcarro`, `ruta`) VALUES ((SELECT idcarro FROM carros WHERE vin='$vin'), '$foto')";
				$categoria->insertar($sql_foto);
			}


			echo $resp ? "El carro se registro correctamente " : " No se puedo realizar";
		} else {
			if ($gastosextra == "") {
				$gastosextra = 0;
			}


			$sql = "UPDATE `carros` SET `vin`='$vin',`marca`='$marca',`modelo`='$modelo',`anio`='$anio',`color`='$color',`placa`='$placa',`kilometraje`='$kilometraje',`tipocombustible`='$tipo_combustible',`transmision`='$transmision',`tipocarroceria`='$tipo_carroceria',`preciocompra`='$precio_compra',`precioventa`='$precio_venta',`gastosextra`='$gastosextra',`fechaingreso`='$fecha_ingreso',`estado`='$estado',`observaciones`='$observaciones' WHERE idcarro='$idcarro'";
			$resp = $categoria->insertar($sql);
			
			
			if (count($fotos) > 0) {
				$categoria->insertar("DELETE FROM fotos_carro WHERE idcarro='$idcarro'");

				foreach($fotos as $foto) {
				$sql_foto = "INSERT INTO `fotos_carro`(`idcarro`, `ruta`) VALUES ((SELECT idcarro FROM carros WHERE vin='$vin'), '$foto')";
				$categoria->insertar($sql_foto);
				}	
			}			
			
			// var_dump($fotos);

			echo $resp ? " El carro se edito correctamente " : " No se puedo realizar la edición";
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
