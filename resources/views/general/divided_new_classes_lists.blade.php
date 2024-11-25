
<div class="control-table table-responsive custom-data-table-wrapper2">
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="50"></th>
        <th class="" width="10">ល.រ</th>
        <th class="">ថា្នក់/ក្រុម</th>
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
  {{$records->links("pagination::bootstrap-4")}}
</div><br><br>