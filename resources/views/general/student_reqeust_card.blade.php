@extends('app_layout.app_layout')
@section('content')
<style>
  .dataTable-dropdown label {
      white-space: nowrap;
      margin-left: 15px;
      display: none !important;
  }
  
.table td {
    vertical-align: middle;
    font-size: .875rem;
    line-height: 1;
    white-space: nowrap;
    font-family: Khmer OS Battambang;
    padding: 2px !important;
}
</style>
<div class="page-title">
  <div class="row">
    <div class="col-12 col-md-6 order-md-1 order-last">
      <div class="title-page">
        ព័ត៌មាននិស្សិតធ្វើកាត 
      </div>
      <div class="header-left">
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 order-md-2 order-first">
      <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:history.back()">ត្រឡប់ក្រោយ</a></li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="control-table table-responsive custom-data-table-wrapper2">
  <table class="table table-striped" id="table1">
    <thead>
      <tr>
        <th width="10"></th>
        <th width="10">អត្តលេខ</th>
        <th>គោត្តនាម និងនាម</th>
        <th>ឈ្មោះជាឡាតាំង</th>
        <th>ភេទ</th>
        <th>ក្រុម/ថ្នាក់</th>
        <th>ថ្ងៃខែឆ្នាំកំណើត</th>
        <th>លេខទូរស័ព្ទ</th>
      </tr>
    </thead>
    <tbody>
      @foreach($records as $record)
        @php $img = $studentImg->where('code', $record->student_code)->first(); @endphp
        <tr>
          <td width="30">
            <a href="{{ url('/card-student-list/'. $record->student_code ) }}">
              <img src="{{ $img && $img->picture_ori  ? asset('uploads/student/' . $img->picture_ori) : asset('asset/NTTI/images/faces/default_User.jpg') }}"  alt="" width="120">
            </a>
          </td>
          <td>
            <a href="{{ route('card.student.list', $record->student_code) . '?admin-card=admin' }}">
                {{ $record->student_code }}
            </a>
          </td>
          <td>{{ $record->student->name_2 ?? '' }}</td>
          <td>{{ $record->student->name ?? '' }}</td>
          <td>{{ $record->student->gender ?? '' }}</td>
          <td>{{ $record->student->class_code ?? '' }}</td>
          <td>{{ App\Service\service::DateYearKH($record->student->date_of_birth) }}</td>
          <td>{{ $record->student->phone_student ?? ""}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div><br><br>
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    $(document).on('click', '#btnDelete', function() {
      $("#btnYes").attr('data-code', $(this).attr('data-code'));
      $("#divConfirmation").modal('show');
    });
  });
</script>
@endsection