<?PHP
session_start();

require_once "../modelo/ejecutarSQL.php";
$categoria = new ejecutarSQL();
$usuario = new ejecutarSQL();

$idcategoria = isset($_POST['idcategoria']) ? limpiarCadena($_POST['idcategoria']) : "";

$cargo      = isset($_POST['cargo']) ? limpiarCadena($_POST['cargo']) : "";
$nombre           = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$clave         = isset($_POST['clave']) ? limpiarCadena($_POST['clave']) : "";
$login         = isset($_POST['login']) ? limpiarCadena($_POST['login']) : "";
$imagen       = isset($_POST['imagen']) ? limpiarCadena($_POST['imagen']) : "";


switch ($_GET['opc']) {

	case 'cerrarSesion':
		session_destroy();
		header("Location: ../index.php");
		break;

	case 'verificar':
		$logina = $_POST['logina'];
		$clavea = $_POST['clavea'];
		$sql = "SELECT * FROM usuario WHERE login='$logina' AND clave='$clavea' AND condicion='1'";
		$fetch = $categoria->mostrar($sql);

		$_SESSION['cargo'] = "";
		if ($fetch) {
			$_SESSION['idusuario'] = $fetch['idusuario'];
			$_SESSION['nombre'] = $fetch['nombre'];
			$_SESSION['imagen'] = $fetch['imagen'];
			$_SESSION['login'] = $fetch['login'];
			$_SESSION['cargo'] = $fetch['cargo'];
			if ($_SESSION['imagen'] == "") {

				$_SESSION['imagen'] = "icono-blanco.png";
			}
			$sqlPermisos = "SELECT idpermiso FROM usuario_permisos WHERE idusuario='" . $fetch['idusuario'] . "'";
			$marcados = $categoria->listar($sqlPermisos);
			$valores = array();
			while ($per = $marcados->fetch_object()) {
				array_push($valores, $per->idpermiso);
			}
			in_array(1, $valores) ? $_SESSION['verdashboard'] = 1 : $_SESSION['verdashboard'] = 0;

			in_array(2, $valores) ? $_SESSION['verinventario'] = 1 : $_SESSION['verinventario'] = 0;
			in_array(3, $valores) ? $_SESSION['crearinventario'] = 1 : $_SESSION['crearinventario'] = 0;
			in_array(4, $valores) ? $_SESSION['editarinventario'] = 1 : $_SESSION['editarinventario'] = 0;
			in_array(5, $valores) ? $_SESSION['cambiarestadoinventario'] = 1 : $_SESSION['cambiarestadoinventario'] = 0;

			in_array(6, $valores) ? $_SESSION['verfotografias'] = 1 : $_SESSION['verfotografias'] = 0;

			in_array(7, $valores) ? $_SESSION['verclientes'] = 1 : $_SESSION['verclientes'] = 0;
			in_array(8, $valores) ? $_SESSION['crearclientes'] = 1 : $_SESSION['crearclientes'] = 0;
			in_array(9, $valores) ? $_SESSION['editarclientes'] = 1 : $_SESSION['editarclientes'] = 0;
			in_array(10, $valores) ? $_SESSION['cambiarestadoclientes'] = 1 : $_SESSION['cambiarestadoclientes'] = 0;

			in_array(11, $valores) ? $_SESSION['verfacturas'] = 1 : $_SESSION['verfacturas'] = 0;
			in_array(12, $valores) ? $_SESSION['crearfacturas'] = 1 : $_SESSION['crearfacturas'] = 0;
			in_array(13, $valores) ? $_SESSION['editarfacturas'] = 1 : $_SESSION['editarfacturas'] = 0;
			in_array(14, $valores) ? $_SESSION['cambiarestadofacturas'] = 1 : $_SESSION['cambiarestadofacturas'] = 0;

			in_array(15, $valores) ? $_SESSION['verusuarios'] = 1 : $_SESSION['verusuarios'] = 0;
			in_array(16, $valores) ? $_SESSION['crearusuarios'] = 1 : $_SESSION['crearusuarios'] = 0;
			in_array(17, $valores) ? $_SESSION['editarusuarios'] = 1 : $_SESSION['editarusuarios'] = 0;
			in_array(18, $valores) ? $_SESSION['cambiarestadousuarios'] = 1 : $_SESSION['cambiarestadousuarios'] = 0;
			//in_array(5,$valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
		}

		echo json_encode($_SESSION['cargo']);

		break;

	// case 'permisos':
	// 	$resp = $categoria->listar("select * from permiso");
	// 	$data = array();
	// 	$cont = 0;
	// 	while ($fila = $resp->fetch_object()) {
	// 		echo '<input type="checkbox" class="form-control-group" name="permisos[]" id="permisos[]"  value="' . $fila->idpermiso . '">' . $fila->nombre . '<br>';
	// 	}
	// 	break;
	case 'permisos':

		$resp = $categoria->listar("SELECT * FROM permisos");

		echo '<div class="row">';
		while ($fila = $resp->fetch_object()) {

			echo '<div class="col-md-4"> 
			<div class="form-check form-switch"> 
			<input class="form-check-input" type="checkbox" name="permisos[]"  value="' . $fila->idpermiso . '" id="permiso_' . $fila->idpermiso . '" role="switch">
			<label class="form-check-label" for="permiso_' . $fila->idpermiso . '">' . $fila->nombre . '</label></div>
			</div>';
		}

		echo '</div>';

		break;

	case 'listar':
		$resp = $categoria->listar("select * from usuario");
		$data = array();
		while ($fila = $resp->fetch_object()) {
			$condicion = $fila->condicion;

			$btneditar = "";
			$btnestado = "";

			if ($_SESSION['editarusuarios'] == 1) {
				$btneditar = '<button type="button" onclick="mostrar(' . $fila->idusuario . ')" class="btn btn-primary" ><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>';
			}
			if ($_SESSION['cambiarestadousuarios'] == 1) {
				$btnestado = '<button type="button" onclick="cambiarestado(' . $fila->idusuario . ')" class="btn btn-warning" ><i class="fas fa-exclamation-triangle"></i></button>';
			}

			$data[] = array(
				"0" => $btneditar .	$btnestado,
				"1" => $fila->nombre,
				"2" => $fila->login,
				"3" => $fila->cargo,
				"4" => '<img width="64" height="64" src="../files/usuarios/' . $fila->imagen . '">',
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

		$respx = $categoria->insertar("update usuario set condicion=0  where idusuario='$idcategoria'");

		echo $respx ? "El usuario ha sido anulado correctamente " : " No se pudo realizar";

		break;

	case 'activar':
		$respx = $categoria->insertar("update usuario set condicion=1  where idusuario='$idcategoria'");

		echo $respx ? "El usuario se ha activado correctamente " : " No se pudo realizar";

		break;



	case 'guardaryeditar':



		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
			if (isset($_POST["imagenactual"])) {
				$imagen = $_POST["imagenactual"];
			}
		} else {
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
			}
		}


		$resp = $categoria->mostrar("select * from usuario where login='$login' and idusuario!='$idcategoria'");
		if ($resp) {
			echo "El nombre de usuario ya existe";
			exit();
		}

		if (empty($idcategoria)) {
			// $resp = $categoria->mostrar("select imagen from usuario where idusuario='$idcategoria'");
			// if ($imagen == "" || !$resp) {
			// 	echo "La imagen es obligatoria";
			// 	exit();
			// }


			// $lista = $_POST['permisos'] ?? [];
			// for ($i = 0; $i < count($lista); $i++) {
			// 	$sql = "insert into usuario_permisos(idusuario, idpermiso) 
            // values((select max(idusuario) from usuario),'$lista[$i]')";

			// 	echo $sql . "<br>";
			// }
			// var_dump($lista);
			// exit();

			$sql = "INSERT INTO `usuario`(  `nombre`, `login`, `clave`, `cargo`, `imagen` ) VALUES ( '$nombre','$login','$clave','$cargo','$imagen' )";
			// echo $sql;
			$resp = $categoria->insertar($sql);

			$lista = $_POST['permisos'] ?? [];
			for ($i = 0; $i < count($lista); $i++) {

				$sql = "insert into usuario_permisos(idusuario, idpermiso) values((select max(idusuario) from usuario),'$lista[$i]')";
				//echo $sql; 
				$resp = $categoria->insertar($sql);
			}


			echo $resp ? "El usuario se registro correctamente " : " No se puedo realizar";
		} else {
			$sql = "UPDATE usuario SET nombre='$nombre', login='$login', clave='$clave', cargo='$cargo' WHERE idusuario='$idcategoria'";
			$categoria->insertar($sql);

			if ($imagen != "") {
				$sql = "update usuario set imagen='$imagen' where idusuario='$idcategoria'";
				$categoria->insertar($sql);
			}


			$lista = $_POST['permisos'] ?? [];
			$categoria->insertar("delete from usuario_permisos where idusuario=$idcategoria");
			for ($i = 0; $i < count($lista); $i++) {


				$sql = "insert into usuario_permisos(idusuario, idpermiso) values($idcategoria,'$lista[$i]')";
				//echo $sql; 
				$resp = $categoria->insertar($sql);
			}

			echo " El usuario se edito correctamente ";
		}


		break;
	case 'mostrar':
		$respx = $categoria->mostrar("SELECT * FROM usuario WHERE idusuario=$idcategoria");

		$sqlPermisos = "SELECT idpermiso FROM usuario_permisos WHERE idusuario='" . $idcategoria . "'";
		$marcados = $categoria->listar($sqlPermisos);

		$valores = [];
		while ($per = $marcados->fetch_object()) {
			array_push($valores, (int)$per->idpermiso);
		}

		$respx['permisos'] = $valores;

		echo json_encode($respx);

		break;
	default:
		// code...
		break;
}
