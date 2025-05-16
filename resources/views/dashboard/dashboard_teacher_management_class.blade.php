
<style>
    .custom-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .custom-card:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        transform: translateY(-4px);
        border-color: #0d6efd; 
    }
    .rounded-border {
        border-radius: 1.2rem !important;
    }

</style>

@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <i class="mdi mdi-format-list-bulleted"></i>
            តារាងពត៏និស្សឹតសម្រាប់លោកគ្រូ អ្នកគ្រូដាក់ពិន្ទុ
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
            <a id="btnShowMenuSetting" href="{{ url('/teacher-dashboard') }}"><i class="mdi mdi-keyboard-return"></i></a>
        </h4>
      </div>
    </div>
  </div>
</div>


@if(isset($type) && $type == 'schedule')
<div class="container mt-5">
  <div class="row">
    @php
      $khmerDays = [
            'sunday' => 'អាទិត្យ',
            'monday' => 'ចន្ទ',
            'tuesday' => 'អង្គារ',
            'wednesday' => 'ពុធ',
            'thursday' => 'ព្រហស្បតិ៍',
            'friday' => 'សុក្រ',
            'saturday' => 'សៅរ៍',
        ];
    @endphp
      @foreach ($records as $record)
          <div class="col-md-3 mb-3">
              <div class="custom-card border border-success rounded-border p-3 h-100 position-relative shadow-sm">
                  <div class="mb-2 fw-bold d-flex justify-content-between align-items-center">
                      <h2>ថ្ងៃ : {{ $khmerDays[strtolower($record->date_name)] ?? $record->date_name }}</h2>
                      {{-- <a href="{{ '/assign-classes/transaction?type=ed&code=' . App\Service\service::Encr_string($record->id) }}&years={{ $record->years ?? '' }}&type={{ $record->qualification ?? '' }}&assing_no={{ $record->assing_no ?? '' }}" class="btn btn-primary text-white float-left btn-sm mb-2 mb-md-0 me-2"><i class="mdi mdi-border-color"></i> ដាក់ពិន្ទុ</a> --}}
                  </div>
                  <div class="d-flex align-items-center mb-2">
                      <div>
                          <div class="fw-bold text-dark">ជំនាញ : {{ $record->skill->name_2 ?? '' }} ក្រុម : {{ $record->class_code ?? '' }}</div>
                          <div class="text-muted small">មុខវិជ្ចា​ : {{ $record->subject->name ?? '' }}</div>
                          <div class="text-muted small">ឆ្នាំទី : {{ $record->years ?? '' }}</div>
                          <div class="text-muted small">ឆមាសទី : {{ $record->semester ?? '' }}</div>
                      </div>
                  </div>

                  {{-- <hr class="my-2" />

                  <div class="d-flex justify-content-between small text-muted mb-1">
                      <div><i class="bi bi-clock"></i> {{ $record->start_time ?? '' }} - {{ $record->end_time ?? '' }}</div>
                      <div>Room : ({{ $record->room ?? '' }})</div>
                  </div>
                  <div class="text-muted small">វេន : {{ $record->section->name_2 ?? '' }}</div>
                  <span class="position-absolute bottom-0 end-0 m-2 bg-warning rounded-circle" style="width:10px; height:10px;"></span> --}}
              </div>
          </div>
      @endforeach
  </div>
</div>
@else
  <div class="container mt-5">
    <div class="row">
        @foreach ($records as $record)
            <div class="col-md-3 mb-3">
                <div class="custom-card border border-success rounded-border p-3 h-100 position-relative shadow-sm">
                    <div class="mb-2 fw-bold d-flex justify-content-between align-items-center">
                        <span>ក្រុម : {{ $record->class_code ?? '' }}</span>
                        <a href="{{ '/assign-classes/transaction?type=ed&code=' . App\Service\service::Encr_string($record->id) }}&years={{ $record->years ?? '' }}&type={{ $record->qualification ?? '' }}&assing_no={{ $record->assing_no ?? '' }}" class="btn btn-primary text-white float-left btn-sm mb-2 mb-md-0 me-2"><i class="mdi mdi-border-color"></i> ដាក់ពិន្ទុ</a>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div>
                            <div class="fw-bold text-dark">ជំនាញ : {{ $record->skill->name_2 ?? '' }}</div>
                            <div class="text-muted small">មុខវិជ្ចា​ : {{ $record->subject->name ?? '' }}</div>
                            <div class="text-muted small">ឆ្នាំទី : {{ $record->years ?? '' }}</div>
                            <div class="text-muted small">ឆមាសទី : {{ $record->semester ?? '' }}</div>
                        </div>
                    </div>

                    <hr class="my-2" />
                      <div class="text-muted small">{{ $record->start_time ?? '' }} - {{ $record->end_time ?? '' }}</div>
                      <div class="text-muted small">Room : ({{ $record->room ?? '' }})</div>
                      <div class="text-muted small">វេន : {{ $record->section->name_2 ?? '' }}</div>
                    <span class="position-absolute bottom-0 end-0 m-2 bg-warning rounded-circle" style="width:10px; height:10px;"></span>
                </div>
            </div>
        @endforeach
    </div>
  </div>
@endif


<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>
@include('system.modal_comfrim_delet')
{{-- @include('general.skills_lists') --}}
<script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $(document).on('click', '#btnDelete', function() {
        $(".modal-confirmation-text").html('Do you want to delete?');
        $("#btnYes").attr('data-code', $(this).attr('data-code'));
        $("#divConfirmation").modal('show');
      });
      $(document).on('click', '#btnYes', function() {
        var code = $(this).attr('data-code');
        $.ajax({
          type: "POST",
          url: `/skills-delete`,
          data: {
            code: code
          },
          success: function(response) {
            if (response.status == 'success') {
              $("#divConfirmation").modal('hide');
              $("#row" + code).remove();
              notyf.success(response.msg);
            }
          }
        });
      });
    });
  
    function prints(ctrl) {
      var url = 'departments/print';
      var data = '';
      data = $("#advance_search").serialize();
      $.ajax({
        type: 'get',
        url: url,
        data: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
          $('.loader').show();
        },
        success: function(response) {
          $('.loader').hide();
          $('.print-content').html(response);
          $('.print-content').printThis({});
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    }
  
    function DownlaodExcel() {
      var url = '/student/downlaodexcel/';
      if ($('#search_data').val() == '') {
        data = $("#advance_search").serialize();
      } else {
        data = 'value=' + $('#search_data').val();
      }
      data = $("#advance_search").serialize();
      $.ajax({
        type: "post",
        url: url,
        data: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {},
        success: function(response) {
          notyf.error(response.msg);
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    }
  </script>
@endsection
