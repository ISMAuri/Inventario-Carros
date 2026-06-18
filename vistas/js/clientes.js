$.fn.dataTable.ext.errMode = 'none';
var tabla;
function init(){
mostrarform(false);
	listar();
	limpiar();



}
function mostrarform(bandera){

    if (bandera){
        $("#listadoregistros").hide();
        $("#formularioregistro").show();
        
    }else
    {
        $("#listadoregistros").show();
        $("#formularioregistro").hide();
		// limpiar();

    }

}
function activar(idcliente){


bootbox.confirm("¿Está seguro de activar el cliente?", function(result){
		if(result)
        {
        	$.post("../ajax/clientes.php?opc=activar", {idcliente : idcliente}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
	
}
function anular(idcliente){


bootbox.confirm("¿Está seguro de desactivar el estado del cliente?", function(result){
		if(result)
        {
        	$.post("../ajax/clientes.php?opc=anular", {idcliente : idcliente}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
	
}
function mostrar(idcliente){
	
$.post("../ajax/clientes.php?opc=mostrar",{idcliente : idcliente}, function(data, status)
	{
		data = JSON.parse(data);					
 		$("#idcliente").val(data.idcliente);
 		$("#nombre").val(data.nombre);		
		$("#apellido").val(data.apellido);		
		$("#rtn").val(data.rtn);	
		$("#telefono").val(data.telefono);	
		$("#correoelectronico").val(data.correoelectronico);	
		$("#direccion").val(data.direccion);	
		$("#tipocliente").val(data.tipocliente);			
		//$("#tipocliente").val(data.tipocliente).trigger('change');
		mostrarform(true);
 	})
}
function limpiar(){
		$("#idcliente").val("");
 		$("#nombre").val("");		
		$("#apellido").val("");		
		$("#rtn").val("");	
		$("#telefono").val("");	
		$("#correoelectronico").val("");	
		$("#tipocliente").val("Natural");	
		$("#direccion").val("");			
		//$("#tipocliente").val(data.tipocliente).trigger('change');
		$("#estado").val("Activo");

}
function guardarRegistro(){


	if ($("#rtn").val().trim() == "" || $("#rtn").val().trim().length != 14) {
		bootbox.alert("Por favor, ingrese el RTN del cliente, debe constar de 14 dígitos.");
		return;
	}
	if ($("#nombre").val().trim() == "") {
		bootbox.alert("Por favor, ingrese el nombre del cliente.");
		return;
	}
	if ($("#telefono").val().trim() == "") {
		bootbox.alert("Por favor, ingrese el número de teléfono del cliente.");
		return;
	}
	if ($("#correoelectronico").val().trim() == "" || !$("#correoelectronico").val().trim().includes("@")) {
		bootbox.alert("Por favor, ingrese un correo electrónico válido del cliente.");
		return;
	}
	if ($("#direccion").val().trim() == "" || $("#direccion").val().trim().length < 10) {
		bootbox.alert("Por favor, ingrese la dirección del cliente, debe tener al menos 10 caracteres.");
		return;
	}


	

	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/clientes.php?opc=guardaryeditar",
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
					url: '../ajax/clientes.php?opc=listar',
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