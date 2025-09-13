@extends('app_layout.app_layout')
@section('content')
    <style>
        table th,
        table td {
            padding: 12px !important;
            background-color: transparent !important;
            border: solid 1px #333 !important;
        }

        .margin-bottom {
            margin-bottom: 60px !important;
        }

        .marginTop {
            margin-top: 12rem !important;
        }
    </style>
    @php
        $currentMonth = now()->month;
    @endphp
    <div class="margin-bottom">
        @if (
            $attendanceMonths->isEmpty() ||
                ($attendanceMonths->first()->start_day === null && $attendanceMonths->first()->end_day === null))
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
        @else
            <div class="page-head page-head-custom">
                <div class="row">
                    <div class="col-md-6 col-sm-6  col-6">
                        <div class="page-title page-title-custom">
                            <div class="title-page">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                បញ្ជីសរុបវត្តមានប្រចាំខែ
                                {{ \App\Service\Service::getMonthKhmer((int) $currentMonth - 1) }}
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
            <div class="page-header flex-wrap py-3  ">
                <div class="header-left">
                    <button type="button" id="print-attendance-list" data-code="{{ $_GET['class_code'] ?? '' }}"
                        class="btn btn-outline-info btn-sm">
                        Print <i class="mdi mdi-printer"></i>
                    </button>
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#confirmDownloadModal">
                        Excel <i class="mdi mdi-printer btn-icon-append"></i>
                    </button>
                </div>
                <div class="d-grid d-md-flex justify-content-md-end p-3">
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="4" width="40" class="text-center fw-bolder">ល.រ</th>
                        <th rowspan="4" width="200" class="text-center fw-bolder">គោត្តនាម-នាម</th>
                        @foreach ($attendanceMonths as $month)
                            <th class="text-center fw-bolder" colspan="2" width="120">
                                ខែ {{ \App\Service\Service::getMonthKhmer((int) $month->att_month - 1) }}
                                ថ្ងៃទី {{ \App\Service\Service::convertToKhmerNumerals((int) $month->start_day) }}
                                ដល់ថ្ងៃទី
                                {{ \App\Service\Service::convertToKhmerNumerals((int) $month->end_day) }}
                            </th>
                        @endforeach
                        <th colspan="2" class="text-center fw-bolder" width="">សរុប</th>
                    </tr>
                    <tr>
                        @for ($i = 0; $i < count($attendanceMonths); $i++)
                            <th class="text-center fw-bold">ឥ.ច</th>
                            <th class="text-center fw-bold">ម.ច</th>
                        @endfor
                        <th class="text-center fw-bold">ឥ.ច</th>
                        <th class="text-center fw-bold">ម.ច</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($uniqueStudents as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="{{ $record->gender == 'ស្រី' ? 'fw-bold' : '' }}">
                                {{ $record->name_2 ?? '' }}
                            </td>
                            @php
                                $total_absent = 0;
                                $total_permission = 0;
                            @endphp
                            @foreach ($attendanceMonths as $month)
                                @php
                                    $matchingRecords = $records->filter(function ($item) use ($record, $month) {
                                        return $item->code === $record->code &&
                                            $item->att_month === $month->att_month &&
                                            $item->att_year === $month->att_year;
                                    });

                                    $absent = $matchingRecords->sum('total_absent');
                                    $permission = $matchingRecords->sum('total_permission');

                                    $total_absent += $absent;
                                    $total_permission += $permission;
                                @endphp
                                <td class="text-center">{{ $absent }}</td>
                                <td class="text-center">{{ $permission }}</td>
                            @endforeach
                            <td class="{{ $total_absent > 15 ? 'bg-danger text-white' : '' }} text-center">
                                {{ $total_absent }}</td>
                            <td class="text-center">{{ $total_permission }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
    <div class="print-content d-none"></div>
    <!-- Modal Confirmation -->
    <div class="modal fade" id="ModelPrints" tabindex="-1" role="dialog" aria-labelledby="ModelPrints" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-m-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <div class="modal-body">
                    <h4 class="modal-confirmation-text text-center p-4"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="ClosePrintModal">Close</button>
                    <button type="button" id="YesPrints" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- excel download --}}
    <div class="modal fade" id="confirmDownloadModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-m-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <div class="modal-body text-center p-4">
                    <h4>Do you want to download Excel?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btnConfirmDownload" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/printthis@1.15.0/printThis.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function getUrlParameter(name) {
        let url = window.location.href;
        name = name.replace(/[[]/, '\\[').replace(/[\]]/, '\\]');
        let regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        let results = regex.exec(url);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    $(document).on('click', '#print-attendance-list', function() {
        let code = $(this).data('code');
        $(".modal-confirmation-text").text('Do you want to download and print?');
        $("#YesPrints").data('code', code);
        $("#ModelPrints").modal('show');
    });

    $(document).on('click', '#ClosePrintModal', function() {
        $('#ModelPrints').modal('hide');
    });

    $(document).on('click', '#YesPrints', function() {
        let classCode = $(this).data('code');
        let semester = getUrlParameter('semester');
        let years = getUrlParameter('years');

        let url = '/exam-credit/print-attendance-list-monthly?' +
            'class_code=' + encodeURIComponent(classCode) +
            '&semester=' + encodeURIComponent(semester) +
            '&years=' + encodeURIComponent(years);

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
                $('#ModelPrints').modal('hide');
                if (response.status === 'success') {
                    $('.print-content').html(response.html).removeClass('d-none');
                    setTimeout(function() {
                        $('.print-content').printThis({
                            afterPrint: function() {
                                location.reload();
                            }
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
    
    $(document).ready(function() {
        const downloadUrl =
            "/exam-credit/attendance-monthly/download-excel?class_code={{ $classCode }}&semester={{ $semester }}&years={{ $years }}&att_year={{ now()->year }}&att_month={{ now()->month }}";

        $('#btnConfirmDownload').on('click', function() {
            const modalEl = document.getElementById('confirmDownloadModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            modalInstance.hide();
            setTimeout(() => {
                window.location.href = downloadUrl;
            }, 300);
        });
    });
</script>
