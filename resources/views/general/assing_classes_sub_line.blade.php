<style>
  .table> :not(:last-child)> :last-child>*,
  .jsgrid .jsgrid-table> :not(:last-child)> :last-child>* {
    font-family: 'Khmer OS Battambang';
    border: 1px solid #b3b3b3;
    font-weight: bold;
  }
  .form-control-line {
    border: 1px solid #e4e9f0;
    font-family: "Open Sans", sans-serif;
    font-weight: 400;
    font-size: 0.8125rem;
    height: 31px;
    font-family: 'Khmer OS Battambang';
    text-align: center;
  }
  .table th,
  .table td {
    vertical-align: middle;
    font-size: 0.875rem;
    line-height: 1;
    white-space: nowrap;
    font-family: 'Khmer OS Battambang';
    padding: 1px;
  }
  .KhmerOSMuolLight {
    font-family: 'Khmer OS Muol Light';
  }
</style>
@if($type == 'is_print')
<style>
  @page {
    size: A4;
    margin: 07mm;
  }

  @media print {
    .page {
      margin: 0;
      border: initial;
      border-radius: initial;
      width: initial;
      min-height: initial;
      box-shadow: initial;
      background: initial;
      page-break-after: always;
    }
    .general-print>th {
      border: 1px solid #333;
      font-family: 'Khmer OS Battambang';
      padding: 8px;
    }.general-print>td{
      padding: 3px;
      border: 1px solid #333;
      font-family: 'Khmer OS Battambang';
    }
    .table-print {
      width: 100%
    }
  }
</style>
<div class="row align-items-start">
  <div class="col-5 text-center KhmerOSMuolLight"><br>
    វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស
    ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា
  </div>
  <div class="col-2">
  </div>
  <div class="col-5 text-center KhmerOSMuolLight">
    ព្រះរាជាណាចក្រកម្ពុជា
    ជាតិ សាសនា ព្រះមហាក្សត្រ
  </div>
</div><br>
<div class="row align-items-start">
  <div class="col-12 text-center KhmerOSMuolLight">
    តារាងពិន្ទុ ក្រុម {{ $header->class_code }}
  </div>
</div>
<div class="row align-items-start">
  <div class="col-12 text-center KhmerOSMuolLight">
    មុខវិជ្ជាៈ...........{{ $subject }}.........ឆមាសទី {{ $header->semester }} ឆ្នាំទី {{ $header->years }} ឆ្នាំសិក្សា {{ $header->session_year_code }}
  </div>
</div><br>
  <table class="table-print">
    <thead>
      <tr class="general-print">
        <th class="text-center" width="10">ល.រ</th>
        <th class="text-center" width="">អត្តលេខ</th>
        <th class="text-center" width="">គោត្តនាម និងនាម</th>
        <th class="text-center" width="">ឈ្មោះជាឡាតាំង</th>
        <th class="text-center" width="">ភេទ</th>
        <th class="text-center" width="">Att 15%</th>
        <th class="text-center" width="">Ass 15%</th>
        <th class="text-center" width="">Mid 15%</th>
        <th class="text-center" width="">Final 55%</th>
        <th class="text-center" width="">Total</th>
      </tr>
    </thead>
    <tbody id="recordsLineTableBody">
      <?php $total_score = 0;  $index = 1; ?>
      @foreach ($recordsLine as $line)
      <?php 
       
        $total_score = (float) $line->attendance + (float) $line->assessment + (float) $line->final + (float) $line->midterm;
      ?>
        <tr class="general-print">
          <td class="text-center">{{ $index++}}</td>
          <td class="text-center">{{ $line->student->code }}</td>
          <td class="">{{ $line->student->name_2 }}</td>
          <td class="" >{{ $line->student->name }}</td>
          <td class="text-center">{{ $line->student->gender }}</td>
          <td class="text-center">{{ $line->attendance > 0 ? $line->attendance : '0' }}</td>
          <td class="text-center">{{ $line->assessment > 0 ? $line->assessment : '0' }}</td>
          <td class="text-center">{{ $line->midterm > 0 ? $line->midterm : '0' }}</td>
          <td class="text-center">{{ $line->final > 0 ? $line->final : '0' }}</td>
          <td class="text-center">{{ $total_score }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
<!---Table for List ---->
<div class="control-table table-responsive custom-data-table-wrapper2">
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="50"></th>
        <th class="text-center" width="20">អត្តលេខ</th>
        <th class="text-center" width="30">គោត្តនាម និងនាម</th>
        <th class="text-center" width="30">ឈ្មោះជាឡាតាំង</th>
        <th class="text-center" width="">ភេទ</th>
        <th class="text-center" width="150">Att 15%</th>
        <th class="text-center" width="150">Ass 15%</th>
        <th class="text-center" width="150">Mid 15%</th>
        <th class="text-center" width="150">Final 55%</th>
        <th class="text-center" width="150">Total</th>
      </tr>
    </thead>
      <tbody id="recordsLineTableBody">
        <?php $total_score = 0; ?>
        @foreach ($recordsLine as $line)
        <?php 
          $total_score = (float) $line->attendance + (float) $line->assessment + (float) $line->final + (float) $line->midterm;
        ?>
        <tr id="rowLine{{$line->id ?? ''}}" data-id="{{ $line->id ?? ''}}">
          <form id="frmDataLine" role="form" class="form-sample" enctype="multipart/form-data">
            <td>
              <a class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2 DeletDataLine"
                data-id="{{ $line->id ?? '' }}" href="javascript:void(0)">
                <i class="mdi mdi-delete-forever"></i> Delete
              </a>
            </td>
            <td class="text-center">{{ $line->student->code ?? ''}}</td>
            <td>{{ $line->student->name_2 ?? ''}}</td>
            <td>{{ $line->student->name ?? ''}}</td>
            <td class="text-center">{{ $line->student->gender ?? ''}}</td>
            <td class="text-center">
              <input type="text" class="form-control-line form-control-sm form_data_line" readonly data-id="{{ $line->id }}"
                student-code="{{ $line->student_code }}" id="attendance" name="attendance" value="{{ $line->attendance }}"
                placeholder="0" aria-label="0">
            </td>
            <td class="text-center">
              <input type="text" class="form-control-line form-control-sm form_data_line" data-id="{{ $line->id }}"
                student-code="{{ $line->student_code }}" id="assessment" name="assessment" value="{{ $line->assessment }}"
                placeholder="0" aria-label="0">
            </td>
            <td class="text-center">
              <input type="text" class="form-control-line form-control-sm form_data_line" data-id="{{ $line->id }}"
                student-code="{{ $line->student_code }}" id="midterm" name="midterm" value="{{ $line->midterm }}"
                placeholder="0" aria-label="0">
            </td>
            <td class="text-center">
              <input type="text" class="form-control-line form-control-sm form_data_line" data-id="{{ $line->id }}"
                student-code="{{ $line->student_code }}" id="final" name="final" value="{{ $line->final }}"
                placeholder="0" aria-label="0">
            </td>
            <td class="text-center total_score" id="total_score">{{ $total_score ?? '' }}</td>
          </form>
        </tr>
        @endforeach
      </tbody>
  </table>
</div><br><br><br>
@endif