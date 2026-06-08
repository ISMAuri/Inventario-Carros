
var tabla;
function init(){
mostrarform(false);
	listar();
	limpiar();
	// document.querySelector('#example1_filter label').textContent = 'Buscar:';


}
function mostrarform(bandera){

    if (bandera){
        $("#listadoregistros").hide();
        $("#formularioregistro").show();
        
    }else
    {
        $("#listadoregistros").show();
        $("#formularioregistro").hide();
		limpiar();

    }

}
function activar(idcategoria){


bootbox.confirm("¿Está Seguro de activar el cliente?", function(result){
		if(result)
        {
        	$.post("../ajax/empresa.php?opc=activar", {idcategoria : idcategoria}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
	
}
function anular(idcategoria){


bootbox.confirm("¿Está Seguro de anular el cliente?", function(result){
		if(result)
        {
        	$.post("../ajax/empresa.php?opc=anular", {idcategoria : idcategoria}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
	
}
function mostrar(idcategoria){
	
$.post("../ajax/empresa.php?opc=mostrar",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);
 		$("#idcategoria").val(data.id_empresa);
 		$("#nombre").val(data.nombre);		
		$("#razon_social").val(data.razon_social);
		$("#rtn").val(data.rtn);
		$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#correo").val(data.correo);
		$("#sitio_web").val(data.sitio_web);
		// $("#logotipo").val(data.correo);
		$("#estado").val(data.estado);
		mostrarform(true);
 	})
}
function limpiar(){

		$("#idcategoria").val("");
 		$("#nombre").val("");		
		$("#razon_social").val("");	
		$("#rtn").val("");	
		$("#direccion").val("");	
		$("#telefono").val("");	
		$("#correo").val("");	
		$("#sitio_web").val("");	
		$("#logotipo").val("");	
		$("#estado").val("");	

}
function guardarRegistro(){
		
		let $nombre = $("#nombre").val();		
		let $razon_social = $("#razon_social").val();	
		let $rtn = $("#rtn").val();	
		let $direccion = $("#direccion").val();	
		let $telefono = $("#telefono").val();	
		let $correo = $("#correo").val();	
		let $sitio_web = $("#sitio_web").val();	
		let $logotipo = $("#logotipo").val();

	if ($nombre.length == 0 || $nombre.trim() == "") {
			bootbox.alert("El nombre es obligatorio");
			return false;
	}
	if ($razon_social.length == 0 || $razon_social.trim() == "") {
		bootbox.alert("La razón social es obligatoria");
		return false;
	}
	if ($rtn.length == 0 || $rtn.trim() == "") {
		bootbox.alert("El RTN es obligatorio");
		return false;
	}
	if ($direccion.length == 0 || $direccion.trim() == "") {
		bootbox.alert("La dirección es obligatoria");
		return false;
	}
	if ($telefono.length == 0 || $telefono.trim() == "") {
		bootbox.alert("El teléfono es obligatorio");
		return false;
	}
	if ($correo.length == 0 || $correo.trim() == "") {	
		bootbox.alert("El correo es obligatorio");
		return false;
	}
	if ($sitio_web.length == 0 || $sitio_web.trim() == "") {	
		bootbox.alert("El sitio web es obligatorio");
		return false;
	}

	if (($logotipo.length == 0 || $logotipo.trim() == "") && $("#idcategoria").val() == ""){
		bootbox.alert("El logotipo es obligatorio");
		return false;
	}

	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/empresa.php?opc=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          	          
	          tabla.ajax.reload();
	    }

	});

	limpiar();
	mostrarform(false);
	listar();
//	$("#exampleModal").modal('hide');
}

/*tbllistado*/
function listar(){

	tabla=$('#example1').dataTable(
    {
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		       'copyHtml5','excelHtml5','csvHtml5','pdf'
		        ],
		"ajax":
				{
					url: '../ajax/empresa.php?opc=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
        "paging": false,
		
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
	

}


init();