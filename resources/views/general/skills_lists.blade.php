
<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
      <thead>
        <tr>
          <th width="50"></th>
          <th class="text-center" width="10">លេខកូដ</th>
          <th class="text-center">ជំនាញ</th>
          <th class="text-center">ជំនាញ ភាសាខ្មែរ</th>
          <th class="text-center">សកម្មភាព</th>
        </tr>
      </thead>
      <tbody>
        @include('general.skills_records')
      </tbody>
    </table>
    {{$records->links("pagination::bootstrap-4")}}
  </div><br><br>