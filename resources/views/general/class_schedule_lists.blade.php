<div class="control-table table-responsive custom-data-table-wrapper2">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <div class="title-page">
          តារាងបែងចែកម៉ោងបង្រៀន
        </div>
        <div class="header-left">
          <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate"
            href="{{url('class-schedule/transaction/?type=cr')}}"><i class="mdi mdi-account-plus"></i>
            បន្ថែមថ្មី</i></a>
        </div>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/department-menu') }}">ទំព័រដើម</a></li>
            <li class="breadcrumb-item active" aria-current="page">ម៉ោងបង្រៀន</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <table class="table table-striped" id="table1">
    <thead>
      <tr>
        <th width="50"></th>
        <th class="text-center" width="10">ល.រ</th>
        <th class="text-center">ថា្នក់/ក្រុម</th>
        <th class="text-center">វេនសិក្សា</th>
        <th class="text-center">ជំនាញ</th>
        <th class="text-center">កម្រិត</th>
        <th class="text-center">ដេប៉ាតឺម៉ង់</th>
        <th class="text-center">ចាប់ផ្តើមអនុវត្ត</th>
        <th class="text-center">ឆ្នាំសិក្សា</th>
        <th class="text-center">ឆមាស</th>
        <th class="text-center">បរិញាប័ត្រ ឆ្នាំ</th>
      </tr>
    </thead>
    <tbody>
      @include('general.class_schedule_record')
    </tbody>
  </table>
</div><br><br>