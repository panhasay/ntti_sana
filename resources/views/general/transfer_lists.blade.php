
<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
      <thead>
        <tr>
          <th width="50"></th>
          <th class="text-center" width="10">លេខកូដ</th>
          <th class="">ថ្នាក់/ក្រុម</th>
          <th class="">ប្ដូរទៅ ថ្នាក់/ក្រុម</th>
          <th class="">ជំនាញ</th>
          <th class="">ដេប៉ាតាម៉ង់</th>
          <th class="text-center">សកម្មភាព</th>
        </tr>
      </thead>
      <tbody>
        @include('general.transfer_records')
      </tbody>
    </table>
    {{$records->links("pagination::bootstrap-4")}}
  </div><br><br>
