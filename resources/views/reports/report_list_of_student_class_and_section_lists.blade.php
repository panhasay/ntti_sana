<style>
    .report-table {
        width: 100%;
        border-collapse: collapse;
        margin: 17px 0;
        font-size: 14px;
    }
    .report-table th, .report-table td {
        border: 1px solid #ccc;
    }
    .report-table th {
        background-color: #f2f2f2;
    }
    .report-table tfoot td {
        font-weight: bold;
        background-color: #e6ffe6;
    }

    .signature-section {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }
    .signature-section div {
        text-align: left;
        width: 40%;
    }
    .group-by > td{
        font-weight: bold;
        padding: 7px ;
    }
    .report-table th, .report-table td {
        border: 1px solid #ccc;
        padding: 7px;
    }
    * table {
        white-space: nowrap !important;
    }
</style>


@if($type == 'is_print')
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

  <div class="KhmerOSMuolLight text-center">
    របាយការណ៍និស្សិត ក្រុម និងវេនសិក្សា
  </div>
  <div class="report-container control-table">
    <table class="report-table">
        <thead>
            <tr>
                <th class="text-center" width="20">លរ</th>
                <th width="20">ថ្នាក់</th>
                <th width="20">វេន</th>
                <th width="10">ជំនាញ</th>
                <th width="20">ដេប៉ាតឺម៉ង់</th>
                <th width="50">កម្រិត</th>
                <th width="50">ឆ្នាំសិក្សា</th>
                <th width="10">និស្សិតសរុប</th>
                <th width="15">និស្សិតស្រី</th>
            </tr>
        </thead>
        <tbody>
            <?php  $index = 1; ?>
            @foreach ($records as $record)
                <tr id="row{{ $index }}">
                    <td class="text-center" height="35">{{ $index }}</td>
                    <td>{{ $record->class_code }}</td>
                    <td>{{ $record->section ?? '' }}</td>
                    <td>{{ $record->skills ?? '' }}</td>
                    <td>{{ $record->department ?? '' }}</td>
                    <td>{{ $record->qualification ?? '' }}</td>
                    <td>{{ $record->session_year_code ?? '' }}</td>
                    <td>{{ $record->total_students ?? '' }}</td>
                    <td>{{ $record->total_f ?? '' }}</td>
                </tr>
            <?php $index++; ?>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <div class="report-container control-table">
        <table class="report-table">
            <thead>
                <tr>
                    <th class="text-center" width="20">លរ</th>
                    <th width="20">ថ្នាក់</th>
                    <th width="20">វេន</th>
                    <th width="10">ជំនាញ</th>
                    <th width="20">ដេប៉ាតឺម៉ង់</th>
                    <th width="50">កម្រិត</th>
                    <th width="50">ឆ្នាំសិក្សា</th>
                    <th width="10">និស្សិតសរុប</th>
                    <th width="15">និស្សិតស្រី</th>
                </tr>
            </thead>
            <tbody>
                <?php  $index = 1; ?>
                @foreach ($records as $record)
                    <tr id="row{{ $index }}">
                        <td class="text-center" height="35">{{ $index }}</td>
                        <td>{{ $record->class_code }}</td>
                        <td>{{ $record->section ?? '' }}</td>
                        <td>{{ $record->skills ?? '' }}</td>
                        <td>{{ $record->department ?? '' }}</td>
                        <td>{{ $record->qualification ?? '' }}</td>
                        <td>{{ $record->session_year_code ?? '' }}</td>
                        <td>{{ $record->total_students ?? '' }}</td>
                        <td>{{ $record->total_f ?? '' }}</td>
                    </tr>
                <?php $index++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
@endif