function init() {
    mostrarform(false);

}

function mostrarform(bandera) {
    
    if (bandera) {
        $("#listadoregistros").hide();
        $("#formularioregistro").show();
    }
    else {
        $("#listadoregistros").show();
        $("#formularioregistro").hide();
    }
}

function guardaryeditar() {

    let codigo = $("#codigo").val();
    let producto = $("#producto").val();
    let precio = parseInt($("#precio").val());
    let cantidad = parseInt($("#cantidad").val());
    let impuesto = $("#impuesto").val();
    let subtotal = precio * cantidad;
    

    let fila = "<tr class='fila' id='fila" + codigo + "'>" +
        "<td>" + codigo + "</td>" +
        "<td name='producto[]'>" + producto + "</td>" +
        "<td name='cantidad[]'>" + cantidad + "</td>" +
        "<td name='precio[]'>" + precio + "</td>" +
        "<td name='subtotal[]'>" + subtotal + "</td>" +
        "<td name='impuesto[]'>" + impuesto + "</td>" +
        // "<td><input type='number' style='background-color: yellow;' onclick='calcular()' onkeyup='calcular()' name='edad[]' value='" + edad + "'></td>"+ 
        // "<td><input type='hidden' name='sexo[]' value='" + sexo +"'>" + sexo + "</td>" +
        "<td><button type='button' onclick='quitarfila(" + codigo + ")' class='btn btn-danger'>Quitar</button></td>" +
        "</tr>";

        $("#cuerpo").append(fila);

        calcular();
        // mostrarform(false);

}

function calcular() {
    let cantidadl = document.getElementsByName("cantidad[]");
    let preciol = document.getElementsByName("precio[]");
    let subtotall = document.getElementsByName("subtotal[]");
    let impuestol = document.getElementsByName("impuesto[]");
    let gravado15=0,gravado18=0,impuesto15=0,impuesto18=0,exento=0,totali=0,descuento=0;
    let totalp = 0;

    let total15 = 0;
    let total18 = 0;

    for (let i = 0; i < cantidadl.length; i++) {

        if (impuestol[i].textContent == "15") {
        total15 += parseFloat(subtotall[i].textContent);
        }
        if (impuestol[i].textContent == "18") {
            total18 += parseFloat(subtotall[i].textContent);
        }
        if (impuestol[i].textContent == "0") {
            exento += parseFloat(subtotall[i].textContent);
        }
    }
    

    gravado15 = (total15/1.15).toFixed(2);
    gravado18 = (total18/1.18).toFixed(2);
    impuesto15 = (total15 - gravado15).toFixed(2);
    impuesto18 = (total18 - gravado18).toFixed(2);
    descuento = $("#descuentog").val();


    $("#gravado15").html(gravado15);
    $("#gravado18").html(gravado18);
    $("#impuesto15").html(impuesto15);
    $("#impuesto18").html(impuesto18);
    $("#exento").html(exento);
    $("#totalimp").html((parseFloat(impuesto15) + parseFloat(impuesto18)).toFixed(2));
    $("#descuento").html(parseFloat(descuento));
    $("#totalp").html((total15 + total18 + exento) - parseFloat(descuento));
    
    
    

}


function quitarfila(f) {
    $("#fila" + f).remove();
    calcular();
}

function pagar() {
    if (parseFloat($("#totalp").text()) > parseFloat($("#efectivo").val())) {
        alert("El efectivo es insuficiente");   
    }
    else {
        let cambio = parseFloat($("#efectivo").val()) - parseFloat($("#totalp").text());
        alert("Pago realizado con exito. Su cambio es: " + cambio.toFixed(2));
    }
}

// init();