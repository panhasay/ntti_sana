
<div class="control-table table-responsive custom-data-table-wrapper2">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <div class="title-page">
          ការគ្រប់គ្រង ប្ដូរក្រុម / ប្ដូរវេនសិក្សា ព្យួរកាសិក្សា និងឈប់
        </div>
        <div class="header-left">
        </div>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/department-menu') }}">ទំព័រដើម</a></li>
            <li class="breadcrumb-item active" aria-current="page">ប្ដូរវេនសិក្សា ព្យួរកាសិក្សា</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
    <table class="table table-striped" id="table1">
      <thead>
        <tr class="general-data">
          <th width="50"></th>
          <th width="10">អត្តលេខ</th>
          <th>គោត្តនាម និងនាម</th>
          <th>ឈ្មោះជាឡាតាំង</th>
          <th>ភេទ</th>
          <th width="20">លេខទូរស័ព្ទ</th>
          <th>ក្រុម/ថ្នាក់</th>
          <th>ជំនាញ</th>
          <th>កម្រិត</th>
          <th>វេនសិក្សា</th>
          <th>ឆមាស</th>
          <th>ឆ្នាំ</th>
          <th>ឆ្នាំសិក្សា</th>
        </tr>
      </thead>
      <tbody>
          @include('general.transfer_records')
      </tbody>
    </table>
</div><br><br>