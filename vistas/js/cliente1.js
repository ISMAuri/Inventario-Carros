function init(){

    mostrarform(false);
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

init();