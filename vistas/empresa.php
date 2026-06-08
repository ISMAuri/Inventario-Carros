<?php
    session_start();

if (!isset($_SESSION['nombre']) || empty($_SESSION['nombre'])) {
    header("Location: login.html");
    exit();
}

    require_once "head.php";
?>
<style>
    #example1_filter input[type="search"] {
        width: 360px;
    }
</style>


  <div class="content-wrapper">


 <div class="card ">
              <div class="card-header">
                <h3 class="card-title">REGISTRO DE EMPRESAS</h3>
                <br>
    <?PHP
if ($_SESSION['crearempresa']==1)
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
                    <th>Nombre</th>
                    <th>Razon Social</th>
                    <th>RTN</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Sitio Web</th>                    
                    <th>Logotipo</th>
                    <th>Estado</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Razon Social</th>
                    <th>RTN</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Sitio Web</th> 
                    <th>Logotipo</th>
                    <th>Estado</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  <div class="panel-body p-3" id="formularioregistro" style="background: white;" >
      <h3>CREAR REGISTRO DE EMPRESAS</h3>
     <form id="formulario" method="POST">
    <input type="hidden" id="idcategoria"  name="idcategoria">

    <div class="row">

        <div class="col-md-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Razon Social:</label>
            <input type="text" name="razon_social" id="razon_social" class="form-control">
        </div>

        <div class="col-md-3">
            <label>RTN:</label>
            <input type="text" name="rtn" id="rtn" class="form-control">
        </div>
        <div class="col-md-3">
            <label>Direccion:</label>
            <textarea name="direccion" id="direccion" class="form-control"></textarea>
        </div>

    </div>

    <br>

    <div class="row">
        <div class="col-md-3">
            <label>Telefono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Correo:</label>
            <input type="email" name="correo" id="correo" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Sitio Web:</label>
            <input type="text" name="sitio_web" id="sitio_web" class="form-control">
        </div>

        <div class="col-md-3">

            <div class="form-group">
                <label>Logotipo</label>
                <input type="file" name="logotipo" id="logotipo" class="form-control">
            </div>
        </div>

        <!-- <div class="col-md-4">
            <label>Fecha Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
        </div> -->

    </div>

    <br>

    <div class="row">


        <div class="col-md-3">
            <label>Estado:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="Activa">Activa</option>
                <option value="Inactiva">Inactiva</option>
            </select>
        </div>

    </div>

    <br>
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
    // console.log($('div.dataTables_filter label').contents());
    // console.log($('div.dataTables_filter label').contents()[0]);
    $('div.dataTables_filter label').contents()[0].textContent = "Buscar por cualquier campo:";
  });
    

</script>
<script src="js/empresa.js"></script>



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