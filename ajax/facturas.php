<?PHP
session_start();
require_once "../modelo/ejecutarSQL.php";
$categoria = new ejecutarSQL();

$idfactura = isset($_POST['idfactura']) ? limpiarCadena($_POST['idfactura']) : "";

$estado    = isset($_POST['estadofactura']) ? limpiarCadena($_POST['estadofactura']) : "";
$idcliente    = isset($_POST['idcliente']) ? limpiarCadena($_POST['idcliente']) : "";
$idcarro    = isset($_POST['idcarro']) ? limpiarCadena($_POST['idcarro']) : "";
$fecha	= isset($_POST['fecha']) ? limpiarCadena($_POST['fecha']) : "";
$subtotal	= isset($_POST['subtotal']) ? limpiarCadena($_POST['subtotal']) : "";
$descuento	= isset($_POST['descuento']) ? limpiarCadena($_POST['descuento']) : "";
$impuestoporcentaje	= isset($_POST['impuestoporcentaje']) ? limpiarCadena($_POST['impuestoporcentaje']) : "";
$impuestos	= isset($_POST['impuestos']) ? limpiarCadena($_POST['impuestos']) : "";
$total	= isset($_POST['total']) ? limpiarCadena($_POST['total']) : "";
$metodopago	= isset($_POST['metodopago']) ? limpiarCadena($_POST['metodopago']) : "";

switch ($_GET['opc']) {

	case 'listar':
		$resp = $categoria->listar("select * from facturas");
		$data = array();

		while ($fila = $resp->fetch_object()) {
			$condicion = 0;
			if ($fila->estado == "Pagada")
				$condicion = 1;
			$btnr = '';
			$btneditar = "";
			$btnestado = "";
			if ($_SESSION['verfacturas'] == 1) {

				$btnr = "<a class='btn btn-secondary' href='../reportes/rptfactura.php?idfactura=" . $fila->idfactura . "' target='_blank'><i class='fas fa-file-alt' data-toggle='modal' data-target='#exampleModal'></i></a>";
			}

			if ($_SESSION['editarfacturas'] == 1) {

				$btneditar = '<button type="button" onclick="mostrar(' . $fila->idfactura . ')" class="btn btn-primary mr-1" ><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>';
			}
			if ($condicion == 1) {
			if ($_SESSION['cambiarestadofacturas'] == 1) {
				$btnestado = '<button type="button" onclick="anular(' . $fila->idfactura . ')" class="btn btn-danger mr-1" ><i class="fas fa-eraser"></i></button>';
			}
			} else {
				if ($_SESSION['cambiarestadofacturas'] == 1) {
					$btnestado = '<button type="button" onclick="activar(' . $fila->idfactura . ')" class="btn btn-success mr-1" ><i class="fas fa-check"></i></button>';
				}
			}

			$nombre = $categoria->mostrar("select nombre from clientes where idcliente='" . $fila->idcliente . "'");
			$usuario = $categoria->mostrar("select nombre from usuario where idusuario='" . $fila->idusuario . "'");
			$carro = $categoria->mostrar("select * from carros where idcarro='" . $fila->idcarro . "'");

			$bg='badge badge-danger';
			if ($fila->estado == "Pendiente") $bg = 'badge badge-warning';
			$data[] = array(
				"0" => $btneditar .	$btnestado .$btnr ,
				"1" => $fila->numerofactura,
				"2" => $fila->fecha,
				"3" => $nombre['nombre'],
				// "4" => $usuario['nombre'],
				"4" => $carro['marca'] . " " . $carro['modelo'] . " (" . $carro['placa'] . ")",
				"5" => $fila->subtotal,
				// "6" => $fila->descuento,
				"6" => $fila->impuestos,
				"7" => $fila->total,
				"8" => $fila->metodopago,
				"9" => ($condicion) ? '<span class="badge badge-success">' . $fila->estado . '</span>' : '<span class="' . $bg . '">' . $fila->estado . '</span>'
				//class="badge badge-success
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

		$respx = $categoria->insertar("update facturas set estado='Anulada'  where idfactura='$idfactura'");

		echo $respx ? "El factura ha sido anulado correctamente " : " No se puedo realizar";

		break;
	case 'activar':
		$respx = $categoria->insertar("update facturas set estado='Pagada'  where idfactura='$idfactura'");

		echo $respx ? "El factura ha sido activado correctamente " : " No se puedo realizar";

		break;

	case 'guardaryeditar':

		if (empty($idfactura)) {


			$ultimoid = $categoria->mostrar("SELECT MAX(idfactura) as id FROM facturas");

			$id = $ultimoid['id'] + 1;
			$idcarro = isset($_POST['carro']) ? limpiarCadena($_POST['carro']) : "";
			$idusuario = $_SESSION['idusuario'];
			$sql = "INSERT INTO facturas (numerofactura, fecha, idcliente, idusuario, subtotal, descuento,
				impuestoporcentaje, impuestos, total, metodopago, estado, idcarro
				) VALUES ('F-00$id','$fecha','$idcliente','$idusuario',
				'$subtotal','$descuento','$impuestoporcentaje%','$impuestos','$total','$metodopago',
				'$estado','$idcarro')";
			$resp = $categoria->insertar($sql);

			if ($resp && $estado == "Pagada") {
				$categoria->insertar("update carros set estado='Vendido' where idcarro='$idcarro'");
			}
			if ($resp && $estado == "Pendiente") {
				$categoria->insertar("update carros set estado='Disponible' where idcarro='$idcarro'");
			}
			if ($resp && $estado == "Anulada") {
				$categoria->insertar("update carros set estado='Disponible' where idcarro='$idcarro'");
			}

			echo $resp ? "El factura se registro correctamente " : " No se puedo realizar";
		} else {
			

			$sql = "UPDATE `facturas` SET `fecha`='$fecha',`idcliente`='$idcliente',`subtotal`='$subtotal',`descuento`='$descuento',`impuestoporcentaje`='$impuestoporcentaje%',`impuestos`='$impuestos',`total`='$total',`metodopago`='$metodopago',`estado`='$estado',`idcarro`='$idcarro' WHERE idfactura='$idfactura'";
			// echo $sql;
			$resp = $categoria->insertar($sql);

			if ($resp && $estado == "Pagada") {
				$categoria->insertar("update carros set estado='Vendido' where idcarro='$idcarro'");
			}
			if ($resp && $estado == "Pendiente") {
				$categoria->insertar("update carros set estado='Disponible' where idcarro='$idcarro'");
			}
			if ($resp && $estado == "Anulada") {
				$categoria->insertar("update carros set estado='Disponible' where idcarro='$idcarro'");
			}
			
			echo $resp ? " El factura se edito correctamente " : " No se puedo realizar la edición";
			
		}


		break;
	case 'mostrar':
		$respx = $categoria->mostrar("select * from facturas where idfactura='$idfactura'");
		echo json_encode($respx);

		break;

	case 'datosFactura':
		$resp = $categoria->listar("select * from clientes where estado='Activo'");
		$datos = "";
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
