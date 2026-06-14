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
function activar(idcarro){


bootbox.confirm("¿Está seguro de marcar el carro como disponible?", function(result){
		if(result)
        {
        	$.post("../ajax/inventario_carros.php?opc=activar", {idcarro : idcarro}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
	
}
function anular(idcarro){
bootbox.confirm("¿Está seguro de marcar el carro como en mantenimiento?", function(result){
		if(result)
        {
        	$.post("../ajax/inventario_carros.php?opc=anular", {idcarro : idcarro}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
	
}
function mostrar(idcarro){
	
$.post("../ajax/inventario_carros.php?opc=mostrar",{idcarro : idcarro}, function(data, status)
	{
		data = JSON.parse(data);					
 		$("#idcarro").val(data.idcarro);
		$("#vin").val(data.vin);
		$("#marca").val(data.marca);
		$("#modelo").val(data.modelo);
		$("#anio").val(data.anio);
		$("#color").val(data.color);
		$("#placa").val(data.placa);
		$("#kilometraje").val(data.kilometraje);
		$("#tipocombustible").val(data.tipocombustible);
		$("#tipocarroceria").val(data.tipocarroceria);
		$("#preciocompra").val(data.preciocompra);
		$("#precioventa").val(data.precioventa);
		$("#fechaingreso").val(data.fechaingreso);
		$("#estado").val(data.estado);
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

	var fotos = pond.getFiles();
	// console.log("fotos: ", fotos);
	fotos.forEach((foto, indice) => {
		// console.log("foto: ", foto);
		formData.append("fotos[]", foto.file);
	});

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