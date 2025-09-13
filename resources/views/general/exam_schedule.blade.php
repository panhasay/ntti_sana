@extends('app_layout.app_layout')
@section('content')
    <div class="page-head page-head-custom">
        <div class="row">
            <div class="col-md-6 col-sm-6  col-6">
                <div class="page-title page-title-custom">
                    <div class="title-page">
                        <i class="mdi mdi-format-list-bulleted"></i>
                        តារាងបែងចែក ការប្រឡង
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-6">
                <div class="page-title page-title-custom text-right">
                    <h4 class="text-right">
                        <a id="btnShowMenuSetting" href="javascript:;"><i class="mdi mdi-settings"></i></a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="page-header flex-wrap">
        <div class="header-left">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate"
                href="{{ url('exam-schedule/transaction/?type=cr') }}"><i class="mdi mdi-account-plus"></i> បន្ថែមថ្មី</i></a>


            <button type="button" id="prints" class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2">Print
                Selected<i class="mdi mdi-printer btn-icon-append"></i></button>

            <!-- Modal for Print Confirmation -->
            <div class="modal fade" id="ModelPrints" tabindex="-1" role="dialog" aria-labelledby="ModelPrints"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-m-header">
                            <h5 class="modal-title" id="divConfirmation">បោះពុម្ពកាលវិភាគប្រឡង</h5>
                        </div>
                        <div class="modal-body">
                            <h4 class="modal-confirmation-text text-center p-4 khmer_os_b">
                                តើចង់បោះពុម្ពកាលវិភាគប្រឡងដែលបានជ្រើសរើសមែនទេ?</h4>
                            <div class="form-group px-3">
                                <div class="input-group">

                                    <input type="text" class="form-control form-control-lg khmer_os_b"
                                        name="date_khmer_multiple" placeholder="បញ្ចូលថ្ងៃ ខែ ឆ្នាំប្រឡង"
                                        style="font-size: 1rem;">
                                </div>
                                <small class="text-muted mt-4 d-block khmer_os_b">
                                    <i class="mdi mdi-information-outline"></i>
                                    ឧទាហរណ៍៖ ថ្ងៃទី១៥ ខែមករា ឆ្នាំ២០២៤
                                </small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnClose" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" id="YesPrints" class="btn btn-primary">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden div to store printable content -->
            <div class="print-content d-none">

            </div>

            <button type="button" onclick="DownlaodExcel()"
                class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
                    class="mdi mdi-printer btn-icon-append"></i> </button>
        </div>
        <div class="d-grid d-md-flex justify-content-md-end p-3">
            <input type="text" class="form-control mb-2 mb-md-0 me-2" id="search_data" data-page="{{ $page ?? '' }}"
                name="search_data" placeholder="Serch...." aria-label="Recipient's username"
                aria-describedby="basic-addon2">
            <div>
            </div>
            <a class="btn btn-primary mb-2 mb-md-0 me-2" data-toggle="collapse" href="#Fliter" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                Fliter
            </a>
        </div>
    </div>
    <div class="collapse" id="Fliter">
        <div class="card card-body">
            <form id="advance_search" role="form" class="form-horizontal" enctype="multipart/form-data" action="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <span class="labels">លេខកូដ</span>
                                <input type="text" class="form-control form-control-sm" id="code" name="code"
                                    value="" placeholder="លេខកូដ" aria-label="លេខកូដ">
                            </div>
                            <div class="col-sm-3">
                                <span class="labels">ដេប៉ាតឺម៉ង់</span>
                                <input type="text" class="form-control form-control-sm" id="name" name="name"
                                    value="" placeholder="ដេប៉ាតឺម៉ង់" aria-label="ដេប៉ាតឺម៉ង់">
                            </div>
                            <div class="col-sm-3">
                                <span class="labels">Department</span>
                                <input type="text" class="form-control form-control-sm" id="name_2" name="name_2"
                                    value="" placeholder="Department" aria-label="Department">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary text-white" data-page="department"
                            id="btn-adSearch">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="print" style="display: none">
        <div class="print-content">

        </div>
    </div>
    @include('system.modal_comfrim_delet')
    @include('general.exam_schedule_lists')
    <script>
     

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



        $(document).on('click', '#prints', function() {
            // Open modal for confirmation
            $('#ModelPrints').modal('show');
        });

        $(document).on('click', '#YesPrints', function() {
            let selectedIds = [];
            $('.print-checkbox:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length === 0) {
                notyf.error("សូមជ្រើសរើសយ៉ាងហោចណាស់មួយដើម្បីបោះពុម្ព");
                return;
            }

            // Get the Khmer date value
            let date_khmer_multiple = $('input[name="date_khmer_multiple"]').val();

            // First save the Khmer date
            $.ajax({
                type: 'POST',
                url: '/save-exam-date-khmer-multiple',
                data: {
                    examScheduleIds: selectedIds,
                    date_khmer_multiple: date_khmer_multiple,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // After saving the date, proceed with printing
                        printExamSchedules(selectedIds);
                    } else {
                        alert("Error: " + response.msg);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.error("AJAX Error:", xhr.responseText);
                    alert("Error occurred while saving date. Please try again.");
                }
            });
        });

        function printExamSchedules(selectedIds) {
            $.ajax({
                type: 'POST',
                url: '/exam-schedule-print-multiple',
                data: {
                    examScheduleIds: selectedIds,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('.loader').show();
                    $('#YesPrints').prop('disabled', true);
                },
                success: function(response) {
                    $('.loader').hide();
                    if (response.status === 'success') {
                        $('.print-content').html(response.html);
                        $('.print-content').printThis({
                            importCSS: true,
                            importStyle: true,
                            removeInline: false,
                            printDelay: 333,
                            header: null,
                            footer: null,
                            base: false,
                            formValues: true
                        });
                        $('#ModelPrints').modal('hide');
                    } else {
                        alert("Error: " + response.msg);
                    }
                    $('#YesPrints').prop('disabled', false);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.loader').hide();
                    console.error("AJAX Error:", xhr.responseText);
                    alert("Error occurred. Please try again.");
                    $('#YesPrints').prop('disabled', false);
                }
            });
        }
    </script>
@endsection
