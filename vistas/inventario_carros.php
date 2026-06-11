<?php
    session_start();

    if (!isset($_SESSION['nombre']) || empty($_SESSION['nombre'])) {
        header("Location: login.html");
        exit();
    }

    require_once "head.php";
?>
<link
    href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
    rel="stylesheet"
/>

  <div class="content-wrapper">


 <div class="card">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Inventario de Carros</b></h1>
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
                
        <button type="button" class="btn btn-primary" onclick="mostrarform(true)">
          <i class="fa fa-plus" style='margin-right: 3px;' aria-hidden="true"></i>Agregar Carro</button>
          
              <br>
              
              </div>
              
              <!-- /.card-header -->
              <div class="card-body" id="listadoregistros">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>VIN</th>   
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>                    
                    <th>Km</th>
                    <th>Precio Venta</th>
                    <th>Estado</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Opciones</th>
                    <th>VIN</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>                    
                    <th>Km</th>
                    <th>Precio Venta</th>
                    <th>Estado</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  <div class="panel-body pt-4 pl-5 pr-5" id="formularioregistro"  style="background: white;" >
      <h3><b>Registrar un Carro</b></h3>
      <br><br>
     <form id="formulario" method="POST">
    <input type="hidden" id="idcarro"  name="idcarro">

    <div class="row">

        <div class="col-md-3">
            <label>VIN:</label>
            <input type="text" name="vin" id="vin" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Marca:</label>
            <input type="text" name="marca" id="marca" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Modelo:</label>
            <input type="text" name="modelo" id="modelo" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Año:</label>
            <input type="text" name="anio" id="anio" class="form-control">
        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-3">
            <label>Color:</label>
            <input type="text" name="color" id="color" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Placa:</label>
            <input type="text" name="placa" id="placa" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Kilometraje:</label>
            <input type="text" name="kilometraje" id="kilometraje" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="tipocombustible">Tipo de Combustible</label>
            <select name="tipocombustible" id="tipocombustible" class="form-control" required>
                <option value="Gasolina">Gasolina</option>
                <option value="Diesel">Diésel</option>
                <option value="Hibrido">Híbrido</option>
                <option value="Electrico">Eléctrico</option>
            </select>
        
        </div>

    </div>

    <br>

    
    <div class="row">

        <div class="col-md-3">
            <label for="transmision">Transmisión</label>
            <select name="transmision" id="transmision" class="form-control" required>
                <option value="Automatica">Automática</option>
                <option value="Manual">Manual</option>
                <option value="CVT">CVT</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="tipocarroceria">Tipo de Carrocería</label>
            <select name="tipocarroceria" id="tipocarroceria" class="form-control">
                <option value="Sedan">Sedan</option>
                <option value="Hatchback">Hatchback</option>
                <option value="SUV">SUV</option>
                <option value="Pickup">Pickup</option>
                <option value="Coupe">Coupe</option>
                <option value="Convertible">Convertible</option>
                <option value="Van">Van</option>
                <option value="Otro">Otro</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Precio de Compra:</label>
            <input type="text" name="preciocompra" id="preciocompra" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Precio de Venta:</label>
            <input type="text" name="precioventa" id="precioventa" class="form-control">
        </div>

        

    </div>
    <br>

    <div class="row">
        <div class="col-md-3">
            <label>Gastos Extra:</label>
            <input type="number" name="gastosextra" id="gastosextra" class="form-control" value="0">
            
        </div>

        <div class="col-md-2">
            <label>Fecha de Ingreso:</label>
            <input type="date" name="fechaingreso" id="fechaingreso" class="form-control">
        </div>

        <div class="col-md-2">
            <label>Estado:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="Disponible">Disponible</option>
                <option value="Vendido">Vendido</option>
                <option value="Reservado">Reservado</option>
                <option value="Mantenimiento">Mantenimiento</option>
            </select>
        </div>
        

        <div class="col-md-5">
            <label>Observaciones:</label>
            <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
        </div>

    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <label>Fotos:</label>
            <input type="file" class="filepond" id="fotos" name="fotos[]" multiple>
        </div>

    </div>

    <br>

    <div class="row border-top pt-3 justify-content-center">

        <div class="col-md-2">
            <button class="btn btn-success" type="button" onclick="guardarRegistro()">
                <i class="fa fa-save"></i> Guardar
            </button>
        </div>

        <div class="col-md-2">
            <button class="btn btn-danger" type="button" onclick="mostrarform(false)">
                <i class="fa fa-times"></i> Cancelar
            </button>
        </div>

    </div>
    <br><br>

</form>


  </div>

</div>



<?php
    
    require_once "footer.php";
?>

<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
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

    FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginImagePreview);

    const pond = FilePond.create(document.querySelector('#fotos'),{
        acceptedFileTypes: ['image/*'],
        allowMultiple: true,
        imagePreviewHeight: 120,
        labelIdle: 'Arrastre las fotografías aquí o <span class="filepond--label-action">Seleccione archivos</span>'
    }) ;


</script>

<script src='js/inventario_carros.js'></script>



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