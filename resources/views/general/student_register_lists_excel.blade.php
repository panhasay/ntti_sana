
@if (count($records) > 0)
  <style>
    table{
      font-family: "Khmer OS Battambang" !important;
    }
  </style>
  <table>
    <tr>
      <th colspan="6"><img src="asset/NTTI/images/logo.png" alt="logo"></th>
      <th style="font-weight: 700; font-family: Moul, serif !important;" colspan="6">ព្រះរាជាណាចក្រកម្ពុជា <br> ជាតិ សាសនា ព្រះមហាក្សត</th>
    </tr>
    <tr>
      <th style="font-weight: 700; font-family: Moul, serif !important;" colspan="12"> </th>
    </tr>
    <tr>
      <th style="font-weight: 700; font-family: Moul, serif !important;" colspan="12">filter : {{ $department ?? '' }} {{'ជំនាញ'. $skills ?? '' }} {{ 'វេន'. $sections ?? '' }}</th>
    </tr>
  </table>
  <table>
    <thead>
      <tr class="general-data">
        <th style="font-weight: 700" width="10">អត្តលេខ</th>
        <th style="font-weight: 700" width="20">គោត្តនាម និងនាម</th>
        <th style="font-weight: 700" width="20">ឈ្មោះជាឡាតាំង</th>
        <th style="font-weight: 700" width="10">ភេទ</th>
        <th style="font-weight: 700" width="20">ថ្ងៃខែឆ្នាំកំណើត</th>
        <th style="font-weight: 700" width="50">ទីកន្លែងកំណើត</th>
        <th style="font-weight: 700" width="20">លេខទូរស័ព្ទ</th>
        <th style="font-weight: 700" width="20">អាណាព្យាបាល</th>
        <th style="font-weight: 700" width="20">លេខទូរស័ព្ទ អាណាព្យាបាល</th>
        <th style="font-weight: 700" width="20">ជំនាញ</th>
        <th style="font-weight: 700" width="20">កម្រិត</th>
        <th style="font-weight: 700" width="20">ក្រុម</th>
        <th style="font-weight: 700" width="20">វេនសិក្សា</th>
        <th style="font-weight: 700" width="20">ឈ្មោះម្ដាយ</th>
        <th style="font-weight: 700" width="20">ឈ្មោះឪពុក</th>
        <th style="font-weight: 700" width="20">ឆ្នាំសិក្សា</th>
        <th style="font-weight: 700" width="20">ប្រភពអាហារូបករណ៏</th>
        <th style="font-weight: 700" width="20">ស្គាល់NTTIតាមរយ:</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($records as $record)
      <tr>
          <td> {{ $record->code }}</td>
          <td>{{ $record->name_2 }}</td>
          <td>{{ ucwords(strtolower($record->name ?? '')) }}</td>
          <td>{{ $record->gender }}</td>
          <td>{{ $record->khmerDate }}</td>
          <td>{{ $record->student_address }}</td>
          <td>{{ $record->phone_student }}</td>
          <td>{{ $record->guardian_name }}</td>
          <td>{{ $record->guardian_phone }}</td>
          <td>{{ $record->skills }}</td>
          <td>{{ $record->qualification }}</td>
          <td>{{ $record->class_code }}</td>
          <td>{{ $record->section }}</td>
          <td>{{ $record->mother_name }}</td>
          <td>{{ $record->father_name }}</td>
          <td>{{ $record->session_year_code ?? '' }}</td>

          <td>{{ $record->scholarship_type ?? ''}}</td>
          <td>{{ $record->submit_your_application ?? '' }}</td>
          
      </tr>
      @endforeach
    </tbody>
  </table>
@endif