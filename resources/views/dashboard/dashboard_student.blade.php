
    <style>
      *{
        font-family: "Khmer OS Battambang" !important;
      }
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
        .card-titles{
            position: relative;
            top: 30;
            left: 20;
            z-index: 1000;
            font-weight: 700;
        }
        .card {
          border: 0;
          background: #ffff !important;
          border: 1px solid #e4e9f0;
          border-left: 2px solid #2194ce;
      }
    </style>

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
                    <div id="piechart" style="width: 440px; height: 350px;"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card border-0">
                   
                  </div>
                </div>
                <div class="col-xl-4 grid-margin mt-3">
                    <div class="card stretch-card mb-3">
                      <div class="card-body d-flex flex-wrap justify-content-between ">
                        <div class="info-student">
                          <div class="row">
                            <div class="col-10">
                              <h3 class="font-weight-semibold mb-1 text-black"> ឈ្មោះ : {{ $records->name_2 ?? '' }} </h3>
                            </div>
                            <div class="col-1">
                              <?php $picture =  App\Models\General\Picture::where('code', $records->code)->where('type','student')->value('picture_ori'); ?>
                              @if($picture != null)
                                <img style="float: right;border-radius: 10px;border: 1px solid #d2d2d2;position: absolute;right: 11px;" src="{{ $picture ?? '' }}" alt="" width="90" height="100">
                              @else
                                <img style="float: right;border-radius: 10px;border: 1px solid #d2d2d2;position: absolute;right: 11px;" src="asset/NTTI/images/faces/default_User.jpg" alt="" width="90" height="90">
                              @endif
                            </div>
                          </div>
                          <p class="text-muted">Name : {{ $records->name ?? '' }}</p>
                          <p class="text-muted">ក្រុម / Class : {{ $records->class_code ?? '' }} ថ្នាក់៖ បរិញ្ញាប័ត្រ</p>
                          <p class="text-muted">ជំនាញ / Skills : {{ $skills->name ?? '' }} ({{ $skills->name_2 ?? '' }})</p>
                          <p class="text-muted">Address / អាសយដ្ឋាន : {{ $records->student_address ?? '' }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="card stretch-card mb-3">
                      <div class="card-body d-flex flex-wrap justify-content-between">
                        <div>
                          <h4 class="font-weight-semibold mb-1 text-black">ពត័មានការសិក្សា ឆ្នាំទី ១</h4>
                          <h6 class="text-muted">ឆមាសទី 1 : ពីន្ទុសរុប​​៖​ 80, មធ្យមភាគ៖​ 80,5 លេខ៖ 3</h6>
                          <h6 class="text-muted">ឆមាសទី 2 : ពីន្ទុសរុប​​៖​ 60, មធ្យមភាគ៖​ 50,5 លេខ៖ 20</h6>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>


    <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> 
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