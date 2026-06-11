var tabla;
function init() {
  mostrarform(false);
  listar();
  limpiar();
  obtenerDatosFactura();
  obtenerDatosCarro();
}
function mostrarform(bandera) {
  if (bandera) {
    $("#listadoregistros").hide();
    $("#formularioregistro").show();
    mostrarCarro();
  } else {
    $("#listadoregistros").show();
    $("#formularioregistro").hide();
    // limpiar();
  }

  
}
function activar(idfactura) {
  bootbox.confirm("¿Está Seguro de activar el factura?", function (result) {
    if (result) {
      $.post(
        "../ajax/facturas.php?opc=activar",
        { idfactura: idfactura },
        function (e) {
          bootbox.alert(e);
          tabla.ajax.reload();
        },
      );
    }
  });
}
function anular(idfactura) {
  bootbox.confirm("¿Está Seguro de anular el factura?", function (result) {
    if (result) {
      $.post(
        "../ajax/facturas.php?opc=anular",
        { idfactura: idfactura },
        function (e) {
          bootbox.alert(e);
          tabla.ajax.reload();
        },
      );
    }
  });
}
function mostrar(idfactura) {
  $.post(
    "../ajax/facturas.php?opc=mostrar",
    { idfactura: idfactura },
    function (data, status) {
      data = JSON.parse(data);
      $("#idfactura").val(data.id);
      $("#nombre").val(data.nombre);
      $("#apellido").val(data.apellido);
      $("#rtn").val(data.rtn);
      $("#telefono").val(data.telefono);
      $("#correoelectronico").val(data.correoelectronico);
      $("#tipofactura").val(data.tipofactura);
      //$("#tipofactura").val(data.tipofactura).trigger('change');
		mostrarform(true);
    },
  );
}
function limpiar() {
  $("#idfactura").val("");
  $("#nombre").val("");
  $("#apellido").val("");
  $("#rtn").val("");
  $("#telefono").val("");
  $("#correoelectronico").val("");
  $("#tipofactura").val("");
  //$("#tipofactura").val(data.tipofactura).trigger('change');
  $("#estado").val("");
}
function guardarRegistro() {
  var formData = new FormData($("#formulario")[0]);
  $.ajax({
    url: "../ajax/facturas.php?opc=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
      bootbox.alert(datos);
      tabla.ajax.reload();
    },
  });

  limpiar();
  mostrarform(false);
  listar();
  //	$("#exampleModal").modal('hide');
}

/*tbllistado*/
function listar() {
  tabla = $("#example1")
    .dataTable({
      aProcessing: true, //Activamos el procesamiento del datatables
      aServerSide: true, //Paginación y filtrado realizados por el servidor
      dom: "Bfrtip", //Definimos los elementos del control de tabla
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdf"],
      ajax: {
        url: "../ajax/facturas.php?opc=listar",
        type: "get",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      bDestroy: true,
      paging: false,

      order: [[0, "desc"]], //Ordenar (columna,orden)
    })
    .DataTable();
}

init();

function obtenerDatosFactura() {

    $.post("../ajax/facturas.php?opc=datosFactura",

    function(r){

        $("#cliente").html(r);

    });

}

function obtenerDatosCarro() {

  console.log("Obteniendo datos del carro...");
    $.post("../ajax/facturas.php?opc=datosCarro",

    function(r){

        $("#carro").html(r);

    });

}

function mostrarCliente() {
    idcliente = $("#cliente").val();
    // alert(idcliente);

    if (idcliente != 0) {
      $('.datos-cliente div select, .datos-cliente div input, .datos-cliente div textarea').prop('disabled', true);
      $.post(
          "../ajax/facturas.php?opc=datosCliente",
          { idcliente: idcliente },
          function (data, status) {
            data = JSON.parse(data);
            $("#nombre").val(data.nombre);
            $("#tipocliente").val(data.tipocliente);
            $("#rtn").val(data.rtn);
            $("#telefono").val(data.telefono);
            $("#correoelectronico").val(data.correoelectronico);
            $("#direccion").val(data.direccion);
            $("#estado").val(data.estado);
          },);


    }
    if (idcliente == 0) {
      $('.datos-cliente div select, .datos-cliente div input, .datos-cliente div textarea').prop('disabled', false);
            $("#nombre").val("");
            $("#tipocliente").val("");
            $("#rtn").val("");
            $("#telefono").val("");
            $("#correoelectronico").val("");
            $("#direccion").val("");
            $("#estado").val("Activo");
      

    }

}


function mostrarCarro() {
    idcarro = $("#carro").val();
    // alert(idcarro);

    if (idcarro != 0) {
      $('.datos-carro div select, .datos-carro div input, .datos-carro div textarea').prop('disabled', true);
      $.post(
          "../ajax/facturas.php?opc=mostrarCarro",
          { idcarro: idcarro },
          function (data, status) {
            data = JSON.parse(data);
            $("#kilometraje").val(data.kilometraje);
            $("#tipocombustible").val(data.tipocombustible);
            $("#transmision").val(data.transmision);
            $("#precioventa").val(data.precioventa);
          },);


    }
    // if (idcarro == 0) {
    //   $('.datos-carro div select, .datos-carro div input, .datos-carro div textarea').prop('disabled', false);
    //             $("#nombre").val("");
    //         $("#tipocliente").val("");
    //         $("#rtn").val("");
    //         $("#telefono").val("");
    //         $("#correoelectronico").val("");
    //         $("#direccion").val("");
    //         $("#estado").val("Activo");
    // }

}