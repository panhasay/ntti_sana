
@if (count($records) > 0)
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
      <tr>
        <th class="text-center" width="10">ល.រ</th>
        <th class="text-center" width="10">អត្តលេខ</th>
        <th class="text-center" width="20">គោត្តនាម និងនាម</th>
        <th class="text-center" width="20">ឈ្មោះជាឡាតាំង</th>
        <th class="text-center" >ភេទ</th>
        <th class="text-center" >Att 15%</th>
        <th class="text-center" >Ass 15%</th>
        <th class="text-center" >Mid 15%</th>
        <th class="text-center" >Final 55%</th>
        <th class="text-center" >Total</th>
      </tr>
    </thead>
    <tbody>
      <?php $index= 1; ?>
      @foreach ($records as $line)
      <tr>
        <td>{{ $index++ }}</td>
        <td class="text-center">{{ $line->student->code ?? ''}}</td>
        <td>{{ $line->student->name_2 ?? ''}}</td>
        <td>{{ $line->student->name ?? ''}}</td>
        <td class="text-center">{{ $line->student->gender ?? ''}}</td>
        <td class="text-center">{{ $line->attendance }}</td>
        <td class="text-center">{{ $line->assessment }}</td>
        <td class="text-center">{{ $line->midterm }}</td>
        <td class="text-center">{{ $line->final }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endif