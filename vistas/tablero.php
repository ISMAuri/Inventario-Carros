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
            <h1 class="m-0">Dashboard</h1>
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

         <!-- INICIO -->
        <h5 class="mb-2">Info Box With Custom Shadows <small><i>Using Bootstrap's Shadow Utility</i></small></h5>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-none">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Shadows</span>
                <span class="info-box-number">None</span>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Shadows</span>
                <span class="info-box-number">Small</span>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Shadows</span>
                <span class="info-box-number">Regular</span>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-lg">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Shadows</span>
                <span class="info-box-number">Large</span>
              </div>
            </div>
          </div>
        </div>

        <h5 class="mt-4 mb-2">Info Box With <code>bg-*</code></h5>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Bookmarks</span>
                <span class="info-box-number">41,410</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  70% Increase in 30 Days
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  70% Increase in 30 Days
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Events</span>
                <span class="info-box-number">41,410</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  70% Increase in 30 Days
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fas fa-comments"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Comments</span>
                <span class="info-box-number">41,410</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  70% Increase in 30 Days
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- FINAL -->

        <!-- INICIO -->
        <div class="row mt-4">
          <div class="col-lg-6">
            <div class="card card-danger h-100">
              <div class="card-header">
                <h3 class="card-title">Input masks</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Date masks:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask>
                  </div>
                </div>

                <div class="form-group">
                  <label>US phone mask:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                </div>

                <div class="form-group">
                  <label>Intl US phone mask:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control"
                           data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                  </div>
                </div>

                <div class="form-group mb-0">
                  <label>IP mask:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    </div>
                    <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card card-primary h-100">
              <div class="card-header">
                <h3 class="card-title">Date picker</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Date:</label>
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Date and time:</label>
                  <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                    <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Date range:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservation">
                  </div>
                </div>

                <div class="form-group">
                  <label>Date and time range:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-clock"></i></span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservationtime">
                  </div>
                </div>

                <div class="form-group mb-0">
                  <label>Date range button:</label>
                  <div class="input-group">
                    <button type="button" class="btn btn-default" id="daterange-btn">
                      <i class="far fa-calendar-alt"></i> <span>Date range picker</span>
                      <i class="fas fa-caret-down"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                Visit <a href="https://getdatepicker.com/5-4/">tempusdominus</a> for more examples and information about the plugin.
              </div>
            </div>
          </div>
        </div>
        <!-- FINAL -->

        <br>
        <!-- INICIO -->
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bordered Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: auto">#</th>
                    <th>Task</th>
                    <th>Progress</th>
                    <th style="width: auto">Label</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1.</td>
                    <td>Update software</td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-danger">55%</span></td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>Clean database</td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar bg-warning" style="width: 70%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-warning">70%</span></td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td>Cron job running</td>
                    <td>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar bg-primary" style="width: 30%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-primary">30%</span></td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td>Fix and squish bugs</td>
                    <td>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar bg-success" style="width: 90%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-success">90%</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
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
