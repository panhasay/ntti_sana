@extends('app_layout.app_layout')
<link rel="stylesheet" href="asset/NTTI/css_dashboard.css">
@section('content')
<section id="tabs" class="project-tab">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="Student-tab" data-toggle="tab" href="#Student"
                            role="tab" aria-controls="Student" aria-selected="true">ពត៏មាន និស្សិត
                        </a>
                        <a class="nav-item nav-link" id="info-teacher-tab" data-toggle="tab" href="#info-teacher"
                            role="tab" aria-controls="info-teacher" aria-selected="false">ពត៏មាន គ្រូ
                        </a>
                        <a class="nav-item nav-link" id="info-schools-tab" data-toggle="tab" href="#info-schools"
                            role="tab" aria-controls="info-schools" aria-selected="false">ពត៏មាន សាលា</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="Student" role="tabpanel" aria-labelledby="Student-tab">
                        <div class="row">
                            <div class="container">
                                <div class="row" style="--bs-gutter-x: -5px;">
                                <div class="col-md-3">
                                  <div class="card-counter primary">
                                    <i class="fa fa-code-fork"></i>            
                                        <span class="count-numbers">វេន សិក្សា</span>
                                        @foreach($sections as $sections)
                                            <span class="count-name">{{ $sections->section }}</span>
                                        @endforeach
                                  </div>
                                </div>
                            
                                <div class="col-md-3">
                                  <div class="card-counter danger">
                                    <i class="fa fa-ticket"></i>
                                    <span class="count-numbers">{{ $total_skill ?? '' }}</span>
                                    <span class="count-name">Skills</span>
                                  </div>
                                </div>
                            
                                <div class="col-md-3">
                                  <div class="card-counter success">
                                    <i class="fa fa-home"></i>
                                    <span class="count-numbers">{{ $total_class ?? '' }}</span>
                                    <span class="count-name">Claas</span>
                                  </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <a class="like-dashboard" href="{{url('/student')}}">
                                        <div class="card-counter info">
                                            <i class="fa fa-users"></i>
                                            <span class="count-numbers">{{ $total_students ?? ''}}</span>
                                            <span class="count-name">Student</span>
                                        </div>
                                    </a>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div id="records_student_by_skills" style="width: 500px; height: 400px; "></div>
                            </div>
                            <div class="col-md-4">
                                <div id="student_by_year" style="width: 500px; height: 400px; "></div>
                            </div>
                            <div class="col-md-4">
                                <div id="student_by_class" style="width: 500px; height: 400px; "></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="table-responsive custom-data-table-wrapper2">
                                    <table class="table table-bordered custom-data-table">
                                        <thead class="text-nowrap">
                                            <tr>
                                                <td class="bold" scope="col">
                                                    <button type="button" id="prints" class="btn btn-outline-info btn-sm" data-type="skill"><i class="mdi mdi-printer btn-icon-append"></i>
                                                    </button>
                                                </td>
                                                <td  widht='5px' class="bold" scope="col">ជំនាញ</td>
                                                <td class="bold text-right" scope="col">និស្សិតស្រី</td>
                                                <td class="bold text-right" scope="col">និស្សិតប្រុស</td>
                                                <td class="bold text-right" scope="col">និស្សិតសរុប</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $index=1; ?>
                                            @foreach($records_student_by_skills as $record)
                                                <tr>
                                                    <th class="text-center">{{ $index++ }}  &nbsp;&nbsp;&nbsp;</th>
                                                    <td>{{ $record->category}}</td>
                                                    <td class="text-right">{{ $record->qty_studen_female}}</td>
                                                    <td class="text-right">{{ $record->qty_studen_male}}</td>
                                                    <td class="text-right">{{ $record->qty_studen}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="table-responsive custom-data-table-wrapper2">
                                    <table class="table table-bordered custom-data-table">
                                        <thead class="text-nowrap">
                                            <tr>
                                                <td class="bold" scope="col">
                                                    <button type="button" id="prints" class="btn btn-outline-info btn-sm" data-type="year"><i class="mdi mdi-printer btn-icon-append"></i>
                                                    </button>
                                                </td>
                                                <td  widht='5px' class="bold" scope="col">ឆ្នាំសិក្សា</td>
                                                <td class="bold text-right" scope="col">និស្សិតស្រី</td>
                                                <td class="bold text-right" scope="col">និស្សិតប្រុស</td>
                                                <td class="bold text-right" scope="col">និស្សិតសរុប</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $index=1; ?>
                                            @foreach($records_student_by_year as $record)
                                                <tr>
                                                    <th class="text-center">{{ $index++ }}  &nbsp;&nbsp;&nbsp;</th>
                                                    <td>{{ $record->session}}</td>
                                                    <td class="text-right">{{ $record->qty_studen_female}}</td>
                                                    <td class="text-right">{{ $record->qty_studen_male}}</td>
                                                    <td class="text-right">{{ $record->qty_studen}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="table-responsive custom-data-table-wrapper2">
                                    <table class="table table-bordered custom-data-table">
                                      <thead class="text-nowrap">
                                        <tr>
                                            <td class="bold" scope="col">
                                                <button type="button" id="prints" class="btn btn-outline-info btn-sm" data-type="department"><i class="mdi mdi-printer btn-icon-append"></i>
                                                </button>
                                            </td>
                                            <td  widht='5px' class="bold" scope="col">ដេប៉ាតឺម៉ង់</td>
                                            <td class="bold text-right" scope="col">និស្សិតស្រី</td>
                                            <td class="bold text-right" scope="col">និស្សិតប្រុស</td>
                                            <td class="bold text-right" scope="col">និស្សិតសរុប</td>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php $index=1; ?>
                                        @foreach($records_student_by_department as $record)
                                            <tr>
                                                <th class="text-center">{{ $index++ }}  &nbsp;&nbsp;&nbsp;</th>
                                                <td>{{ $record->department_name}}</td>
                                                <td class="text-right">{{ $record->qty_studen_female}}</td>
                                                <td class="text-right">{{ $record->qty_studen_male}}</td>
                                                <td class="text-right">{{ $record->qty_studen}}</td>
                                            </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="info-teacher" role="tabpanel" aria-labelledby="info-teacher-tab">
                        <!---info-teacher ---->
                       <h2 class="text-center mt-5">Dashbord Teacher proseccsing !</h2> 
                        <!--End info-teacher-->
                    </div>
                    <div class="tab-pane fade" id="info-schools" role="tabpanel" aria-labelledby="info-schools-tab">
                        <h2 class="text-center mt-5">Dashbord schools proseccsing </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="print" style="display: none">
        <div class="print-content">
        </div>
    </div>
    @include('system.modal_comfrim_delet')
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChartStudentBySkill);
    function drawChartStudentBySkill() {
        var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        @php
            foreach($records_student_by_skills as $record) 
            {
                echo "['ជំនាញ".$record->category."".'សិស្សសរុប'.$record->qty_studen."នាក់ ស្រី".''.$record->qty_studen_female."ប្រុស".$record->qty_studen_male." ', ".$record->qty_studen.",],";
            }
        @endphp
        ]);
        var options = {
        title: 'ចំនួននិស្សិតសរុប តាមជំនាញ',
        pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('records_student_by_skills'));
        chart.draw(data, options);
    }
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawCharts);
    function drawCharts() {
        var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        @php
            foreach($records_student_by_year as $record) 
            {
                echo "['".$record->session."".'សិស្សសរុប'.$record->qty_studen."នាក់ ស្រី".''.$record->qty_studen_female."ប្រុស".$record->qty_studen_male." ', ".$record->qty_studen.",],";
            }
        @endphp
        ]);
        var options = {
        title: 'ចំនួននិស្សិតសរុប តាមឆ្នាំសិស្សា',
        pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('student_by_year'));
        chart.draw(data, options);
    }
    google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
           @php
                foreach($records_student_by_department as $record) 
                {
                    echo "['".$record->department_name."".'សិស្សសរុប '.$record->qty_studen." ', ".$record->qty_studen.",],";
                }
            @endphp
        ]);
        var options = {
          title: 'ចំនួននិស្សិតសរុប ដេប៉ាតឺម៉ង់',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('student_by_class'));
        chart.draw(data, options);
    }
    $(document).ready(function() {
        $(document).on('click', '#prints', function() {
            $(".modal-confirmation-text").html('Do you want to Print?');
            $("#btnYes").attr('data-code', $(this).attr('data-type'));
            $("#divConfirmation").modal('show');
        });
    });
    $(document).on('click', '#btnYes', function() {
        var type = $(this).attr('data-code');
        var url = '/dahhboard-student-print?type='+type;
        $.ajax({
            type: 'get',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(response) {
                $('.print-content').printThis({});
                $('.loader').hide();
                $("#divConfirmation").modal('hide');
                $('.print-content').html(response);
            },
            error: function(response) {
                notyf.error('External Server Error');
            }
        });
    });
    </script>
@endsection

