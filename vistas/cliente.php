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
            <h1 class="m-0">Inventario de Carros</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Inventario de Carros</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
              <div class="card-header">
                
    <?PHP
if ($_SESSION['crearcl']==1)
    echo    '<button type="button" class="btn btn-success" onclick="mostrarform(true)">
          <i class="fa fa-plus" aria-hidden="true"></i>Crear registro</button>';
    ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="listadoregistros">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Cliente</th>
                    <th>Direccion</th>
                    <th>Telefono</th>                    
                    <th>Empresa</th>
                    <th>Estado</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Opciones</th>
                    <th>Cliente</th>
                    <th>Direccion</th>
                    <th>Telefono</th>                    
                    <th>Empresa</th>
                    <th>Estado</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  <div class="panel-body" id="formularioregistro" style="background: white;" >
      <h3>CREAR REGISTRO DE CLIENTES</h3>
     <form id="formulario" method="POST">
    <input type="hidden" id="idcategoria"  name="idcategoria">

    <div class="row">

        <div class="col-md-3">
            <label>Identidad:</label>
            <input type="text" name="identidad" id="identidad" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control">
        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-4">
            <label>Correo:</label>
            <input type="email" name="correo" id="correo" class="form-control">
        </div>

        <div class="col-md-4">
            <label>Fecha Inicial:</label>
            <input type="date" name="fecha_inicial" id="fecha_inicial" class="form-control">
        </div>

        <div class="col-md-4">
            <label>Fecha Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-6">
            <label>Dirección:</label>
            <textarea name="direccion" id="direccion" class="form-control"></textarea>
        </div>

        <div class="col-md-3">
            <label>Tipo:</label>
            <select name="tipo" id="tipo" class="form-control">
                <option value="">Seleccione</option>
                <option value="Empresa">Empresa</option>
                <option value="Personal">Personal</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Estado Civil:</label>
            <select name="estado_civil" id="estado_civil" class="form-control">
                <option value="">Seleccione</option>
                <option value="Soltero(a)">Soltero(a)</option>
                <option value="Casado(a)">Casado(a)</option>
                <option value="Viudo(a)">Viudo(a)</option>
                <option value="Otros">Otros</option>
            </select>
        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-3">
            <label>¿Trabaja?</label>
            <select name="trabaja" id="trabaja" class="form-control">
                <option value="No">No</option>
                <option value="Si">Si</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Empresa:</label>
            <input type="text" name="empresa" id="empresa" class="form-control">
        </div>

        <div class="col-md-3">
            <label>¿Vehículo Propio?</label>
            <select name="vehiculo_propio" id="vehiculo_propio" class="form-control">
                <option value="No">No</option>
                <option value="Si">Si</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Cargo:</label>
            <input type="text" name="cargo" id="cargo" class="form-control">
        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-4">
            <label>Estado Actual:</label>
            <select name="estado_actual" id="estado_actual" class="form-control">
                <option value="Activo">Activo</option>
                <option value="Bloqueado">Bloqueado</option>
            </select>
        </div>

        <div class="col-md-8">
            <label>Observaciones:</label>
            <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
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
<script src="js/cliente.js"></script>



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