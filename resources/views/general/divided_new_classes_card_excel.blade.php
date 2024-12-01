
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
      <th style="font-weight: 700; font-family: Moul, serif !important;" colspan="12">filter :{{ $header->code ?? '' }}, {{ $department ?? '' }} ,{{'ជំនាញ'.$sections  ?? '' }}, {{ 'វេន'. $skills ?? '' }}, {{ $header->level ?? '' }}</th>
    </tr>
  </table>
  <table>
    <thead>
      <tr class="general-data">
        <th style="font-weight: 700" width="20">គោត្តនាម-នាម</th>
        <th style="font-weight: 700" width="20">ជាអក្សឡាតាំង</th>
        <th style="font-weight: 700" width="10">ភេទ</th>
        <th style="font-weight: 700" width="20">ថ្ងៃ​ ខែ ឆ្នាំកំណើត</th>
        <th style="font-weight: 700" width="50">ទីកន្លែងកំណើត</th>
        <th style="font-weight: 700" width="10">លទ្ធផងបាក់ឌុប</th>
        <th style="font-weight: 700" width="25">ថ្នាក់សិក្សា(សង្គម/វិទ្យាសាស្រ្ត)</th>
        <th style="font-weight: 700" width="15">លេខទូរស័ព្ទ</th>
        {{-- <th style="font-weight: 700" width="10">ក្រុម</th> --}}
        <th style="font-weight: 700" width="10">ជំនាញ</th>
        <th style="font-weight: 700" width="20">%អាហារូបករណ៏</th>
        <th style="font-weight: 700" width="50">ប្រភពអាហារូបករណ៏</th>
        <th style="font-weight: 700" width="100">ស្គាល់NTTIតាមរយ:</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($records as $record)
      <tr>
          <td>{{ $record->name_2  }}</td>
          <td>{{ $record->name ?? '' }}</td>
          <td>{{ $record->gender ?? ''}}</td>
          <td>{{ App\Service\service::DateYearKH($record->date_of_birth) ?? '' }}</td>
          <td>{{ $record->student_address ?? ''}}</td>
          <td>
            @if($record->bakdop_results != '')
              {{ $record->bakdop_results ?? ''}}
            @else
              ផ្សេងៗ
            @endif
          </td>
          <td>{{ $record->bakdop_type ?? ''}}</td>
          <td>{{ $record->phone_student ?? ''}}</td>
          {{-- <td>{{ $record->class_code  ?? ''}}</td> --}}
          <td>{{ $record->skills ?? ''}}</td>
          <td>{{ $record->scholarship ?? '' }}</td>
          <td>{{ $record->scholarship_type ?? ''}}</td>
          <td>{{ $record->submit_your_application ?? '' }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endif