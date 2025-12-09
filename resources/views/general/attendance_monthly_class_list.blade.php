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

        .name_en {
            font-family: system-ui, sans-serif !important;
        }
    </style>
    <div class="page-title py-3">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <div class="title-page">
                    @php
                        $month = \Carbon\Carbon::now()->month;
                        $class_info = $records->first();
                    @endphp
                    តារាងវត្តមានប្រចាំខែ {{ App\Service\service::getMonthKhmer($month - 1) }} ក្រុម <span
                        class="font-class">{{ $class_info->class_code ?? '' }}</span>
                    ឆ្នាំទី {{ App\Service\service::convertToKhmerNumerals($class_info->years ?? '') }}
                    ឆមាសទី
                    {{ App\Service\service::convertToKhmerNumerals($class_info->semester ?? '') }}
                </div>
                <div class="header-left">
                </div>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/attendance-monthly/index') }}">ទំព័រដើម</a></li>
                        <li class="breadcrumb-item active" aria-current="page">អវត្តមាន</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover text-center" id="table1">
            <thead>
                <tr class="bg-light">
                    <th></th>
                    <th class="text-center fw-bold">ល.រ</th>
                    <th class="text-center fw-bold">សាស្ត្រាចារ្យ</th>
                    <th class="text-center fw-bold">មុខវិជ្ជា</th>
                    <th class="text-center fw-bold">ដេប៉ាតឺម៉ង់</th>
                    <th class="text-center fw-bold">ជំនាញ</th>
                    <th class="text-center fw-bold">កម្រិត</th>
                    <th class="text-center fw-bold">វេនសិក្សា</th>
                    <th class="text-center fw-bold">ម៉ោងបង្រៀន</th>
                </tr>
            </thead>
            <tbody>
                @include('general.attendance_monthly_class_record')
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="subjectModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">ព័ត៌មានវត្តមានតាមមុខវិជ្ជា</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th rowspan="2">ល.រ</th>
                                <th rowspan="2">គោត្តនាម-នាម</th>
                                <th rowspan="2">ភេទ</th>
                                <th colspan="2">សរុ​ប</th>
                            </tr>
                            <tr>
                                <th>ម.ច</th>
                                <th>ឥ.ច</th>
                            </tr>
                        </thead>
                        <tbody id="subjectModalBody">
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", ".openSubjectModal", function() {
            let assign_no = $(this).data("assign");
            $("#subjectModal").modal("show");

            $.ajax({
                url: "/attendance-monthly/class-detail",
                type: "GET",
                data: {
                    assign_no: assign_no
                },

                success: function(response) {
                    $("#subjectModalBody").empty();

                    let records = response.records;
                    console.log(records);
                    if (!records || records.length === 0) {
                        $("#subjectModalBody").html(
                            '<tr><td colspan="5" class="text-center">គ្មានទិន្នន័យ</td></tr>'
                        );
                        return;
                    }

                    let grouped = {};

                    records.forEach(item => {
                        if (!grouped[item.student_name]) {
                            grouped[item.student_name] = {
                                student_name: item.student_name,
                                name_en: item.name_en,
                                gender: item.gender,
                                total_permission: 0,
                                total_absent: 0
                            };
                        }

                        grouped[item.student_name].total_permission += parseInt(item
                            .permission);
                        grouped[item.student_name].total_absent += parseInt(item.absent);
                    });

                    let index = 1;
                    Object.values(grouped).forEach(student => {
                        let row = `
                            <tr>
                                <td>${index++}</td>
                                <td class="text-start">
                                    ${student.student_name} -
                                    <span class="name_en">${student.name_en}</span>
                                </td>
                                <td>${student.gender}</td>
                                <td class="${student.total_permission > 14 ? 'text-danger' : ''}">${student.total_permission}</td>
                                <td class="${student.total_absent > 14 ? 'text-danger' : ''}">${student.total_absent}</td>
                            </tr>
                        `;
                        $("#subjectModalBody").append(row);
                    });
                },

                error: function() {
                    $("#subjectModalBody").html(
                        '<tr><td colspan="5" class="text-center">មានកំហុសក្នុងការទាញទិន្នន័យ</td></tr>'
                    );
                }
            });
        });
    </script>
@endsection
