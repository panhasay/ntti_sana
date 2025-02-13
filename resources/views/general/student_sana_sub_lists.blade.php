<style>
  .general-group > th{
    padding: 10px !important;
  }
</style>
<div class="control-table table-responsive custom-data-table-wrapper2 mt-3">
  <table class="table">
      <thead>
        <tr class="general-data">
          <th width="50" class="text-center">លេខក្រុម</th>
          <th width="10">អត្តលេខ</th>
          <th width="50">គោត្តនាម និងនាម</th>
          <th width="50">ឈ្មោះជាឡាតាំង</th>
          <th>ភេទ</th>
          <th>ថ្ងៃខែឆ្នាំកំណើត</th>
          <th width="20">លេខទូរស័ព្ទ</th>
          {{-- <th>សាស្រ្ដចារ្យដឹកនាំ</th>
          <th>សាស្រ្ដចារ្យពិគ្រោះ</th>
          <th width="200">ប្រធានទបទសាណា</th> --}}
        </tr>
      </thead>
      <tbody class="data-list-studnet">
        @include('general.student_sana_sub_lists_records')
      </tbody>
    </table>
</div>

<br><br><br><br>