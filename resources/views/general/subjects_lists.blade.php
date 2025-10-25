<div class="page-title">
  <div class="row">
    <div class="col-12 col-md-6 order-md-1 order-last">
      <div class="title-page">
           មុខវិជ្ជា 
      </div>
      <div class="header-left">
      <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate" href="{{url('subjects/transaction/?type=cr')}}"><i class="mdi mdi-account-plus"></i> បន្ថែមថ្មី</i></a>

        {{-- <button class="btn btn-success btn-icon-text btn-sm mb-2 mb-md-0 me-2 khmer_os_b" type="button"
          id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="mdi mdi-signal"></i>លទ្ធិផលប្រឡង
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <a class="dropdown-item khmer_os_b"
            href="{{ url('exam-results?' . http_build_query(['years' => $_GET['years'], 'type' => $_GET['type'], 'semester' => 1])) }}">លទ្ធិផលប្រឡងឆមាសទី១</a>
          <a class="dropdown-item khmer_os_b"
            href="{{ url('exam-results?' . http_build_query(['years' => $_GET['years'], 'type' => $_GET['type'], 'semester' => 2])) }}">លទ្ធិផលប្រឡងឆមាសទី២</a>
        </div> --}}
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
        <th class="text-center" width="10">លេខកូដ</th>
        <th class="">មុខវិជ្ជា</th>
        <th class="">មុខវិជ្ជា ភាសាខ្មែរ</th>
        <th class="text-center">ជំនាញ</th>
        <th class="text-center">ប្រភេទម៉ោង</th>
        <th class="text-center">ដេប៉ាតដេម៉ង់</th>
        <th class="text-center">ឆ្នាំ</th>
        <th class="text-center">សកម្មភាព</th>
      </tr>
    </thead>
    <tbody>
      @include('general.subjects_records')
    </tbody>
  </table>
</div><br>