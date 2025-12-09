@extends('app_layout.app_layout')
@section('content')
    <div class="page-title mt-2">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <div class="title-page">
                    តារាងវត្តមានប្រចាំខែ
                </div>
                <div class="header-left">
                </div>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/department-menu') }}">ទំព័រដើម</a></li>
                        <li class="breadcrumb-item active" aria-current="page">អវត្តមាន</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <table class="table table-striped table-hover text-center" id="table1">
        <thead>
            <tr class="bg-light">
                <th></th>
                <th class="fw-bold">ល.រ</th>
                <th class="text-center fw-bold">ថ្នាក់/ក្រុម</th>
                <th class="text-center fw-bold">វេនសិក្សា</th>
                <th class="text-center fw-bold">ជំនាញ</th>
                <th class="text-center fw-bold">កម្រិត</th>
                <th class="text-center fw-bold">ដេប៉ាតឺម៉ង់</th>
                <th class="text-center fw-bold">ឆ្នាំសិក្សា</th>
                <th class="text-center fw-bold">បរិញ្ញាប័ត្រ</th>
                <th class="text-center fw-bold">ឆមាស</th>
            </tr>
        </thead>
        <tbody id="attendanceMonthly">
            @php
                $index = 1;
            @endphp
            @foreach ($classes as $record)
                @php
                    $skill = DB::table('skills')->where('code', $record->skills_code)->value('name_2');
                    $department = DB::table('department')->where('code', $record->department_code)->value('name_2');
                    $section = DB::table('sections')->where('code', $record->sections_code)->value('name_2');
                @endphp

                <tr>
                    <td>
                        <a href="{{ url('/attendance-monthly/list') }}?class_code={{ $record->class_code }}&semester={{ $record->semester }}&years={{ $record->years }}&id={{ $record->id }}"
                            class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2">
                            <i class="mdi mdi-border-color"></i>វត្តមានប្រចាំខែ
                        </a>
                        <a href="{{ url('/attendance-monthly/class-list') }}?class_code={{ $record->class_code }}&semester={{ $record->semester }}&years={{ $record->years }}&id={{ $record->id }}"
                            class="btn btn-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">
                            វត្តមានតាមមុខវិជ្ជា
                        </a>
                    </td>
                    <td>{{ $index++ }}</td>
                    <td>{{ $record->class_code ?? '' }}</td>
                    <td>{{ $section ?? '' }}</td>
                    <td>{{ $skill ?? '' }}</td>
                    <td>{{ $record->qualification ?? '' }}</td>
                    <td>{{ $department ?? '' }}</td>
                    <td>{{ $record->session_year_code ?? '' }}</td>
                    <td>ឆ្នាំទី {{ $record->years ?? '' }}</td>
                    <td>ឆមាសទី {{ $record->semester ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
