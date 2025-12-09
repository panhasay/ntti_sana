@extends('app_layout.app_layout')
@section('content')
    <style>
        table {
            border-collapse: collapse !important;
            width: 100% !important;
            border: 1px solid #000 !important;
        }

        table tr td {
            padding: 10px !important;
            border: 1px solid #000 !important;
        }

        table tr th {
            padding: 11px !important;
            border: 1px solid #000 !important;
            background: transparent !important;
        }

        .form-label {
            color: #2194ce;
        }

        .select2-container .select2-selection {
            border: 1px solid blue !important;
        }

        .select-error+.select2-container .select2-selection {
            border: 1px solid red !important;
        }

        .error-text {
            margin-left: 120px;
            color: red;
            font-size: 16px;
            display: block;
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        th {
            font-weight: 600 !important;
            border: 1px solid #000 !important;
        }

        #contentAssignClass {
            margin-bottom: 35rem;
        }
    </style>
    <div class="page-head page-head-custom mt-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                {{-- <div class="page-title page-title-custom">បង្កើត ថ្នាក់សិក្សាថ្មី</div> --}}
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ url('/class-schedule') }}" class="">
                    <i class="mdi mdi-keyboard-return"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="p-4">
        <form id="classScheduleForm" action="{{ route('class.schedule.store.v2') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ចាប់ផ្តើមអនុវត្ត <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="text-primary fw-semibold">ថ្នាក់/ក្រុម</label>
                        <span class="error-text" id="class_code_error"></span>
                    </div>
                    <select name="class_code" id="changeClass" class="class-select form-control" required>
                        <option value="">--ជ្រើសរើស--</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->class_code }}">{{ $class->name ?? $class->class_code }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ឆ្នាំសិក្សា</label>
                    <input type="text" id="session_year" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ឆមាស</label>
                    <input type="text" id="semester" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ឆ្នាំ</label>
                    <input type="text" id="year" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ជំនាញ</label>
                    <input type="text" id="skill_name" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ដេប៉ាតឺម៉ង់</label>
                    <input type="text" id="department_name" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">វេនសិក្សា</label>
                    <input type="text" id="section_name" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">បរិញ្ញាបត្រ</label>
                    <input type="text" id="qualification" class="form-control" disabled>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        💾 រក្សាទុកទិន្នន័យ
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('.class-select').select2({
                placeholder: 'ស្វែងរកថ្នាក់...',
                allowClear: true,
                width: '100%'
            });

            $('#changeClass').on('change', function() {
                let classCode = $(this).val();
                if (classCode) {
                    $.ajax({
                        url: "{{ route('class.schedule.add') }}",
                        type: "GET",
                        data: {
                            class_code: classCode,
                            type: "datajs"
                        },
                        success: function(response) {
                            const data = response.classes;
                            if (response.exists === true) {
                                Swal.fire({
                                    title: 'មិនអនុញ្ញាត!',
                                    icon: 'warning',
                                    text: response.message,
                                    confirmButtonText: 'យល់ព្រម',
                                    confirmButtonColor: '#3085d6',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            }
                            $('#session_year').val(data.session_year_code);
                            $('#semester').val(data.semester);
                            $('#year').val(data.years);
                            $('#skill_name').val(data.skill_name);
                            $('#department_name').val(data.department_name);
                            $('#section_name').val(data.section_name);
                            $('#qualification').val(data.qualification);
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            $('form').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let submitButton = form.find('button[type="submit"]');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if(response.status == "false"){
                           AlertMessager("warning", "មានបញ្ហា", response.message);
                            submitButton.prop('disabled', true);
                        }else{
                             window.location.href = "list/transaction/" + response
                            .class_schedule;
                        }
                    },
                    // error: function(xhr) {
                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: 'មានបញ្ហា!',
                    //         text: 'មិនអាចរក្សាទិន្នន័យបានទេ'
                    //     });
                    //     submitButton.prop('disabled', false);
                    // }
                });
            });
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'ជោគជ័យ!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'មានបញ្ហា!',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection
