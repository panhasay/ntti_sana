
<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
      <thead>
        <tr>
          <th width="50"></th>
          <th class="text-center" width="10">លេខកូដ</th>
          <th class="text-center">ថា្នក់/ក្រុម</th>
          <th class="text-center">វេន</th>
          <th class="text-center">ជំនាញ</th>
          <th class="text-center">កម្រិត</th>
          <th class="text-center">ដេប៉ាតឺម៉ង់</th>
          <th class="text-center">ឆ្នាំសិក្សា</th>
          <th class="text-center">សកម្មភាព</th>
        </tr>
      </thead>
      <tbody>
        @include('general.classes_records')
      </tbody>
    </table>
    {{$records->links("pagination::bootstrap-4")}}
  </div><br><br>