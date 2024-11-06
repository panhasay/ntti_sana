
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
          <th width="20">លេខទូរស័ព្ទ</th>
          <th>ជំនាញ</th>
          <th>កម្រិត</th>
        </tr>
      </thead>
        <tbody>
          @include('general.student_register_records')
        </tbody>
    </table>
    {{$records->links("pagination::bootstrap-4")}}
</div><br><br>