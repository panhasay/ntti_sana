<div class="page-title">
  <div class="row">
    <div class="col-12 col-md-6 order-md-1 order-last">
      <div class="title-page">
        កំណត់ ក្រុម / ថ្នាក់ {{ $type ?? '' }}ឆ្នាំទី {{ $years ?? '' }}
      </div>
      <div class="header-left">
        <button class="btn btn-success btn-icon-text btn-sm mb-2 mb-md-0 me-2 khmer_os_b" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="mdi mdi-signal"></i>លទ្ធិផលប្រឡង
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <a class="dropdown-item khmer_os_b" href="{{ url('exam-results?' . http_build_query(['years' => $_GET['years'], 'type' => $_GET['type'], 'semester' => 1])) }}">លទ្ធិផលប្រឡងឆមាសទី១</a>
          <a class="dropdown-item khmer_os_b" href="{{ url('exam-results?' . http_build_query(['years' => $_GET['years'], 'type' => $_GET['type'], 'semester' => 2])) }}">លទ្ធិផលប្រឡងឆមាសទី២</a>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 order-md-2 order-first">
      <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/department-menu') }}">ទំព័រដើម</a></li>
          <li class="breadcrumb-item active" aria-current="page">កំណត់ ក្រុម/ថ្នាក់</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="control-table table-responsive custom-data-table-wrapper2">
  <table class="table table-striped" id="table1">
    <thead>
      <tr>
        <th width="50"></th>
        <th class="" width="10">ឆ្នាំសិក្សា</th>
        <th class="">ថា្នក់/ក្រុម</th>
        <th class="">វេន</th>
        <th class="">ជំនាញ</th>
        <th class="">ដេប៉ាតឺម៉ង់</th>
        <th class="">លោកគ្រូ</th>
        <th class="">មុខវិជ្ជា</th>
        <th class="">ឆមាស</th>
        <th class="">ឆ្នាំ</th>
        <th class="">ការប្រឡង</th>
      </tr>
    </thead>
    <tbody>
      @include('general.assing_classes_records')
    </tbody>
  </table>
</div><br><br>