
<div class="control-table table-responsive custom-data-table-wrapper2">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <div class="title-page">
          និស្សិតតាមក្រុមថ្នាក់
        </div>
        <div class="header-left">
        </div>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/department-menu') }}">ទំព័រដើម</a></li>
            <li class="breadcrumb-item active" aria-current="page">និស្សិតតាមក្រុមថ្នាក់</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <table class="table table-striped" id="table1">
    <thead>
      <tr>
        <th width="10"></th>
        <th class="">ថា្នក់/ក្រុម</th>
        <th width="190" class="">ចំនួននិស្សឹត</th>
        <th class="">វេនសិក្សា</th>
        <th class="">ជំនាញ</th>
        <th class="">កម្រិត</th>
        <th class="">ដេប៉ាតឺម៉ង់</th>
        <th class="">ឆ្នាំសិក្សា</th>
      </tr>
    </thead>
    <tbody>
      @include('general.divided_new_classes_record')
    </tbody>
  </table>
</div><br><br>