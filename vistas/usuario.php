<?php

    if (!isset($_SESSION['nombre']) || empty($_SESSION['nombre'])) {
        header("Location: login.html");
        exit();
    }

    require_once "head.php";
?>

  <div class="content-wrapper">


 <div class="card">
              <div class="card-header">
                <h3 class="card-title">REGISTRO DE CLIENTESxxxx</h3>
                <br>
        <button type="button" class="btn btn-success" onclick="mostrarform(true)">
          <i class="fa fa-plus" aria-hidden="true"></i>Crear registro</button>
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
    
       <form id="formulario"
                method="POST"
                enctype="multipart/form-data">

                <input type="hidden"
                    name="idusuario"
                    id="idusuario">

                <!-- FILA 1 -->
                <div class="row">

                    <!-- NOMBRE -->
                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Nombre</label>

                            <input type="text"
                                name="nombre"
                                id="nombre"
                                class="form-control"
                                placeholder="Nombre completo"
                                required>

                        </div>

                    </div>

                    <!-- LOGIN -->
                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Login</label>

                            <input type="text"
                                name="login"
                                id="login"
                                class="form-control"
                                placeholder="Usuario"
                                required>

                        </div>

                    </div>

                    <!-- CLAVE -->
                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Clave</label>

                            <input type="password"
                                name="clave"
                                id="clave"
                                class="form-control"
                                placeholder="********"
                                required>

                        </div>

                    </div>

                    <!-- CARGO -->
                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Cargo</label>

                            <input type="text"
                                name="cargo"
                                id="cargo"
                                class="form-control"
                                placeholder="Cargo">

                        </div>

                    </div>

                </div>

                <!-- FILA 2 -->
                <div class="row">

                    <!-- IMAGEN -->
                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Imagen</label>

                            <input type="file"
                                name="imagen"
                                id="imagen"
                                class="form-control">

                        </div>

                    </div>

                    <!-- ESTADO -->
                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Estado</label>

                            <select name="condicion"
                                id="condicion"
                                class="form-control">

                                <option value="1">
                                    Activado
                                </option>

                                <option value="0">
                                    Desactivado
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

              
                <div class="row mt-3">

                    <div class="col-md-12">

                        <div class="card border-primary">

                            <div class="card-header bg-primary text-white">

                                <i class="fas fa-user-shield"></i>
                                Permisos del Usuario

                            </div>

                            <div class="card-body">

                                <div class="row">
                                    <label>Permisos</label>
                                    <div id="listadopermisos"></div>
                                  
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

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