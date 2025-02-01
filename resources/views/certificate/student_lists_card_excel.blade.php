
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
      <th style="font-weight: 700; font-family: Moul, serif !important;" colspan="8">
        <div class="col-12 text-center  title" style="font-family: 'Moul' !important;">
          គំរូ បញ្ចីឈ្មោះនិស្សឹតធ្វើកាត ក្រុម<span class="bold"> : {{ $header->code ?? ''  }} </span>វេន{{ $header->section->name_2 ?? '' }} ជំនាញ{{ $header->skill->name_2 ?? '' }} ឆ្នាំសិក្សា ២០២៤-២០២៥
        </div>
    </th>
    </tr>
  </table>
  <table>
    <thead>
      <tr class="general-print">
        <th style="font-weight: 700" width="5">ល.រ</th>
        <th style="font-weight: 700" width="15">អត្តលេខ</th>
        <th style="font-weight: 700" width="20">គោត្តនាម-នាម</th>
        <th style="font-weight: 700" width="20">ឈ្មោះជាឡាតាំង</th>
        <th style="font-weight: 700" width="20">ភេទ</th>
        <th style="font-weight: 700" width="20">ថ្ងៃខែឆ្នាំកំណើត</th>
        <th style="font-weight: 700" class="text-center" width="30">ផ្សេងៗ</th>
      </tr>
    </thead>
    <tbody>
      <?php $index = 1; ?>
      @foreach ($records as $record)
      <tr>
        <td class="text-center">{{ $index++ }}</td>
        <td class="text-center">{{ $record->code }}</td>
        <td class="">{{ $record->name_2 }}</td>
        <td class="">{{ $record->name }}</td>
        <td class="text-center">{{ $record->gender }}</td>
        <td class="text-center">{{ App\Service\service::DateYearKH($record->date_of_birth) ?? '' }}</td>
        <td class="text-center"></td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endif