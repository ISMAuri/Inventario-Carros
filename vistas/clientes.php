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
            <h1 class="m-0"><b>Registro de Clientes</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Registro de Clientes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
              <div class="card-header">
                
    <?PHP
if ($_SESSION['crearclientes']==1)
    echo    '<button type="button" class="btn btn-primary" onclick="mostrarform(true)">
          <i class="fa fa-plus" aria-hidden="true"></i>Añadir Cliente</button>';
    ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="listadoregistros">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Tipo de Cliente</th>
                    <th>RTN</th>
                    <th>Nombre Completo / Razón Social</th>                    
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Dirección</th>
                    <th>Fecha de Registro</th>
                    <th>Estado</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Opciones</th>
                    <th>Tipo de Cliente</th>
                    <th>RTN</th>
                    <th>Nombre Completo / Razón Social</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Dirección</th>
                    <th>Fecha de Registro</th>
                    <th>Estado</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  <div class="panel-body p-4" id="formularioregistro" style="background: white;" >
      <h3><b>Registrar un Cliente</b></h3>
      <br>
     <form id="formulario" method="POST">
    <input type="hidden" id="idcliente"  name="idcliente">

    <div class="row">

        <div class="col-md-3">
            <label>Tipo de Cliente:</label>
            <select name="tipocliente" id="tipocliente" class="form-control">
                <option value="Natural">Natural</option>
                <option value="Juridica">Jurídica</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>RTN:</label>
            <input type="number" name="rtn" id="rtn" class="form-control">
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

    <div class="row">

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
<script src="js/clientes.js"></script>



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