@extends('app_layout.app_layout')

@section('content')
    <style>
        .table th:nth-child(1),
        .table td:nth-child(1) {
            width: 5%;
        }

        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 15%;
        }

        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 10%;
        }

        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 10%;
        }

        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 20%;
        }

        .table th:nth-child(6),
        .table td:nth-child(6) {
            width: 35%;
        }

        .table th:nth-child(7),
        .table td:nth-child(7) {
            width: 20%;
        }

        .table th:nth-child(8),
        .table td:nth-child(8) {
            width: 20%;
        }

        .table-responsive {
            margin-bottom: 4rem;
        }
    </style>
    <div class="mt-3">
        <div class="page-head page-head-custom">
            <div class="row">
                <div class="col-md-6 col-sm-6  col-6">
                    <div class="page-title page-title-custom">
                        <div class="title-page">
                            <i class="mdi mdi-format-list-bulleted"></i>
                            បញ្ជីរាយនាមនិស្សិតប្រឡងសង
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="page-title page-title-custom text-right">
                        <h4 class="text-right">
                            <a href="{{ url('department-menu') }}"><i class="mdi mdi-keyboard-return"></i></a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header flex-wrap">
            <div class="header-left">
                {{-- <a href="{{ url('exam-credit/exam-student-list') }}" class="btn btn-sm btn-success">
                    ប្រឡងក្រេឌីត
                </a> --}}
                <button type="button" id="print-attendance-list" class="btn btn-outline-info btn-sm">
                    Print <i class="mdi mdi-printer"></i>
                </button>
                <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#confirmDownloadModal">
                    Excel <i class="mdi mdi-file-excel"></i>
                </button>

            </div>
            <div class="d-grid d-md-flex justify-content-md-end p-3">
                <input type="text" id="search_data_attendance" autocomplete="off" class="form-control me-2"
                    placeholder="ស្វែងរក...">
                {{-- <a class="btn btn-primary mb-2 mb-md-0 me-2" data-toggle="collapse" href="#Fliter" role="button"
                    aria-expanded="false" aria-controls="collapseExample">
                    Fliter
                </a> --}}
            </div>
        </div>
        <div class="table-responsive">
            @if ($studentsByClass->isNotEmpty())
                <table class="table" style="table-layout: fixed; width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">ល.រ</th>
                            <th class="text-center">គោតនាម-នាម</th>
                            <th class="text-center">ភេទ</th>
                            <th class="text-center">ឆ្នាំសិក្សា</th>
                            <th class="text-center">ក្រុម</th>
                            <th class="text-center">ចំនួនមុខវិជ្ជា</th>
                            <th class="text-center">មធ្យមភាគ</th>
                        </tr>
                    </thead>
                    <tbody id="studentsTableBody">
                        @include('general.retake_exam_record', [
                            'studentsByClass' => $studentsByClass,
                        ])
                    </tbody>
                </table>
            @else
                <p class="text-center py-5">No students with average &lt; 50.</p>
            @endif
        </div>
    </div>

    <div class="modal fade" id="ModelPrints" tabindex="-1" role="dialog" aria-labelledby="ModelPrints" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-m-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <div class="modal-body">
                    <h4 class="modal-confirmation-text text-center p-4">
                        Do you want to download and print?
                    </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="ClosePrintModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="YesPrints">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmDownloadModal" aria-labelledby="confirmDownloadModalLabel" tabindex="-1"
        role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-m-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <div class="modal-body">
                    <h4 class="modal-confirmation-text text-center p-4">
                        Do you want to download and print?
                    </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="ClosePrintModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmExportYes">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="print-content d-none"></div>
    <script>
        const searchInput = document.getElementById('search_data_attendance');

        searchInput.addEventListener('keyup', function() {
            let query = this.value;

            fetch("{{ route('retake.exam.live.search') }}?search=" + query)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('studentsTableBody').innerHTML = data;
                });
        });

        // When clicking the trigger button
        $(document).on('click', '#print-attendance-list', function() {
            $(".modal-confirmation-text").text('Do you want to download and print all classes?');
            $("#ModelPrints").modal('show');
        });

        $(document).on('click', '#YesPrints', function() {
            $.ajax({
                type: 'POST',
                url: "{{ route('retake.exam.print.ajax') }}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(response) {
                    $('.loader').hide();
                    if (response.status === 'success') {
                        $('#ModelPrints').modal('hide'); // 👈 close modal here
                        $('.print-content').html(response.html).removeClass('d-none');
                        setTimeout(function() {
                            $('.print-content').printThis({
                                afterPrint: function() {
                                    $('.print-content').html('').addClass('d-none');
                                }
                            });
                        }, 300);
                    } else {
                        alert("Error: " + (response.msg || 'Unexpected error.'));
                    }
                },
                error: function() {
                    $('.loader').hide();
                    alert("Request failed.");
                }
            });
        });

        $(document).on('click', '#confirmExportYes', function() {
            $('#confirmDownloadModal').modal('hide');
            window.location.href = "{{ route('retake.exam.export') }}";
        });
    </script>
@endsection
