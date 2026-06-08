/*function verificar(){

    let usuario=$("#usuario").val();
    let clave=$("#clave").val();
    alert("Usuario :"+usuario+" Clave:"+clave);

}*/
function init(){
  /*  Swal.fire(
            "Aviso",
            "Ingrese usuario y contraseña",
            "warning");*/
}


function verificar(){
    let logina = $("#usuario").val();
    let clavea = $("#clave").val();
    // alert("Usuario "+logina+" clave "+clavea);
    if(logina=="" || clavea==""){
        Swal.fire({
            title: "Aviso",
            text: "Ingrese usuario y contraseña",
            icon: "warning"
        });
        return;
    }

    $.post(

        "../ajax/usuarios.php?opc=verificar",
        {

            logina:logina,
            clavea:clavea

        },
        function(respuesta){
            let cargo = JSON.parse(respuesta); 
            // alert("Cargo "+cargo);
        //    if(cargo=="Administrador"){
            if(cargo.length > 0){
             Swal.fire({
                    icon:"success",
                    title:"Bienvenido",
                    text:"Accediendo..."

                });
 
                setTimeout(function(){

                    window.location.href="tablero.php";

                },1000);

 

            }else{

                    // alert("Usuario o contraseña incorrectos");

                Swal.fire({

                    icon:"error",

                    title:"Acceso denegado",

                    text:"Usuario o contraseña incorrectos"

                });

 

            }

 

        }

    );

 

}
init();
