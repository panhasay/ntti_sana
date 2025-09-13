    @extends('app_layout.app_layout')
    @section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            table th,
            table td {
                padding: 10px !important;
                background-color: transparent !important;
                border: solid 1px #333 !important;
            }

            .margin-bottom {
                margin-bottom: 60px !important;
            }

            .marginTop {
                margin-top: 12rem !important;
            }

            .selected-subject-list {
                padding-left: 0;
                margin: 0;
                list-style: inside;
                text-align: left;
            }

            .selected-subject-list li {
                padding: 2px 0;
                font-size: 13px;
                color: #333;
                word-break: break-word;
                list-style: none;
            }

            td .btn {
                margin-bottom: 5px;
            }

            td .selected-subject-list {
                display: block;
                max-height: none;
            }

            .form-check .form-check-label {
                margin-left: 0;
            }
        </style>
        <div class="margin-bottom">
            @if ($records->count())
                <div class="page-head page-head-custom">
                    <div class="row">
                        <div class="col-md-6 col-sm-6  col-6">
                            <div class="page-title page-title-custom">
                                <div class="title-page">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                    បញ្ជីរាយនាមនិស្សិតដែលត្រូវមកប្រឡងក្រេឌីត
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="page-title page-title-custom text-right">
                                <h4 class="text-right">
                                    <a href="{{ url('exam-credit') }}"><i class="mdi mdi-keyboard-return"></i></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header flex-wrap py-3">
                    <div class="header-left">
                        <button type="button" id="print-student-list" data-code="{{ $_GET['class_code'] ?? '' }}"
                            class="btn btn-outline-info btn-sm" disabled>
                            Print <i class="mdi mdi-printer"></i>
                        </button>
                        <button type="button" onclick="DownlaodExcel()" disabled
                            class="btn btn-outline-success btn-icon-text btn-sm btn-excel-download">Excel
                            <i class="mdi mdi-printer btn-icon-append"></i>
                        </button>
                        <button id="assign-score" disabled
                            class="text-decoration-none btn btn-sm btn-success">ដាក់ពិន្ទុ</button>
                        {{-- <button type="button" class="btn btn-outline-success btn-icon-text btn-sm">
                            រក្សាទុក
                        </button> --}}
                    </div>
                    <div class="d-grid d-md-flex justify-content-md-end p-3">

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="40" class="text-center fw-bolder">ល.រ</th>
                                <th width="250" class="text-center fw-bolder">គោត្តនាម-នាម</th>
                                <th width="100" class="text-center fw-bolder">ភេទ</th>
                                <th width='90' class="text-center fw-bolder">ក្រុម</th>
                                <th width='120'class="text-center fw-bolder">ឆ្នាំសិក្សា</th>
                                <th width='90' class="text-center fw-bolder">ចំនួនអវត្តមាន</th>
                                <th width='90' class="text-center fw-bolder">ប្រឡងសង</th>
                                <th width='350' class="text-center fw-bolder">សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $shownGroups = [];
                                $grouped = $records->groupBy(function ($item) {
                                    return $item->class_code . '_' . $item->semester . '_' . $item->years;
                                });
                                $rowspans = $grouped->map->count();
                            @endphp
                            @foreach ($records as $record)
                                @php
                                    $groupKey = $record->class_code . '_' . $record->semester . '_' . $record->years;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $record->name_2 }}</td>
                                    <td class="text-center">{{ $record->gender }}</td>
                                    <td class="text-center">
                                        {{ \App\Service\Service::removeDotFromCode($record->class_code) }}
                                    </td>
                                    <td class="text-center">Y{{ $record->years }}S{{ $record->semester }}</td>
                                    <td class="text-center">{{ $record->total_absent }}</td>
                                    @if ($record->total_absent > 3 && $record->total_absent <= 4)
                                        <td class='fw-bold text-center'>3​ មុខវិជ្ជា</td>
                                    @elseif ($record->total_absent > 4 && $record->total_absent <= 10)
                                        <td class='fw-bold text-center'>5 ​មុខវិជ្ជា</td>
                                    @else
                                        <td class='fw-bold text-center'>ត្រួតថ្នាក់</td>
                                    @endif
                                    @if (!in_array($groupKey, $shownGroups))
                                        <td class="text-center" rowspan="{{ $rowspans[$groupKey] }}">
                                            <button class="btn btn-sm btn-success select-subject-btn"
                                                data-code="{{ $record->class_code }}"
                                                data-semester="{{ $record->semester }}">
                                                ជ្រើសរើសមុខវិជ្ជា
                                            </button>
                                            <ul class="list-unstyled selected-subject-list"
                                                data-code="{{ $record->class_code }}"
                                                data-semester="{{ $record->semester }}">
                                            </ul>
                                        </td>
                                        @php
                                            $shownGroups[] = $groupKey;
                                        @endphp
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="page-head page-head-custom">
                    <div class="row">
                        <div class="col-md-6 col-sm-6  col-6"></div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="page-title page-title-custom text-right">
                                <h4 class="text-right">
                                    <a href="{{ url('exam-credit') }}"><i class="mdi mdi-keyboard-return"></i></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center marginTop">
                    <h3>No attendance list found in this class.</h3>
                </div>
            @endif
        </div>

        <div class="print-content d-none"></div>

        <div class="modal fade" id="ModelSelectSubject" tabindex="-1" role="dialog" aria-labelledby="ModelPrints"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-m-header">
                        <h5 class="modal-title">Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="modal-confirmation-text text-center p-4">select subjects</h4>
                        <div class="subject-list px-3 ms-5">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="ClosePrintModal">Close</button>
                        <button type="button" id="ResetSubjects" class="btn btn-danger">Reset</button>
                        <button type="button" id="Selected" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ModelPrint" tabindex="-1" role="dialog" aria-labelledby="ModelPrints"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-m-header">
                        <h5 class="modal-title">Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="modal-confirmation-text text-center p-4">

                        </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="ClosePrintModal">Close</button>
                        <button type="button" id="YesPrints" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            window.classSubjects = @json($classSubjects);
            let selectedSubjectsPerGroup = {};
            let currentSelectButton = null;

            $(document).on('click', '.select-subject-btn', function() {
                currentSelectButton = $(this);

                let classCode = $(this).data('code');
                let semester = $(this).data('semester');
                let key = classCode + '_' + semester;

                let subjects = window.classSubjects[key] || [];
                let selectedSubjects = selectedSubjectsPerGroup[key] || [];
                console.log(selectedSubjects)

                let html = `
                
                `;

                subjects.forEach(function(subject, index) {
                    const isChecked = selectedSubjects.includes(subject) ? 'checked' : '';
                    html += `
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="${subject}" id="subject_${index}" ${isChecked}>
                        <label class="form-check-label mb-0" for="subject_${index}">${subject}</label>
                    </div>
                `;
                });

                $('.subject-list').html(html);
                $('#ModelSelectSubject').modal('show');
            });

            let allStudents = @json(
                $records->groupBy(function ($item) {
                    return $item->class_code . '_' . $item->semester;
                }));

            $(document).on('click', '#assign-score', function() {
                let studentsToSend = {};

                Object.keys(selectedSubjectsPerGroup).forEach(function(key) {
                    if (allStudents[key]) {
                        studentsToSend[key] = allStudents[key];
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('exam-credit.assign-score') }}',
                    data: {
                        selectedSubjects: selectedSubjectsPerGroup,
                        students: studentsToSend,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('.loader').show();
                    },
                    success: function(response) {
                        $('.loader').hide();
                        if (response.status === 'success') {
                            window.location.href = response.redirect_url;
                        } else {
                            notyf.error("Error: " + (response.msg || 'Unexpected error.'));
                        }
                    },
                    error: function() {
                        $('.loader').hide();
                        notyf.error("Request failed.");
                    }
                });
            });


            $(document).on('click', '#Selected', function() {
                let selectedSubjects = [];
                $('.subject-list input.form-check-input:checked').each(function() {
                    selectedSubjects.push($(this).val());
                });

                if (selectedSubjects.length !== 3 && selectedSubjects.length !== 5) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid Select Subject!',
                        text: 'សូមជ្រើសរើស ៣ មុខវិជ្ជា ឬ ៥​មុខវិជ្ជា',
                        confirmButtonText: 'OK'
                    });
                    $(this).val('');
                    return;
                }

                if (currentSelectButton) {
                    let classCode = currentSelectButton.data('code');
                    let semester = currentSelectButton.data('semester');
                    let key = classCode + '_' + semester;

                    selectedSubjectsPerGroup[key] = selectedSubjects;

                    currentSelectButton.text(
                        selectedSubjects.length > 0 ? 'កែប្រែ' : 'ជ្រើសរើសមុខវិជ្ជា'
                    );

                    let $list = $('.selected-subject-list')
                        .filter(function() {
                            return $(this).data('code') === classCode &&
                                $(this).data('semester') == semester;
                        });

                    $list.empty();
                    selectedSubjects.forEach(function(subject) {
                        $list.append('<li>' + subject + '</li>');
                    });
                }

                const anyGroupSelected = Object.values(selectedSubjectsPerGroup).some(arr => arr.length > 0);
                $('#print-student-list').prop('disabled', !anyGroupSelected);
                $('.btn-excel-download').prop('disabled', !anyGroupSelected);
                $('#assign-score').prop('disabled', !anyGroupSelected);

                $('#ModelSelectSubject').modal('hide');
            });

            $(document).on('click', '#ResetSubjects', function() {
                $('.subject-list input.form-check-input').prop('checked', false);

                if (currentSelectButton) {
                    currentSelectButton.text('ជ្រើសរើសមុខវិជ្ជា');

                    let classCode = currentSelectButton.data('code');
                    let semester = currentSelectButton.data('semester');
                    let key = classCode + '_' + semester;

                    selectedSubjectsPerGroup[key] = [];
                    currentSelectButton.closest('td').find('.selected-subject-list').empty();
                }

                const anyGroupSelected = Object.values(selectedSubjectsPerGroup).some(arr => arr.length > 0);
                $('#print-student-list').prop('disabled', !anyGroupSelected);
                $('.btn-excel-download').prop('disabled', !anyGroupSelected);
                $('#assign-score').prop('disabled', !anyGroupSelected);

                $('#ModelSelectSubject').modal('hide');
            });

            $(document).off('change', '.subject-list input.form-check-input').on('change',
                '.subject-list input.form-check-input',
                function() {
                    let checkedCount = $('.subject-list input.form-check-input:checked').length;
                    if (checkedCount > 5) {
                        $(this).prop('checked', false);
                        Swal.fire({
                            icon: 'warning',
                            title: 'Invalid Select Subjects!',
                            text: 'អ្នកអាចជ្រើសរើសបានតែ ៥ មុខវិជ្ជាប៉ុណ្ណោះ',
                            confirmButtonText: 'OK'
                        });
                        $(this).val('');
                    }
                });

            $(document).on('click', '#ClosePrintModal', function() {
                $("#ModelPrint").modal('hide')
                $("#ModelSelectSubject").modal('hide')
            });

            $(document).on('click', '#print-student-list', function() {
                let code = $(this).data('code');
                $(".modal-confirmation-text").text('Do you want to download and print?');
                $("#YesPrints").data('code', code);
                $("#ModelPrint").modal('show');
            });

            $(document).on('click', '#YesPrints', function() {
                let code = $(this).data('code');
                let url = '/exam-credit/print-exam-student-list';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        selectedSubjects: selectedSubjectsPerGroup,
                        class_code: code,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('.loader').show();
                    },
                    success: function(response) {
                        $('.loader').hide();
                        $('#ModelPrint').modal('hide');
                        if (response.status === 'success') {
                            $('.print-content').html(response.html).removeClass('d-none');
                            setTimeout(function() {
                                $('.print-content').printThis({
                                    // afterPrint: function() {
                                    //     location.reload();
                                    // }
                                });
                            }, 300);
                        } else {
                            notyf.error("Error: " + (response.msg || 'Unexpected error.'));
                        }
                    },
                    error: function() {
                        $('.loader').hide();
                        notyf.error("Request failed.");
                    }
                });
            });
        </script>
    @endsection
