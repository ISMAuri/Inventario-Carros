$.fn.dataTable.ext.errMode = 'none';
var tabla;
function init(){
mostrarform(false);
	listar();
	limpiar();
	listarPermisos();


}

function listarPermisos(){

    $.post("../ajax/usuarios.php?opc=permisos",

    function(r){

        $("#listadopermisos").html(r);

    });

}

function mostrarform(bandera){

    if (bandera){
        $("#listadoregistros").hide();
        $("#formularioregistro").show();
		// limpiar();
        
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
        	$.post("../ajax/usuarios.php?opc=activar", {idcategoria : idcategoria}, function(e){
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
        	$.post("../ajax/usuarios.php?opc=anular", {idcategoria : idcategoria}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
	
}
function mostrar(idcategoria){
	
$.post("../ajax/usuarios.php?opc=mostrar",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);	
		console.log(data);				
 		$("#idcategoria").val(data.idusuario);
 		$("#nombre").val(data.nombre);		
		$("#login").val(data.login);		
		$("#clave").val(data.clave);	
		$("#cargo").val(data.cargo);
		// //$("#tipo").val(data.tipo).trigger('change');
		$("#estado").val(data.estado);		

		$('input[name="permisos[]"]').prop('checked', false);

        // marcar
        data.permisos.forEach(function(idpermiso) {
            $('input[name="permisos[]"][value="' + idpermiso + '"]').prop('checked', true);
        });

		mostrarform(true);
 	})
}
function limpiar(){
		$("#idcategoria").val("");
 		$("#nombre").val("");		
		$("#login").val("");		
		$("#clave").val("");	
		$("#cargo").val("");	
		$("#imagen").val("");	
		// $("#estado").val("Activado");			
		//$("#tipo").val(data.tipo).trigger('change');
		
}
function guardarRegistro(){
	

	let clave = $("#clave").val();
	let nombre = $("#nombre").val();
	let login = $("#login").val();
	let cargo = $("#cargo").val();
	let imagen = $("#imagen").val();

	if (clave.length == 0 || clave.trim() == ""){
		bootbox.alert("La clave es obligatoria");
		return false;
	}
	if (clave.length < 8 || clave.length > 20){
		bootbox.alert("La clave debe tener entre 8 y 20 caracteres");
		return false;
	}
	if (clave == clave.toLowerCase()){
		bootbox.alert("La clave debe contener al menos una letra mayúscula");
		return false;
	}
	

	let tieneNum = false;
	for (let caracter of clave) {
		if (caracter >= '0' && caracter <= '9') {
			tieneNum = true; break;
		}
	}
	if (!tieneNum){
		bootbox.alert("La clave debe contener al menos un número");
		return false;
	}


	if (nombre.length == 0 || nombre.trim() == ""){
		bootbox.alert("El nombre es obligatorio");
		return false;
	}
	if (login.length == 0 || login.trim() == ""){
		bootbox.alert("El login es obligatorio");
		return false;
	}
	if (cargo.length == 0 || cargo.trim() == ""){
		bootbox.alert("El cargo es obligatorio");
		return false;
	}

	if ((imagen.length == 0 || imagen.trim() == "") && $("#idcategoria").val() == ""){
		bootbox.alert("La imagen es obligatoria");
		return false;
	}

	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/usuarios.php?opc=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          	          
	          
			  if (datos != "La imagen es obligatoria" && datos != "El nombre de usuario ya existe"){
				tabla.ajax.reload();
				limpiar();
				mostrarform(false);
				listar();
			  }

	    }

	});

	
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
		      
		        ],
		"ajax":
				{
					url: '../ajax/usuarios.php?opc=listar',
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