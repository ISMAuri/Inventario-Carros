<?php 
require_once "globa.php";

$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
 mysqli_set_charset($conexion,"utf8"); // AQUI AGREGUE UTF-8

mysqli_query( $conexion, "SET NAMES 'utf8'");
//Si tenemos un posible error en la conexión lo mostramos
if (mysqli_connect_errno())
{
	printf("Falló conexión a la base de datos: %s\n",mysqli_connect_error());
	exit();
}

if (!function_exists('ejecutarConsulta'))
{
	function ejecutarConsulta($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
	}
	
	function respaldo(){
	$db_host = DB_HOST; //Host del Servidor MySQL
	$db_name = DB_NAME; //Nombre de la Base de datos
	$db_user =DB_USERNAME; //Usuario de MySQL
	$db_pass = DB_PASSWORD; //Password de Usuario MySQL
	
	$fecha = date("Ymd-His"); //Obtenemos la fecha y hora para identificar el respaldo
 
	// Construimos el nombre de archivo SQL Ejemplo: mibase_20170101-081120.sql
	$salida_sql = $db_name.'_'.$fecha.'.sql'; 
	
	//Comando para genera respaldo de MySQL, enviamos las variales de conexion y el destino
	$dump = "mysqldump --h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";
	system($dump, $output); //Ejecutamos el comando para respaldo
	return 1;
	}

	function ejecutarConsultaSimpleFila($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);		
		$row = $query->fetch_assoc();
		return $row;
	}

	function ejecutarConsulta_retornarID($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);		
		return $conexion->insert_id;			
	}

	function limpiarCadena($str)
	{
		global $conexion;
		$str = mysqli_real_escape_string($conexion,$str);
		return htmlspecialchars($str);
	}
}
?>