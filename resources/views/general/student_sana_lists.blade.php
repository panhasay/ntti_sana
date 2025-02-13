
<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
      <thead>
        <tr>
          <th width="50"></th>
          <th class="text-center" width="10">លេខកូដ</th>
          <th class="">ថា្នក់/ ក្រុម</th>
          <th class="">ជំនាន់</th>
          <th class="">ចាប់ផ្ដើមអនុវត្ត</th>
          <th class="">បញ្ចប់នៅថ្ងៃ</th>
          <th class="">ដេប៉ាតាម៉ង់</th>
          <th class="">ជំនាញ</th>
          <th class="">វេន</th>
        </tr>
      </thead>
      <tbody>
        @include('general.student_sana_records')
      </tbody>
    </table>
    {{$records->links("pagination::bootstrap-4")}}
  </div><br><br>