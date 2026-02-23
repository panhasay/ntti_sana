
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
    .bg-ative {
       background: #528de561;
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
            អវត្តមាថ្ងៃនេះ
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
      </div>
    </div>
  </div>
    {{-- <div class="row">
        <!-- Date Filter -->
        <input type="date" id="dateFilter" class="form-control" value="{{ request('date', \Carbon\Carbon::now()->format('Y-m-d')) }}">

        <!-- Section Filter -->
        <select id="sectionFilter" class="form-control">
            <option value="">-- Select Section --</option>
            <option value="A" {{ request('sections_code') == 'A' ? 'selected' : '' }}>រសៀល</option>
            <option value="M" {{ request('sections_code') == 'M' ? 'selected' : '' }}>ព្រឹក</option>
            <option value="N" {{ request('sections_code') == 'N' ? 'selected' : '' }}>យប់</option>
            <option value="S" {{ request('sections_code') == 'S' ? 'selected' : '' }}>សៅរ៍អាទិត្យ</option>
        </select>
    </div> --}}
    <div class="row align-items-center mb-3">
    <!-- Date Filter -->
        <div class="col-md-4 col-sm-6 mb-2">
            <label for="dateFilter" class="form-label fw-bold">ថ្ងៃ</label>
            <input type="date" id="dateFilter" class="form-control" value="{{ request('date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
        </div>

        <!-- Section Filter -->
        <div class="col-md-4 col-sm-6 mb-2">
            <label for="sectionFilter" class="form-label fw-bold">វេន</label>
            <select id="sectionFilter" class="form-select">
                <option value="">-- វេន --</option>
                <option value="A" {{ request('sections_code') == 'A' ? 'selected' : '' }}>រសៀល (A)</option>
                <option value="M" {{ request('sections_code') == 'M' ? 'selected' : '' }}>ព្រឹក (M)</option>
                <option value="N" {{ request('sections_code') == 'N' ? 'selected' : '' }}>យប់ (N)</option>
                <option value="S" {{ request('sections_code') == 'S' ? 'selected' : '' }}>សៅរ៍អាទិត្យ (S)</option>
            </select>
        </div>
    </div>
</div>


 <div class="container mt-5">
    <div class="row">
        @foreach ($records as $record)
        @php
            $student = $studentAtt->where('assign_line_no', $record->assing_no)->first();
            if ($student != null) {
               $bgative = 'bg-ative';
            }else {
                $bgative = '';
            }
        @endphp
            <div class="col-md-3 mb-3">
                <div class="custom-card border border-success rounded-border p-3 h-100 position-relative shadow-sm {{ $bgative }}">
                    <div class="mb-2 fw-bold d-flex justify-content-between align-items-center">
                        <div class="fw-bold text-dark">ម៉ោងគ្រូ :{{ $record->teacher->name_2 ?? '' }}</div>
                            @php
                                $date = request('date') ?? $today;
                            @endphp
                        <a href="{{ url('/get-attendant-student') }}?assing_no={{ $record->assing_no ?? '' }}&date={{ $date }}"
                            class="btn btn-primary text-white btn-sm mb-2 mb-md-0 me-2">
                            យកអវត្តមាន
                        </a>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div>
                             <span>ក្រុម : {{ $record->class_code ?? '' }}</span>
                            <div class="text-muted small">ជំនាញ : {{ $record->skill->name_2 ?? '' }}</div>
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

<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>

<br><br><br><br><br><br><br>
@include('system.modal_comfrim_delet')
{{-- @include('general.skills_lists') --}}
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $('#dateFilter, #sectionFilter').on('change', function() {
            var date = $('#dateFilter').val();
            var section = $('#sectionFilter').val();

            // Build URL
            var url = '/attendance/dashboards-attendance?';
            if (date) url += 'date=' + date + '&';
            if (section) url += 'sections_code=' + section;

            // Redirect
            window.location.href = url;
        });
    });
  
  </script>
@endsection
