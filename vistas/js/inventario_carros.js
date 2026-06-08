$.fn.dataTable.ext.errMode = function () {};
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

    }

}
function activar(idcategoria){


bootbox.confirm("¿Está Seguro de activar el cliente?", function(result){
		if(result)
        {
        	$.post("../ajax/inventario_carros.php?opc=activar", {idcategoria : idcategoria}, function(e){
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
        	$.post("../ajax/inventario_carros.php?opc=anular", {idcategoria : idcategoria}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
	
}
function mostrar(idcategoria){
	
$.post("../ajax/inventario_carros.php?opc=mostrar",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);					
 		$("#idcategoria").val(data.id);
 		$("#nombre").val(data.nombre);		
		$("#apellido").val(data.apellido);		
		$("#identidad").val(data.identidad);	
		$("#telefono").val(data.telefono);	
		$("#correo").val(data.correo);	
		$("#tipo").val(data.tipo);			
		//$("#tipo").val(data.tipo).trigger('change');
		$("#estado_civil").val(data.estado_civil);			
		$("#fecha_nacimiento").val(data.fecha_nacimiento);	
		$("#fecha_inicial").val(data.fecha_inicial);	
		$("#trabaja").val(data.trabaja);	
		$("#empresa").val(data.empresa);		
		$("#vehiculo_propio").val(data.vehiculo_propio);	
		$("#cargo").val(data.cargo);			
		$("#estado_actual").val(data.estado_actual);	
		$("#observaciones").val(data.observaciones);	
		mostrarform(true);
 	})
}
function limpiar(){
$("#idcategoria").val("");
 		$("#nombre").val("");		
		$("#apellido").val("");		
		$("#identidad").val("");	
		$("#telefono").val("");	
		$("#correo").val("");	
		$("#tipo").val("");			
		//$("#tipo").val(data.tipo).trigger('change');
		$("#estado_civil").val("");			
		$("#trabaja").val("Si");	
		$("#empresa").val("");		
		$("#cargo").val("");			
		$("#observaciones").val("");	

}
function guardarRegistro(){
	

	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/inventario_carros.php?opc=guardaryeditar",
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
					url: '../ajax/inventario_carros.php?opc=listar',
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