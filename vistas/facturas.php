<?php
    session_start();

if (!isset($_SESSION['nombre']) || empty($_SESSION['nombre'])) {
    header("Location: login.html");
    exit();
}

    require_once "head.php";
?>

  <div class="content-wrapper">


 <div class="card">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Registro de Facturas</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Registro de Facturas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
              <div class="card-header">
                
    <?PHP
if ($_SESSION['crearcl']==1)
    echo    '<button type="button" class="btn btn-primary" onclick="mostrarform(true)">
          <i class="fa fa-plus" aria-hidden="true"></i>Crear Factura</button>';
    ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="listadoregistros">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Opciones</th>
                        <th>No. Factura</th>
                        <th>Fecha</th>
                        <th>Nombre Cliente</th>
                        <th>Nombre Usuario</th>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>Impuestos</th>
                        <th>Total</th>
                        <th>Método de Pago</th>
                        <th>Estado</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                        <th>Opciones</th>
                        <th>No. Factura</th>
                        <th>Fecha</th>
                        <th>Nombre Cliente</th>
                        <th>Nombre Usuario</th>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>Impuestos</th>
                        <th>Total</th>
                        <th>Método de Pago</th>
                        <th>Estado</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  <div class="panel-body p-4" id="formularioregistro" style="background: white;" >
      <h3><b>Crear Factura</b></h3>
      <br>
     <form id="formulario" method="POST">
    <input type="hidden" id="idcliente"  name="idcliente">


    <h4>Datos del Cliente</h4>
    <div class="row">

        <div class="col-md-5">
            <label>Cliente:</label>
            <select name="cliente" id="cliente" class="form-control" onchange="mostrarCliente()">
            </select>
        </div>
    </div>
    <br>

    
    <div class="row datos-cliente">

        <div class="col-md-3">
            <label>Tipo de Cliente:</label>
            <select name="tipocliente" id="tipocliente" class="form-control">
                <option value="Natural">Natural</option>
                <option value="Juridica">Jurídica</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>RTN:</label>
            <input type="text" name="rtn" id="rtn" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Nombre Completo / Razón Social:</label>
            <input type="text" name="nombre" id="nombre" class="form-control">
        </div>


        <div class="col-md-3">
            <label>Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control">
        </div>

    </div>

    <br>

    <div class="row datos-cliente">

        <div class="col-md-4">
            <label>Correo Electrónico:</label>
            <input type="email" name="correoelectronico" id="correoelectronico" class="form-control">
        </div>

        
        <div class="col-md-5">
            <label>Dirección:</label>
            <textarea name="direccion" id="direccion" class="form-control"></textarea>
        </div>

        <div class="col-md-3">
            <label>Estado:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="Activo" selected>Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>

    </div>

    <br>

    
    <h4>Datos del Carro</h4>
    <div class="row">
        <input type="hidden" id="idcarro" name="idcarro">
        <div class="col-md-5">
            <label>Carro:</label>
            <select name="carro" id="carro" class="form-control">
            </select>
        </div>
    </div>
    <br>

    <div class="row datos-carro">

        <div class="col-md-3">
            <label>Kilometraje:</label>
            <input type="text" name="kilometraje" id="kilometraje" class="form-control" readonly>
        </div>

        <div class="col-md-3">
            <label>Tipo Combustible:</label>
            <input type="text" name="tipocombustible" id="tipocombustible" class="form-control" readonly>
        </div>

        
        <div class="col-md-3">
            <label>Transimision:</label>
            <input type="text" name="transmision" id="transmision" class="form-control" readonly>
        </div>

    
        <div class="col-md-3">
            <label>Precio venta:</label>
            <input type="text" name="precioventa" id="precioventa" class="form-control" readonly>
        </div>


    </div>

    <br>


    <br>
    <h4>Datos de la Factura</h4>

    <div class="row">

        <div class="col-md-3">
            <label>Fecha:</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo date('Y-m-d');?>">
        </div>

        <div class="col-md-3 datos-cliente">
            <label>Método de Pago:</label>
            <select name="metodopago" id="metodopago" class="form-control">
                <option value="Efectivo">Efectivo</option>
                <option value="Tarjeta">Tarjeta</option>
                <option value="Transferencia">Transferencia</option>
            </select>
        </div>

                <div class="col-md-3">
            <label>Estado:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="Pendiente">Pendiente</option>
                <option value="Pagada">Pagada</option>
                <option value="Anulada">Anulada</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Descuento:</label>
            <input type="number" name="descuento" id="descuento" class="form-control">
        </div>

    </div>

    <br>

    <div class="row">



    </div>

    <br>

    <div class="row">

        <div class="col-md-3">
            <button class="btn btn-success" type="button" onclick="guardarRegistro()">
                <i class="fa fa-save"></i> Guardar
            </button>
        </div>

        <div class="col-md-3">
            <button class="btn btn-danger" type="button" onclick="mostrarform(false)">
                <i class="fa fa-times"></i> Cancelar
            </button>
        </div>

    </div>

</form>


  </div>

</div>



<?php
    
    require_once "footer.php";
?>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script src="js/facturas.js"></script>



<!-- 
CREATE TABLE personas (
    id INT AUTO_INCREMENT PRIMARY KEY,

    identidad VARCHAR(20) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,

    telefono VARCHAR(20),
    correo VARCHAR(150),

    direccion TEXT,

    fecha_inicial DATE,
    fecha_nacimiento DATE,

    tipo ENUM('Empresa', 'Personal') NOT NULL,

    estado_civil ENUM(
        'Soltero(a)',
        'Casado(a)',
        'Viudo(a)',
        'Otros'
    ),

    trabaja ENUM('Si', 'No') DEFAULT 'No',

    empresa VARCHAR(150),

    vehiculo_propio ENUM('Si', 'No') DEFAULT 'No',

    cargo VARCHAR(100),

    estado_actual ENUM(
        'Activo',
        'Bloqueado'
    ) DEFAULT 'Activo',

    observaciones TEXT,

    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-->