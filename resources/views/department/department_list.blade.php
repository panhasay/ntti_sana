
<div class="control-table">
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="50"></th>
        <th width="10">ល.រ</th>
        <th width="10">លេខកូដ</th>
        <th>ដេប៉ាតឺម៉ង់ ភាសាអង់គ្លេស</th>
        <th>ដេប៉ាតឺម៉ង់</th>
        <th class="text-center">សកម្មភាព</th>
      </tr>
    </thead>
    <tbody>
      @include('department.department_records')
    </tbody>
  </table>
  {{$records->links("pagination::bootstrap-4")}}
</div><br><br>