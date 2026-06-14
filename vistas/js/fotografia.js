function init(){
    obtenerDatosCarro();
}

function obtenerDatosCarro(){

    $.post(
        "../ajax/fotografias.php?opc=datosCarro",
        function(r){

            $("#carro").html(r);

        }
    );
    
}

function mostrarCarro(){

    let idcarro = $("#carro").val();

    if (!idcarro) {
        $("#galeriaFotos").html("");
        return;
    }

    $.post(
        "../ajax/fotografias.php?opc=mostrarFotos",
        {
            idcarro:idcarro
        },
        function(r){

            $("#galeriaFotos").html(r);

        }
    );

}

init();