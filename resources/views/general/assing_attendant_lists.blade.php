<style>
  .table th,
  .table td {
    vertical-align: middle;
    font-size: 0.875rem;
    line-height: 1;
    white-space: nowrap;
    font-family: 'Khmer OS Battambang';
    padding: 9px !important;
  }
  .table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: 800;
    font-weight: initial;
    background: #d4d4d5;
    font-family: 'Khmer OS Battambang' !important;
    border: 1px solid #5b5b5b33;
  }
</style>
<base href="/public">
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="page-head page-head-custom">
    <div class="row border-bottom p-2">
      <div class="col-md-6 col-sm-6  col-6">
        <div class="page-title page-title-custom">
          <div class="title-page">
            <a onclick="history.back()" href="#"><i class="mdi mdi-format-list-bulleted"></i></a>
            អវត្តមានថ្នាក់ / ក្រុម​ {{ $header->class_code ?? '' }}
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-6">
        <div class="page-title page-title-custom text-right">
          <h4 class="text-right">
            <a id="btnShowMenuSetting" onclick="history.back()" href="javascript:void(0);">
              <i class="mdi mdi-keyboard-return"></i>
            </a>
          </h4>
        </div>
      </div>
    </div>
  </div>
  <div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
      <thead>
        <tr>
          <th rowspan="3" class="text-center" width="20">អត្តលេខ</th>
          <th rowspan="3" class="text-center" width="30">គោត្តនាម និងនាម</th>
          <th rowspan="3" class="text-center" width="30">ឈ្មោះជាឡាតាំង</th>
          <th rowspan="3" class="text-center" width="30">ភេទ</th>
          <th rowspan="2" colspan="19" class="text-center">កាលបរិច្ឆេទ</th>
        </tr>
        <tr>
          {{-- <th> 1</th>
            <th> 2</th> --}}
        </tr>
        <?php
            $data = App\Models\General\AssingClassesStudentLine::where('assing_line_no', $header->assing_no)->first();
          ?>
        <tr>
          <!--1-->
          @if($data->attendant_date_week_1)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_1" name="attendant_date_week_1" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_1 ?? '' }}"></th>
          @else
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_1" name="attendant_date_week_1" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_2 ?? '' }}"></th>
          @endif
          <!--2-->
          @if($data->attendant_date_week_2)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_2" name="attendant_date_week_2" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_2 ?? '' }}"></th>
          @elseif($data->attendant_date_week_1)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_2" name="attendant_date_week_2" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_2 ?? '' }}"></th>
          @endif

          @if($data->attendant_date_week_3)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_3" name="attendant_date_week_3" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_3 ?? '' }}"></th>
          @elseif($data->attendant_date_week_2)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_3" name="attendant_date_week_3" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_3 ?? '' }}"></th>
          @endif

          @if($data->attendant_date_week_4)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_4" name="attendant_date_week_4" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_4 ?? '' }}"></th>
          @elseif($data->attendant_date_week_3)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_4" name="attendant_date_week_4" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_4 ?? '' }}"></th>
          @endif

          @if($data->attendant_date_week_5)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_5" name="attendant_date_week_5" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_5 ?? '' }}"></th>
          @elseif($data->attendant_date_week_4)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_5" name="attendant_date_week_5" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_5 ?? '' }}"></th>
          @endif

          @if($data->attendant_date_week_6)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_6" name="attendant_date_week_6" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_6 ?? '' }}"></th>
          @elseif($data->attendant_date_week_5)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_6" name="attendant_date_week_6" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_6 ?? '' }}"></th>
          @endif

          @if($data->attendant_date_week_7)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_7" name="attendant_date_week_7" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_7 ?? '' }}"></th>
          @elseif($data->attendant_date_week_6)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_7" name="attendant_date_week_7" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_7 ?? '' }}"></th>
          @endif

          @if($data->attendant_date_week_8)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_8" name="attendant_date_week_8" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_8 ?? '' }}"></th>
          @elseif($data->attendant_date_week_7)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_8" name="attendant_date_week_8" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_8 ?? '' }}"></th>
          @endif

          @if($data->attendant_date_week_9)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_9" name="attendant_date_week_9" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_9 ?? '' }}"></th>
          @elseif($data->attendant_date_week_8)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_9" name="attendant_date_week_9" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_9 ?? '' }}"></th>
          @endif


          @if($data->attendant_date_week_10)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_10" name="attendant_date_week_10" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_10 ?? '' }}"></th>
          @elseif($data->attendant_date_week_9)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_10" name="attendant_date_week_10" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_10 ?? '' }}"></th>
          @endif


          @if($data->attendant_date_week_11)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_11" name="attendant_date_week_11" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_11 ?? '' }}"></th>
          @elseif($data->attendant_date_week_10)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_11" name="attendant_date_week_11" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_11 ?? '' }}"></th>
          @endif


          @if($data->attendant_date_week_12)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_12" name="attendant_date_week_12" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_12 ?? '' }}"></th>
          @elseif($data->attendant_date_week_11)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_12" name="attendant_date_week_12" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_12 ?? '' }}"></th>
          @endif


          @if($data->attendant_date_week_13)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_13" name="attendant_date_week_13" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_13 ?? '' }}"></th>
          @elseif($data->attendant_date_week_12)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_13" name="attendant_date_week_13" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_13 ?? '' }}"></th>
          @endif


          @if($data->attendant_date_week_14)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_14" name="attendant_date_week_14" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_14 ?? '' }}"></th>
          @elseif($data->attendant_date_week_13)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_14" name="attendant_date_week_14" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_14 ?? '' }}"></th>
          @endif


          @if($data->attendant_date_week_15)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_15" name="attendant_date_week_15" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_15 ?? '' }}"></th>
          @elseif($data->attendant_date_week_14)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_15" name="attendant_date_week_15" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_15 ?? '' }}"></th>
          @endif


          @if($data->attendant_date_week_16)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_16" name="attendant_date_week_16" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_16 ?? '' }}"></th>
          @elseif($data->attendant_date_week_15)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_16" name="attendant_date_week_16" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_16 ?? '' }}"></th>
          @endif

          @if($data->attendant_date_week_17)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_17" name="attendant_date_week_17" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_17 ?? '' }}"></th>
          @elseif($data->attendant_date_week_16)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_17" name="attendant_date_week_17" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_17 ?? '' }}"></th>
          @endif


          @if($data->attendant_date_week_18)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_18" name="attendant_date_week_18" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_18 ?? '' }}"></th>
          @elseif($data->attendant_date_week_17)
          <th width="5" class=""><input type="date" class="form-control form-control-sm form-dateAttendant"
              id="attendant_date_week_18" name="attendant_date_week_18" placeholder="Date" aria-label="Date"
              value="{{ $data->attendant_date_week_18 ?? '' }}"></th>
          @endif
          <th width="5" class="text-center">សរុប​អវត្តមាន</th>
        </tr>
      </thead>
      <tbody id="recordsLineTableBody">
        @foreach ($records as $line)
        <?php $date_week = App\Models\General\AssingClassesStudentLine::where('assing_line_no', $line->assing_line_no)->first(); ?>
        <tr>
          <td class="text-center">{{ $line->student->code ?? ''}}</td>
          <td>{{ $line->student->name_2 ?? ''}}</td>
          <td>{{ $line->student->name ?? ''}}</td>
          <td>{{ $line->student->gender ?? ''}}</td>

          @if($data->attendant_date_week_1)
            <td class="text-center">
              <div class="col-sm-12">
                <select class="js-example-basic-single form_data" id="score_week_1" name="score_week_1" data-studen="{{ $line->student_code ?? '' }}">
                  <option value="">&nbsp;</option>
                  <option value="2" {{ $line->score_week_1 == '2' ? 'selected' : '' }}>2-ពិន្ទុ</option>
                  <option value="1" {{ $line->score_week_1 == '1' ? 'selected' : '' }}>1-ពិន្ទុ</option>
                  <option value="0.5" {{ $line->score_week_1 == '0.5' ? 'selected' : '' }}>0.5-ពិន្ទុ</option>
                </select>
              </div>
            </td>
          @else
            <td class="text-center">
              <div class="col-sm-12">
                <select class="js-example-basic-single form_data" id="score_week_1" name="score_week_1" data-studen="{{ $line->student_code ?? '' }}">
                    <option value="">&nbsp;</option>
                    <option value="2" {{ $line->score_week_1 == '2' ? 'selected' : '' }}>2-ពិន្ទុ</option>
                    <option value="1" {{ $line->score_week_1 == '1' ? 'selected' : '' }}>1-ពិន្ទុ</option>
                    <option value="0.5" {{ $line->score_week_1 == '0.5' ? 'selected' : '' }}>0.5-ពិន្ទុ</option>
                </select>
              </div>
            </td>
          @endif
          <?php
              $weeks = [];
            // Loop to generate the array with 17 weeks
            for ($i = 1; $i <= 17; $i++) {
                $weeks[$i] = [
                    'current' => 'attendant_date_week_' . ($i + 1), // Current week value
                    'previous' => $i == 1 ? 'attendant_date_week_1' : 'attendant_date_week_' . $i // Previous week value
                ];
            }
          ?>
          @for ($i = 1; $i <= 17; $i++)
              @if ($data->{$weeks[$i]['current']})
                  <td class="text-center">
                      <div class="col-sm-12">
                          <select class="js-example-basic-single form_data" id="score_week_{{ $i + 1 }}" name="score_week_{{ $i + 1 }}" data-studen="{{ $line->student_code ?? '' }}">
                            <option value="">&nbsp;</option>
                            <option value="2" {{ $line['score_week_' . ($i + 1)] == '2' ? 'selected' : '' }}>2-ពិន្ទុ</option>
                            <option value="1" {{ $line['score_week_' . ($i + 1)] == '1' ? 'selected' : '' }}>1-ពិន្ទុ</option>
                            <option value="0.5" {{ $line['score_week_' . ($i + 1)] == '0.5' ? 'selected' : '' }}>0.5-ពិន្ទុ</option>
                          </select>
                      </div>
                  </td>
              @endif
          @endfor
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $(document).on('change', '.form-dateAttendant', function() {
      let name = event.target.name;
      let value = event.target.value;
      var assing_no = "{{ isset($_GET['assing_no']) ? addslashes($_GET['assing_no']) : '' }}";
      var url = '/update-attendant-date-student?name=' + name + '&value=' + value + '&assing_no=' + assing_no;
      data = $("#advance_search").serialize();
      $.ajax({
        type: 'get',
        url: url,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
          $('.loader').show();
        },
        success: function(response) {
         window.location.reload();
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    });
    $(document).on('change', '.form_data', function() {
      let name = event.target.name;
      let value = event.target.value;
      let student_code = $(this).attr('data-studen');
      var assing_no = "{{ isset($_GET['assing_no']) ? addslashes($_GET['assing_no']) : '' }}";
      var url = '/supdate-attendant-score-student?name=' + name + '&value=' + value + '&assing_no=' + assing_no + '&student_code=' +student_code;
      $.ajax({
        type: 'get',
        url: url,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
          $('.loader').show();
        },
        success: function(response) {
          $('.loader').hide();
          notyf.success(response.msg);
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    });
  });
</script>
@endsection