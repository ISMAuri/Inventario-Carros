<?php
    session_start();

    
    if (!isset($_SESSION['nombre']) || empty($_SESSION['nombre'])) {
        header("Location: login.html");
        exit();
    }

    require_once "head.php";
?>

<?php if ($_SESSION['escritorio'] == 1) { ?>
  <div class="content-wrapper">
        <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Dashboard</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content pt-3">
      <div class="container-fluid">

         <!--INICIO -->
        <h5 class="mb-2"></h5>
        <div class="row">
          <div class="col-md-6 col-sm-6 col-12">
            <a href="inventario_carros.php">
            <div class="info-box shadow-none">
              <span class="info-box-icon bg-info"><i class="fas fa-tachometer-alt"></i></span>
              <div class="info-box-content">
                <!-- <span class="info-box-text">Inventario de Carros</span> -->
                <span class="info-box-number">Inventario de Carros</span>
                <!-- <span class="info-box-number">None</span> -->
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-6 col-sm-6 col-12">
            <a href="fotografias.php">
            <div class="info-box shadow-sm">
              <span class="info-box-icon bg-success"><i class="fas fa-camera"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Fotografías de Carros</span>
                <!-- <span class="info-box-number">Small</span> -->
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-6 col-sm-6 col-12">
            <a href="clientes.php">
            <div class="info-box shadow">
              <span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Clientes</span>
                <!-- <span class="info-box-number">Regular</span> -->
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-6 col-sm-6 col-12">
            <a href="facturas.php">
            <div class="info-box shadow-lg">
              <span class="info-box-icon bg-danger"><i class="fas fa-file-invoice"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Facturas</span>
                <!-- <span class="info-box-number">Large</span> -->
              </div>
            </div>
            </a>
          </div>

          <!-- <div class="col-md-6 col-sm-6 col-12">
            <a href="reportes.php">
            <div class="info-box shadow-none">
              <span class="info-box-icon bg-info"><i class="fas fa-chart-bar"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Reportes</span>
              </div>
            </div>
            </a>
          </div> -->

          <div class="col-md-6 col-sm-6 col-12">
            <a href="usuarios.php">
            <div class="info-box shadow-none">
              <span class="info-box-icon bg-info"><i class="fas fa-user-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Control de Usuarios</span>
                <!-- <span class="info-box-number">None</span> -->
              </div>
            </div>
            </a>
          </div>


        </div>


        <!-- FINAL -->
        <br>
      </div>
    </section>
  </div> <?php } ?>

<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
  $(function () {
    $('[data-mask]').inputmask()

    $('#reservationdate').datetimepicker({
      format: 'L'
    })

    $('#reservationdatetime').datetimepicker({
      icons: { time: 'far fa-clock' }
    })

    $('#reservation').daterangepicker()

    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })

    $('#daterange-btn').daterangepicker(
      {
        ranges: {
          Today: [moment(), moment()],
          Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
  });
</script>

<?php

    require_once "footer.php";
?>
