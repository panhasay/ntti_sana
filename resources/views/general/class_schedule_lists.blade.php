
<div class="control-table table-responsive custom-data-table-wrapper2">
  <table class="table table-striped">
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
        <th class="text-center">បរិញាប័ត្រ ឆ្នាំ</th>
      </tr>
    </thead>
    <tbody>
      @include('general.class_schedule_record')
    </tbody>
  </table>
  {{$records->links("pagination::bootstrap-4")}}
</div><br><br>