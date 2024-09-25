@if(Auth::user()->role == "student")
    <style>
        .horizontal-menu .bottom-navbar .page-navigation > .nav-item:not(.mega-menu) {
            position: relative;
            display: none;
        }
        .horizontal-menu .bottom-navbar .page-navigation > .nav-item > .nav-link .menu-icon {
            margin-right: 10px;
            font-size: 14px;
            color: #ffffff;
            font-weight: 400;
            display: none;
        }
        .horizontal-menu .bottom-navbar .page-navigation > .nav-item > .nav-link .menu-title {
            font-size: 0.875rem;
            font-weight: 400;
            display: none;
        }
        .horizontal-menu .top-navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-search .input-group {
            display: none;
        }
        .bg-header{
            background: #2194ce;
        }
        .info-student p{
            line-height: 6px;
        }
        .card-titles{
            position: relative;
            top: 30;
            left: 20;
            z-index: 1000;
            font-weight: 700;
        }
    </style>
  @endif
  @extends('app_layout.app_layout')
  <style>
    .card .card-body {
        padding: 9px 28px;
    }
  </style>
  @section('content')
  <div class="page-head page-head-custom">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-header ">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="{{ url('/dahhboard-student-account') }}"><i class="mdi mdi-compass-outline menu-icon"></i> Dahhboard</a>
                        </li>
                        {{-- <li class="nav-item">
                        <a class="nav-link text-white" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>
        
        <!----End nav--->

        <div class="col-sm-12 stretch-card grid-margin">
            <div class="card">
              <div class="row">
                <div class="col-md-4">
                  <div class="card border-0">
                    <div class="card-titles">អវត្តមាន</div>
                    <div id="piechart" style="width: 550px; height: 350px;"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card border-0">
                    <div class="card-body">
                      <div class="card-title">News Sessions</div>
                      <div class="d-flex flex-wrap">
                        <div class="doughnut-wrapper w-50"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                          <canvas id="doughnutChart2" width="260" height="260" style="display: block; height: 208px; width: 208px;" class="chartjs-render-monitor"></canvas>
                        </div>
                        <div id="doughnut-chart-legend2" class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left"><ul><li><span class="legend-dots" style="background:#5e6eed"></span>Page views</li><li><span class="legend-dots" style="background:#00d284"></span>New users</li><li><span class="legend-dots" style="background:#ff0d59"></span>Bounce rate</li></ul></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 grid-margin mt-3">
                    <div class="card stretch-card mb-3">
                      <div class="card-body d-flex flex-wrap justify-content-between ">
                        <div class="info-student">
                          <h3 class="font-weight-semibold mb-1 text-black"> ឈ្មោះ : {{ $records->name_2 ?? '' }} </h3>
                          <p class="text-muted">Name : {{ $records->name ?? '' }}</p>
                          <p class="text-muted">ក្រុម / Class : {{ $classes->class ?? '' }}</p>
                          <p class="text-muted">ជំនាញ / Skills : {{ $skills->name ?? '' }} ({{ $skills->name_2 ?? '' }})</p>
                          <p class="text-muted">ឆ្នាំទី​​ : 4</p>
                        </div>
                       {{-- <h3 class="text-success font-weight-bold">+168.900</h3> --}}
                      </div>
                    </div>
                    <div class="card stretch-card mb-3">
                      <div class="card-body d-flex flex-wrap justify-content-between">
                        <div>
                          <h4 class="font-weight-semibold mb-1 text-black"> Total Profit </h4>
                          <h6 class="text-muted">Weekly Customer Orders</h6>
                        </div>
                        <h3 class="text-success font-weight-bold">+6890.00</h3>
                      </div>
                    </div>
                    <div class="card mt-3">
                      <div class="card-body d-flex flex-wrap justify-content-between">
                        <div>
                          <h4 class="font-weight-semibold mb-1 text-black"> Issue Reports </h4>
                          <h6 class="text-muted">System bugs and issues</h6>
                        </div>
                        <h3 class="text-danger font-weight-bold">-8380.00</h3>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>


    <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
  </div>
  <div class="page-header flex-wrap">
  </div>
  @include('system.modal_comfrim_delet')
  {{-- @include('student.student_list') --}}
  @include('system.model_upload_excel')
  @endsection
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Work',     11],
        ['Eat',      2],
        ['Commute',  2],
        ['Watch TV', 2],
        ['Sleep',    7]
      ]);

      var options = {
        title: ''
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script>
  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $(document).on('click', '#btnDelete', function() {
        $(".modal-confirmation-text").html('Do you want to delete?');
        $("#btnYes").attr('data-code', $(this).attr('data-code'));
        $("#divConfirmation").modal('show');
      });
      $(document).on('click', '#btnYes', function() {
        var code = $(this).attr('data-code');
        $.ajax({
          type: "POST",
          url: `/student/delete`,
          data: {
            code: code
          },
          success: function(response) {
            if (response.status == 'success') {
              $("#divConfirmation").modal('hide');
              $("#row" + code).remove();
              notyf.success(response.msg);
            }
          }
        });
      });
    });
    function prints(ctrl) {
      var url = '/student/print';
      var data = '';
      data = $("#advance_search").serialize();
      $.ajax({
        type: 'get',
        url: url,
        data: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
          $('.loader').show();
        },
        success: function(response) {
          $('.loader').hide();
          $('.print-content').html(response);
          $('.print-content').printThis({});
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    }
    function DownlaodExcel() {
      var url = '/student/downlaodexcel/';
      if ($('#search_data').val() == '') {
        data = $("#advance_search").serialize();
      } else {
        data = 'value=' + $('#search_data').val();
      }
      data = $("#advance_search").serialize();
      $.ajax({
        type: "post",
        url: url,
        data: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {},
        success: function(response) {
          notyf.error(response.msg);
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    }
    function importExcel(){
      $("#divUplocadExcel").modal('show');
    }
  </script>