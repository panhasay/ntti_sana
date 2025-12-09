@extends('app_layout.app_layout')
@section('content')
    <style>
        .font-class {
            font-family: system-ui, sans-serif !important;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: system-ui, sans-serif;
        }

        table th,
        table td {
            border: 0.5px solid #dfdfdf !important;
            padding: 10px !important;
        }

        table thead th {
            background-color: transparent !important;
            text-align: center !important;
            vertical-align: middle !important;
            border: 0.5px solid #dfdfdf !important;
            padding: 10px !important;
            font-weight: bold !important;
        }

        table td {
            vertical-align: middle !important;
            text-align: center !important;
        }
    </style>
    <div class="page-title py-3">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <div class="title-page">
                    @php
                        $month = \Carbon\Carbon::now()->month;
                    @endphp
                    តារាងវត្តមានប្រចាំឆមាសទី {{ App\Service\service::convertToKhmerNumerals($classInfo->semester ?? '') }}
                    ឆ្នាំទី {{ App\Service\service::convertToKhmerNumerals($classInfo->years ?? '') }}
                    ក្រុម <span class="font-class">{{ $classInfo->class_code ?? '' }}</span>
                </div>
                <div class="header-left">
                    <button type="button"
                        class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2 prints-att-semester"
                        data-id="{{ $classInfo->class_schedule_id ?? '' }}" data-class="{{ $classInfo->class_code ?? '' }}"
                        data-semester="{{ $classInfo->semester ?? '' }}" data-years="{{ $classInfo->years ?? '' }}">Print
                        <i class="mdi mdi-printer btn-icon-append"></i>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/attendance-semester/index') }}">ទំព័រដើម</a></li>
                        <li class="breadcrumb-item active" aria-current="page">អវត្តមាន</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="table-responsive mb-5">
        <table class="table" id="table1">
            <thead>
                <tr>
                    <th rowspan="2">ល.រ</th>
                    <th rowspan="2">គោត្តនាម-នាម</th>
                    <th rowspan="2">ភេទ</th>
                    @foreach ($months as $month)
                        <th colspan="2" width="30">
                            ខែ {{ $kh_months[$month->month] }}
                            ថ្ងៃទី {{ App\Service\service::convertToKhmerNumerals($month->start_day) }} ដល់ថ្ងៃទី
                            {{ App\Service\service::convertToKhmerNumerals($month->end_day) }}
                        </th>
                    @endforeach
                    <th colspan="2">សរុប</th>
                </tr>
                <tr>
                    @foreach ($months as $month)
                        <th>ម.ច</th>
                        <th>ឥ.ច</th>
                    @endforeach
                    <th>ម.ច</th>
                    <th>ឥ.ច</th>
                </tr>
            </thead>
            <tbody>
                @include('general.attendance_semester_record')
            </tbody>
        </table>
    </div>
    <iframe id="printFrame" style="display:none;"></iframe>
    <script>
        $(document).on('click', '.prints-att-semester', function() {

            let schedule_id = $(this).data('id');
            let class_code = $(this).data('class');
            let semester = $(this).data('semester');
            let years = $(this).data('years');

            Swal.fire({
                title: "តើអ្នកចង់បោះពុម្ពមែនទេ?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "បោះពុម្ព",
                cancelButtonText: "បោះបង់",
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "/attendance-semester/print",
                        type: "GET",
                        data: {
                            id: schedule_id,
                            class_code: class_code,
                            semester: semester,
                            years: years
                        },
                        success: function(response) {

                            let iframe = document.getElementById("printFrame");
                            let doc = iframe.contentWindow || iframe.contentDocument;
                            if (doc.document) doc = doc.document;

                            doc.open();
                            doc.write(response);
                            doc.close();

                            iframe.contentWindow.focus();
                            iframe.contentWindow.print();
                        },
                        error: function() {
                            Swal.fire({
                                icon: "error",
                                title: "កំហុស!",
                                text: "មានបញ្ហាក្នុងការបោះពុម្ពទិន្នន័យ។",
                            });
                        }
                    });

                }
            });

        });
    </script>
@endsection
