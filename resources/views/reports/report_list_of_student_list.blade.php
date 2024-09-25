
<?php  $index = 1; ?>
@if($type == 'downlaodexcel')
  <div class="row">
    <table>
      <tr>
        <th colspan="6"><img src="asset/NTTI/images/logo.png" alt="logo"></th>
        <th colspan="6">ព្រះរាជាណាចក្រកម្ពុជា <br> ជាតិ សាសនា ព្រះមហាក្សត</th>
      </tr>
    </table>
  </div>
  <table class="table table-striped">
    <thead>
      <tr class="general-data">
        <td width='3px' class="bold" scope="col">លរ</td>
        <td class="bold" scope="col">ដេប៉ាតឺម៉ង់</td>
        <td class="bold" scope="col">ជំនាញ</td>
        <td class="bold text-center" scope="col"> ឆ្នាំសិក្សា</td>
        <td class="bold text-center" scope="col">ថ្នាក់</td>
        <td class="bold text-center" scope="col">វេន</td>
        <td class="bold text-right" scope="col">និស្សិតស្រី</td>
        <td class="bold text-right" scope="col">និស្សិតប្រុស</td>
        <td class="bold text-right" scope="col">និស្សិតសរុប</td>
      </tr>
    </thead>
    <tbody>
      <?php $index = 1; $totals_qty_studen = 0; $totals_qty_studen_male = 0; $totals_qty_studen_female = 0;?>
      @foreach($records as $record)
        <?php 
          $totals_qty_studen += $record->qty_studen;
          $totals_qty_studen_male += $record->qty_studen_male;
          $totals_qty_studen_female += $record->qty_studen_female;
        ?>
      <tr>
        <td class="text-center">{{ $index++ }} &nbsp;&nbsp;&nbsp;</td>
        <td>{{ $record->department_name}}</td>
        <td>{{ $record->category}}</td>
        <td class="text-center">{{ $record->session}}</td>
        <td class="text-center">{{ $record->class}}</td>
        <td class="text-center">{{ $record->section}}</td>
        <td class="text-right">{{ $record->qty_studen_female ?? ''}}</td>
        <td class="text-right">{{ $record->qty_studen_male ?? ''}}</td>
        <td class="text-right">{{ isset($record->qty_studen) ? $record->qty_studen : '' }}</td>
      </tr>
      @endforeach
      <tr>
        <td colspan="6" class="text-right bold">សរុប</td>
        <td class="text-right bold">{{ $totals_qty_studen }}</td>
        <td class="text-right bold">{{ $totals_qty_studen_male }}</td>
        <td class="text-right bold">{{ $totals_qty_studen_female }}</td>
      </tr>
    </tbody>
  </table>
