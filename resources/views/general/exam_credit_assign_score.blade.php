@extends('app_layout.app_layout')
@section('content')
    <style>
        table th,
        table td {

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
        }

        input {
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }

        input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
            outline: none;
        }
    </style>
    <div class="margin-bottom">

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
                            <a href="{{ url('/exam-credit/exam-student-list') }}"><i
                                    class="mdi mdi-keyboard-return"></i></a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header flex-wrap py-3">
            <div class="header-left">
                <button type="button" id="print-student-list" data-code="{{ $_GET['class_code'] ?? '' }}"
                    class="btn btn-outline-info btn-sm">
                    Print <i class="mdi mdi-printer"></i>
                </button>
                <button type="button" onclick="DownloadExcel()"
                    class="btn btn-outline-success btn-icon-text btn-sm btn-excel-download">Excel
                    <i class="mdi mdi-file-excel"></i>
                </button>
            </div>
            <div class="d-grid d-md-flex justify-content-md-end p-3">

            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="50" class="text-center fw-bolder">
                            <input type="checkbox" id="checkAllPresent" class="cursor-pointer" />
                            <label for="checkAllPresent">វត្តមាន</label>
                            <input type="checkbox" id="checkAllAbsent" class="cursor-pointer" />
                            <label for="checkAllAbsent">អវត្តមាន</label>
                        </th>
                        <th width="40" class="text-center fw-bolder">ល.រ</th>
                        <th width="200" class="text-center fw-bolder">គោត្តនាម-នាម</th>
                        <th width="100" class="text-center fw-bolder">ភេទ</th>
                        <th width='90' class="text-center fw-bolder">ក្រុម</th>
                        <th width='100'class="text-center fw-bolder">ឆ្នាំសិក្សា</th>
                        <th width='90' class="text-center fw-bolder">មុខវិជ្ជា</th>
                        <th width='250' class="text-center fw-bolder">ពិន្ទុសរុប</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($students as $groupKey => $group)
                        @foreach ($group as $student)
                            <tr>
                                <td>
                                    <input type="checkbox" id="yes_{{ $index }}"
                                        class="present-checkbox cursor-pointer" name="option_yes" value="yes">
                                    <label for="yes">វត្តមាន</label>

                                    <input type="checkbox" class="absent-checkbox cursor-pointer"
                                        id="no_{{ $index }}" name="option_no_{{ $index }}" value="no">
                                    <label for="no_{{ $index }}">អវត្តមាន</label>
                                </td>
                                <td class="text-center">{{ $index++ }}</td>
                                <td>{{ $student['name_2'] }}</td>
                                <td class="text-center">{{ $student['gender'] }}</td>
                                <td class="text-center">{{ $student['class_code'] }}</td>
                                <td class="text-center">Y{{ $student['years'] }}S{{ $student['semester'] }}</td>
                                <td>
                                    @if ($student['total_absent'] > 3 && $student['total_absent'] <= 4)
                                        @foreach (array_slice($selectedSubjects[$groupKey], 0, 3) as $subject)
                                            <input type="text" class="subject-score" autocomplete="off"
                                                name="scores[{{ $subject }}]" placeholder="{{ $subject }}">
                                        @endforeach
                                    @elseif ($student['total_absent'] > 4 && $student['total_absent'] <= 10)
                                        @foreach (array_slice($selectedSubjects[$groupKey], 0, 5) as $subject)
                                            <input type="text" class="subject-score" autocomplete="off"
                                                name="scores[{{ $subject }}]" placeholder="{{ $subject }}">
                                        @endforeach
                                    @else
                                        <span class="text-danger">ត្រួតថ្នាក់</span>
                                    @endif
                                </td>
                                <td class="total-score text-center">0</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="print-content d-none"></div>

    <div class="modal fade" id="ModelPrint" tabindex="-1" role="dialog" aria-labelledby="ModelPrints" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-m-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <div class="modal-body">
                    <h4 class="modal-confirmation-text text-center p-4">
                        Do you want to print ?
                    </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="ClosePrintModal">Close</button>
                    <button type="button" id="YesPrints" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/printthis@1.15.0/printThis.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on('input', '.subject-score', function() {
        let val = $(this).val().trim();

        if (val === '') {
            updateTotal($(this).closest('tr'));
            return;
        }

        let number = parseFloat(val);
        if (!isNaN(number)) {
            if (number > 55) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Score!',
                    text: 'ពិន្ទុមិនអាចធំជាង 55 ទេ!',
                    confirmButtonText: 'OK'
                });
                $(this).val('');
            }
        } else {
            $(this).val('');
            number = 0;
        }

        updateTotal($(this).closest('tr'));
    });

    function updateTotal($row) {
        let total = 0;

        $row.find('.subject-score').each(function() {
            let val = $(this).val().trim();
            if (!isNaN(val) && val !== '') {
                total += parseFloat(val);
            }
        });

        $row.find('.total-score').text(total);
    }
    $(document).ready(function() {

        function updateMasterCheckboxes() {
            const totalPresent = $('.present-checkbox').length;
            const checkedPresent = $('.present-checkbox:checked').length;

            const totalAbsent = $('.absent-checkbox').length;
            const checkedAbsent = $('.absent-checkbox:checked').length;

            $('#checkAllPresent').prop('checked', totalPresent === checkedPresent);
            $('#checkAllAbsent').prop('checked', totalAbsent === checkedAbsent);
        }

        // Master checkbox for Present
        $('#checkAllPresent').on('change', function() {
            const isChecked = $(this).is(':checked');
            $('.present-checkbox').prop('checked', isChecked).trigger('change');

            if (isChecked) {
                $('.absent-checkbox').prop('checked', false).trigger('change');
                $('#checkAllAbsent').prop('checked', false);
            }
        });

        // Master checkbox for Absent
        $('#checkAllAbsent').on('change', function() {
            const isChecked = $(this).is(':checked');
            $('.absent-checkbox').prop('checked', isChecked).trigger('change');

            if (isChecked) {
                $('.present-checkbox').prop('checked', false).trigger('change');
                $('#checkAllPresent').prop('checked', false);
            }
        });

        // When Present checkbox changes
        $(document).on('change', '.present-checkbox', function() {
            const index = $(this).attr('id').split('_')[1];
            const $absentCheckbox = $('#no_' + index);
            const $row = $(this).closest('tr');

            if ($(this).is(':checked')) {
                $absentCheckbox.prop('checked', false);
                $row.css({
                    'background-color': '',
                    'color': ''
                });
                $row.find('input, select, textarea, button').prop('disabled', false);
            } else {
                if (!$absentCheckbox.is(':checked')) {
                    $row.css({
                        'background-color': '',
                        'color': ''
                    });
                    $row.find('input, select, textarea, button').prop('disabled', false);
                }
            }

            updateMasterCheckboxes();
        });

        // When Absent checkbox changes
        $(document).on('change', '.absent-checkbox', function() {
            const index = $(this).attr('id').split('_')[1];
            const $presentCheckbox = $('#yes_' + index);
            const $row = $(this).closest('tr');

            if ($(this).is(':checked')) {
                $presentCheckbox.prop('checked', false);
                $row.css({
                    'background-color': '#FFBEBE',
                    'color': '#ffffff'
                });
                $row.find('input, select, textarea, button')
                    .not($(this))
                    .not($presentCheckbox)
                    .prop('disabled', true);
                $presentCheckbox.prop('disabled', false);
            } else {
                if (!$presentCheckbox.is(':checked')) {
                    $row.css({
                        'background-color': '',
                        'color': ''
                    });
                    $row.find('input, select, textarea, button').prop('disabled', false);
                }
            }

            updateMasterCheckboxes();
        });
    });

    $(document).on('click', '#print-student-list', function() {
        let code = $(this).data('code') || '';
        $('#YesPrints').data('code', code);
        $('#ModelPrint').modal('show');
    });

    $(document).on('click', '#ClosePrintModal', function() {
        $('#ModelPrint').modal('hide');
    })

    $(document).on('click', '#YesPrints', function() {
        let code = $(this).data('code');
        let url = '/exam-credit/print-assign-score';
        let studentData = [];
        let hasZeroTotal = false;

        $('table tbody tr').each(function() {
            let $row = $(this);
            let isPresent = $row.find('.present-checkbox').is(':checked');

            if (!isPresent) return;

            let totalScore = parseFloat($row.find('.total-score').text().trim());

            if (totalScore === 0) {
                hasZeroTotal = true;
            }

            studentData.push({
                name: $row.find('td').eq(2).text().trim(),
                gender: $row.find('td').eq(3).text().trim(),
                class_code: $row.find('td').eq(4).text().trim(),
                year_semester: $row.find('td').eq(5).text().trim(),
                total: totalScore
            });
        });

        if (hasZeroTotal) {
            Swal.fire({
                icon: 'warning',
                title: 'សូមបញ្ចូលពិន្ទុ',
                text: 'សូមពិនិត្យពិន្ទុសរុបមុនពេលបោះពុម្ព!',
                confirmButtonText: 'យល់ព្រម'
            });
            return;
        }

        if (studentData.length === 0) {
            Swal.fire('ព័ត៌មាន', 'គ្មាននិស្សិតដែលមានវត្តមានសម្រាប់បោះពុម្ពទេ។', 'info');
            return;
        }

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                students: studentData,
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
                            afterPrint: function() {
                                window.location.href =
                                    '/exam-credit/exam-student-list';
                            }
                        });
                    }, 1500);
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

    function DownloadExcel() {
        let studentData = [];
        let hasZeroTotal = false;

        $('table tbody tr').each(function() {
            let $row = $(this);
            let isPresent = $row.find('.present-checkbox').is(':checked');

            if (!isPresent) return;

            let totalScore = parseFloat($row.find('td').eq(7).text().trim()) || 0;

            if (totalScore === 0) {
                hasZeroTotal = true;
            }

            studentData.push({
                name: $row.find('td').eq(2).text().trim(),
                gender: $row.find('td').eq(3).text().trim(),
                class_code: $row.find('td').eq(4).text().trim(),
                year_semester: $row.find('td').eq(5).text().trim(),
                total: totalScore
            });
        });

        if (studentData.length === 0) {
            Swal.fire('ព័ត៌មាន', 'គ្មាននិស្សិតដែលមានវត្តមានសម្រាប់បោះពុម្ពទេ។', 'info');
            return;
        }

        if (hasZeroTotal) {
            Swal.fire({
                icon: 'warning',
                title: 'សូមបញ្ចូលពិន្ទុ',
                text: 'សូមពិនិត្យពិន្ទុសរុបមុនពេលបោះពុម្ព!',
                confirmButtonText: 'យល់ព្រម'
            });
            return;
        }

        $.ajax({
            url: '/exam-credit/assign-score/export-excel',
            method: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({
                students: studentData
            }),
            xhrFields: {
                responseType: 'blob'
            },
            success: function(blob, status, xhr) {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const day = String(now.getDate()).padStart(2, '0');
                const filename = `តារាងពិន្ទុប្រឡងក្រេឌីត_${day}_${month}_${year}.xlsx`;

                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            },
            error: function() {
                $('.loader').hide();
                notyf.error("Request failed.");
            }
        });
    }
</script>
