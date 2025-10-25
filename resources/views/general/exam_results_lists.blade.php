<div class="control-table table-responsive custom-data-table-wrapper2">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <div class="title-page">
          លទ្ធិផលប្រឡងឆមាស
        </div>
        <div class="header-left">
        </div>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/department-menu') }}">ទំព័រដើម</a></li>
            <li class="breadcrumb-item active" aria-current="page">លទ្ធិផលប្រឡងឆមាស</li>
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
          <th class="text-center">ថា្នក់/ក្រុម</th>
          <th class="text-center">វេន</th>
          <th class="text-center">ជំនាញ</th>
          <th class="text-center">ដេប៉ាតឺម៉ង់</th>
          <th class="text-center">ឆមាស</th>
          <th class="text-center">គ្រូបន្ទុកថ្នាក់</th>
          <th class="text-center">ឆ្នាំសិក្សា</th>
        </tr>
      </thead>
      <tbody>
        @include('general.exam_results_records')
      </tbody>
    </table>
  </div><br><br>