@else
  <div class="control-table">
    @if($type == 'print')
      <div class="row">
        <div class="col-sm-9"></div>
          <div class="col-sm-3 font-famaly text-center" style="font-family: 'Khmer Mool1';">
            ព្រះរាជាណាចក្រកម្ពុជា <br> ជាតិ សាសនា ព្រះមហាក្សត
          </div>
        </div>
        <div class="col-sm-12">
          <div class="col-sm-6">
            <img src="asset/NTTI/images/logo.png" alt="logo">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-10 text-center" style="font-family: 'Khmer Mool1';">
            តារាងបញ្ចីក្រុមនិស្សិតបច្ចេកទេស និងបច្ចេកវិទ្យា
          </div>
          <div class="col-sm-1"></div>
        </div>
      </div><br>
    @endif
  <div class="table-responsive custom-data-table-wrapper2">
    <table class="table table-bordered custom-data-table">
      <thead class="text-nowrap">
        <tr class="general-data">
          @if(isset($GroupBy_category))
            <td width='3px' class="bold" scope="col">លរ</td>
            <td width='700' class="bold" scope="col">ថ្នាក់​/ ​ក្រុម</td>
            <td width='50' class="bold text-center" scope="col">វេន</td>
            <td width='100' class="bold text-right" scope="col">និស្សិតប្រុស</td>
            <td width='100' class="bold text-right" scope="col">និស្សិតស្រី</td>
            <td width='100' class="bold text-right" scope="col">និស្សិតសរុប</td>
          @else
            <td width='3px' class="bold" scope="col">លរ</td>
            <td class="bold" scope="col">ដេប៉ាតឺម៉ង់</td>
            <td class="bold" scope="col">ជំនាញ</td>
            <td class="bold text-center" scope="col"> ឆ្នាំសិក្សា</td>
            <td class="bold text-center" scope="col">ថ្នាក់</td>
            <td class="bold text-center" scope="col">វេន</td>
            <td class="bold text-right" scope="col">និស្សិតស្រី</td>
            <td class="bold text-right" scope="col">និស្សិតប្រុស</td>
            <td class="bold text-right" scope="col">និស្សិតសរុប</td>
          @endif
        </tr>
      </thead>
      <!--Group By -->
      @if(isset($GroupBy_category))
      <tbody>
        @foreach ($records as $key => $group)
          <?php 
            $index = 1;
            $totals_qty_studen = 0;
            $totals_qty_studen_male = 0; 
            $totals_qty_studen_female = 0;
          ?>
          <tr>
            <td class="bold table-secondary" colspan="6">ជំនាញ​ {{ $key ?? ''}}</td> 
            {{-- <td class="bold table-secondary text-center">សរុប​</td> 
            <td class="bold table-secondary">១២៣</td> 
            <td class="bold table-secondary">១២៣</td> 
            <td class="bold table-secondary">១២៣</td>  --}}
          </tr>
          @foreach($group as $record)
            <?php 
              $totals_qty_studen += $record->qty_studen;
              $totals_qty_studen_male += $record->qty_studen_male;
              $totals_qty_studen_female += $record->qty_studen_female;
            ?>
            <tr>
              <td class="text-center">{{ $index++ }}</td>
              <td>{{ $record->class ?? ''}}</td>
              <td class="text-center">{{ $record->section ?? ''}}</td>
              <td class="text-right">{{ $record->qty_studen_female ?? ''}} នាក់</td>
              <td class="text-right">{{ $record->qty_studen_male ?? ''}} នាក់</td>
              <td class="text-right">{{ isset($record->qty_studen) ? $record->qty_studen : '' }} នាក់</td>
            </tr>
          @endforeach
          <tr>
            <td colspan="3" class="bold text-right">សរុប​</td> 
            <td class="bold text-right">{{ $totals_qty_studen_female ?? ''}} នាក់</td> 
            <td class="bold text-right">{{ $totals_qty_studen_male ?? ''}} នាក់</td> 
            <td class="bold text-right">{{ $totals_qty_studen ?? ''}} នាក់</td> 
          </tr>
        @endforeach
      </tbody>
      <!--End Group By -->
      @else
        <tbody>
          <?php $index = 1; $totals_qty_studen = 0; $totals_qty_studen_male = 0; $totals_qty_studen_female = 0;?>
          @foreach($records as $record)
            <?php 
                $totals_qty_studen += $record->qty_studen;
                $totals_qty_studen_male += $record->qty_studen_male;
                $totals_qty_studen_female += $record->qty_studen_female;
            ?>
          <tr>
            <td class="text-center">{{ $index++ }} &nbsp;&nbsp;&nbsp;</td>
            <td>{{ $record->department_name}}</td>
            <td>{{ $record->category}}</td>
            <td class="text-center">{{ $record->session}}</td>
            <td class="text-center">{{ $record->class}}</td>
            <td class="text-center">{{ $record->section}}</td>
            <td class="text-right">{{ $record->qty_studen_female ?? ''}} នាក់</td>
            <td class="text-right">{{ $record->qty_studen_male ?? ''}} នាក់</td>
            <td class="text-right">{{ isset($record->qty_studen) ? $record->qty_studen : '' }}</td>
          </tr>
          @endforeach
          <tfoot>
            @if($totals_qty_studen > 0) 
              <tr>
                <td colspan="6" class="text-right bold">សរុប</td>
                <td class="text-right bold">{{ $totals_qty_studen }}</td>
                <td class="text-right bold">{{ $totals_qty_studen_male }}</td>
                <td class="text-right bold">{{ $totals_qty_studen_female }}</td>
              </tr>
            @endif
          </tfoot>
        </tbody>
      @endif
    </table>
  </div>
  <br><br><br>
  </div>
@endif
<!---footer----->