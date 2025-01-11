
<div class="control-table table-responsive custom-data-table-wrapper2">
  <table class="table table-striped">
      <thead>
        <tr class="general-data">
          <th width="20">អត្តលេខ</th>
          <th width="20">គោត្តនាម-នាម</th>
          <th width="20">ជាអក្សឡាតាំង</th>
          <th width="10">ភេទ</th>
          <th width="20">ថ្ងៃ​ ខែ ឆ្នាំកំណើត</th>
          <th width="50">ទីកន្លែងកំណើត</th>
          <th class="text-center" width="10">លទ្ធផងបាក់ឌុប</th>
          <th class="text-center" width="10">និទ្ទិសបាក់ឌុប</th>
          <th width="25">ថ្នាក់សិក្សា(សង្គម/វិទ្យាសាស្រ្ត)</th>
          <th width="15">លេខទូរស័ព្ទ</th>
          <th width="10">ក្រុម</th>
          <th width="10">វេន</th>
          <th width="10">ជំនាញ</th>
          <th width="20">%អាហារូបករណ៏</th>
          <th width="50">ប្រភពអាហារូបករណ៏</th>
          <th width="100">ស្គាល់NTTIតាមរយ:</th>
        </tr>
      </thead>
        <tbody>
          @include('general.student_scholarship_records')
        </tbody>
    </table>
    <span>
        សរុប : {{ $total_records[0]->total_count ?? '' }} នាក់
    </span>
    {{$records->links("pagination::bootstrap-4")}} 
</div><br><br>