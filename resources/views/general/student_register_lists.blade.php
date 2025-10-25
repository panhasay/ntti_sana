<div class="control-table table-responsive custom-data-table-wrapper2">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <div class="title-page">
          ចុះឈ្មោះចូលរៀន
        </div>
        <div class="header-left">
          <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate"
            href="{{url('/student/registration/transaction?type=cr')}}"><i class="mdi mdi-account-plus"></i>
            បន្ថែមថ្មី</i>
          </a>
          <button type="button" id="BtnDownlaodExcel"
            class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
              class="mdi mdi-printer btn-icon-append"></i>
          </button>
        </div>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/department-menu') }}">ទំព័រដើម</a></li>
            <li class="breadcrumb-item active" aria-current="page">ចុះឈ្មោះចូលរៀន</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <table class="table table-striped" id="table1">
    <thead>
      <tr class="thead">
        <th width="50"></th>
        <th width="10">អត្តលេខ</th>
        <th>គោត្តនាម និងនាម</th>
        <th>ឈ្មោះជាឡាតាំង</th>
        <th>ភេទ</th>
        <th>ថ្ងៃខែឆ្នាំកំណើត</th>
        <th>ទីកន្លែងកំណើត</th>
        <th width="20">លេខទូរស័ព្ទ</th>
        <th>ក្រុម/ថ្នាក់</th>
        <th>ជំនាញ</th>
        <th>កម្រិត</th>
        <th>វេនសិក្សា</th>
        <th>ឈ្មោះម្ដាយ</th>
        <th>ឈ្មោះឪពុក</th>
        <th>ឆ្នាំសិក្សា</th>
      </tr>
    </thead>
    <tbody>
      @include('general.student_register_records')
    </tbody>
  </table>
</div><br><br>