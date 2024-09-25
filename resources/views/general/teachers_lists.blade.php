
<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
      <thead>
        <tr>
          <th width="50"></th>
          <th class="text-center" width="10">លេខកូដ</th>
          <th class="">គោត្តនាម និងនាម</th>
          <th class="">ឈ្មោះជាឡាតាំង</th>
          <th class="">ភេទ</th>
          <th class="">លេខទូរសព្ទ</th>
          <th class="text-center">អត្តសញ្ញាប័ណ</th>
          <th class="">ថ្ងៃខែឆ្នំកំណើត</th>
          <th class="">អាស័យដ្ឋាន</th>
          <th class="">អ៊ីមែល</th>
          <th class="">ដេប៉ាតដេម៉ង់</th>
          <th class="">ឆ្នាំចូលធ្វើការ</th>
          <th class="">ឈ្មោះម្តាយ</th>
          <th class="">ឈ្មោះឪពុក</th>
          <th class="">ស្ថានភាពអាពាហ៍ពិពាហ៍</th>
          <th class="">បទពិសោធន៍​ការងារ</th>
          <th class="">កម្រិតបរិញ្ញាបត្រ</th>
          <th class="text-center">សកម្មភាព</th>
        </tr>
      </thead>
      <tbody>
        @include('general.teachers_records')
      </tbody>
    </table>
    {{$records->links("pagination::bootstrap-4")}}
  </div><br><br>