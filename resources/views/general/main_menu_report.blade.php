@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <i class="mdi mdi-format-list-bulleted"></i>
              រាយការណ៍
        </div>
      </div>
    </div>
  </div>
</div>
<div class="menu-list p-3">
  <ul style="line-height: 2px !important;">
      <li><a href="{{ url('/report-first-year-student-registration') }}">ស្ថិតិសិស្សដាក់ពាក្យចុះឈ្មោះចូលរៀនឆ្នាំទី១</a></li><br>
      <li><a href="{{ url('/report_list_of_student_class_and_section') }}">របាយការណ៍និស្សិត ក្រុម និងវេនសិក្សា</a></li><br>
      <li><a href="{{ url('/report_list_table_student_of_years') }}">តារាងបញ្ជីក្រុមនិស្សិតបច្ចេកទេស​ និង បច្ចេកវិទ្យាតាមឆ្នាំសិក្សា</a></li>
      <li><a href="{{ url('/report_attendance_student') }}">បញ្ជីសរុបអវត្តមាននិសិត្សប្រចាំខែ និងប្រចាំឆមាស</a></li>
  </ul>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
