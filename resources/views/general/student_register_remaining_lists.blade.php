
<div class="control-table table-responsive custom-data-table-wrapper2">
  <table class="table table-striped">
      <thead>
        <tr class="general-data">
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
          @include('general.student_register_remaining_records')
        </tbody>
    </table>
    {{$records->links("pagination::bootstrap-4")}} 
</div><br><br>