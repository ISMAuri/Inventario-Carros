<?php

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
                <button type="button" class='btn btn-success' onclick="mostrarform(true)">
                  <i class="fa fa-plus">Crear Registro</i>
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="listadoregistros">
                <table style="font-size: 11px;" id="example1" class="table table-sm table-bordered table-striped">
                  
                  <thead>

                  <tr>

                    <th>Codigo Producto</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Impuesto</th>
                    <th>Opcion</th>

                  </tr>

                  </thead>

                  <tbody id="cuerpo">
                    
                  </tbody>

                  <tfoot>
                  <tr>
                    
                    <th>Gravado 15%</th>
                    <td id="gravado15"></td>
                    
                    <th>Gravado 18%</th>
                    <td id="gravado18"></td>

                    <th>Impuesto 15%</th>
                    <td id="impuesto15"></td>

                    <th></th>
                  </tr>

                  <tr>
                    
                    <th>Impuesto 18%</th>
                    <td id="impuesto18"></td>
                    
                    <th>Exento</th>
                    <td id="exento"></td>

                    <th>Total Impuesto</th>
                    <td id="totalimp"></td>

                    <th></th>

                  </tr>

                  
                  <tr>
                    
                    <th>Descuento</th>
                    <td id="descuento"></td>
                    
                    <th>Total a pagar</th>
                    <td id="totalp"></td>

                    <th></th>
                    <td></td>

                    <th></th>

                  </tr>


                  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
  </div>
  <form action="">
    <div class="row">
        <div class="col-md-3 ml-4">
          <label for="">Efectivo</label>
          <input type="text" name="efectivo" id="efectivo" class="form-control">
        </div>
        
        <button type="button" class="btn btn-primary" onclick="pagar()">Pagar</button>
    </div>
  </form>
            <!-- /.card -->
<div class="panel-body ml-4 mr-4" id="formularioregistro">
  


    <h3>Datos del Cliente</h3>
    <form action="" id="formulario">
    <div class="row">

      <div class="col-md-3">
        <label for="">Nombre Cliente</label>
        <input class="form-control" type="text" name="nombre" id="nombre">
      </div>

      <div class="col-md-3">
        <label for="">RTN</label>
        <input class="form-control" type="text" name="RTN" id="RTN">
      </div>

      <div class="col-md-2">
        <label for="">Tipo de Pago</label>
        <select class="form-control" name="tipop" id="tipop">
          <option value="efectivo">Efectivo</option>
          <option value="tarjeta">Tarjeta</option>
        </select>
      </div>

      <div class="col-md-2">
        <label for="">Tipo de Factura</label>
        <select class="form-control" name="tipof" id="tipof">
          <option value="credito">Crédito</option>
          <option value="contado">Contado</option>
        </select>
      </div>

      <div class="col-md-2">
        <label for="">Fecha</label>
        <input class="form-control" type="date" name="fecha" id="fecha">
      </div>
      
    </div>


    </form>
    <br><br>


    <h3>Campos de Productos de Factura</h3>
    <form action="" id="formulario">
    <div class="row">

      <div class="col-md-3">
        <label for="">Codigo</label>
        <input class="form-control" type="text" name="codigo" id="codigo">
      </div>

      <div class="col-md-3">
        <label for="">Producto</label>
        <input class="form-control" type="text" name="producto" id="producto">
      </div>

      <div class="col-md-3">
        <label for="">Precio</label>
        <input class="form-control" type="text" name="precio" id="precio">
      </div>

      <div class="col-md-3">
        <label for="">Cantidad</label>
        <input class="form-control" type="number" name="cantidad" id="cantidad">
      </div>
      
    </div>


    <br>


    <br>
    <div class="row">

      <div class="col-md-2">
        <label for="">Impuesto</label>
        
        <select class="form-control" name="impuesto" id="impuesto">
          <option value="0">0%</option>
          <option value="15">15%</option>
          <option value="18">18%</option>
        </select>
      </div>

      <div class="col-md-3">
        <label for="">Descuento General de la Factura</label>
        <input type="text" name="descuentog" id="descuentog" class="form-control">
        
      </div>
    </div>


    <br>

    </form>

        <div class="row mt-3">

      <div class="col-md-3">
        <button type="button" class="btn btn-success" onclick="guardaryeditar()">
          <i class="fa fa-save">Guardar</i>
        </button>
      </div>

      <div class="col-md-3">
        <button type="button" class="btn btn-danger" onclick="mostrarform(false)">
          <i class="fa fa-times">Cancelar</i>
        </button>
      </div>
    </div>



    </div>
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
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<script src="js/factura.js"></script>