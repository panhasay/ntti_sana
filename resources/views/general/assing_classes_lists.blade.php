
<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
      <thead>
        <tr>
          <th width="50"></th>
          <th class="" width="10">ឆ្នាំសិក្សា</th>
          <th class="">ថា្នក់/ក្រុម</th>
          <th class="">វេន</th>
          <th class="">ជំនាញ</th>
          <th class="">ដេប៉ាតឺម៉ង់</th>
          <th class="">លោកគ្រូ</th>
          <th class="">មុខវិជ្ជា</th>
          <th class="">ឆមាស</th>
          <th class="">ការប្រឡង</th>
        </tr>
      </thead>
      <tbody>
        @include('general.assing_classes_records')
      </tbody>
    </table>
    {{$records->links("pagination::bootstrap-4")}}
  </div><br><br>