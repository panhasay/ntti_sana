<style>
     .page-header {
        padding: 1px !important;
        border-bottom: 1px solid #fff !important;
    }
</style>
@extends('app_layout.app_layout')
@section('content')
<section>
    <div class="content-wrapper pb-0">
        <div class="page-head page-head-custom">
            <div class="row">
                <div class="col-md-6 col-sm-6  col-6">
                    <div class="page-title page-title-custom">
                        <div class="title-page">
                            <i class="mdi mdi-format-list-bulleted"></i>
                            របាយការណ៍និស្សិត ក្រុម និងវេនសិក្សា
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
            <!--option--->
            <div class="page-header flex-wrap">
                <div class="header-left">
                <button data-page="student" id="btn-priview" type="button" class="btn btn-outline-primary btn-icon-text btn-sm">
                    <i class="mdi mdi-eye"></i> Priview </button>
                    <button type="button" id="prints" class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2">Print
                        <i class="mdi mdi-printer btn-icon-append"></i>
                    </button>
                    <button type="button" id="BtnDownlaodExcel"
                    class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
                        class="mdi mdi-printer btn-icon-append"></i> </button>
                </div>
                <div class="d-grid d-md-flex justify-content-md-end p-3">
                <div>
                </div>
                <a class="btn btn-primary mb-2 mb-md-0 me-2" data-toggle="collapse" href="#Fliter" role="button"
                    aria-expanded="true" aria-controls="collapseExample">
                    Fliter
                </a>
                </div>
            </div>
        @include("system.option_000020")
        <div class="print" style="display: none">
            <div class="print-content">

            </div>
        </div>
        <div class="modal fade" id="divConfirmation" tabindex="-1" role="dialog" aria-labelledby="divConfirmation"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-m-header">
                        <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="modal-confirmation-text text-center p-4"></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnClose" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="button" id="btnYes" data-code="" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- tabal report -->

        <!---PRINT--->
        <div class="modal fade" id="ModelPrints" tabindex="-1" role="dialog" aria-labelledby="ModelPrints" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-m-header">
                <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
                </div>
                <div class="modal-body">
                <h4 class="modal-confirmation-text text-center p-4"></h4>
                </div>
                <div class="modal-footer">
                <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="YesPrints" data-code="{{ $_GET['assing_no'] ?? '' }}" data-id=""
                    class="btn btn-primary">Yes</button>
                </div>
            </div>
            </div>
        </div>
        @include('reports.report_list_of_student_class_and_section_lists')        
        <br><br><br>
        <!-- End tabal report -->
        <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $(document).on('click', '#btn-priview', function() {
                let page = $(this).attr('data-page');
                let data = $('#advance_search').serialize();
                $.ajax({
                    type: "GET",
                    url: '/report_list_of_student_class_and_section-priview?type=priview',
                    data: data,
                    beforeSend: function() {
                    $('.loader').show();
                    },
                    success: function(response) {
                    if (response.status == 'success') {
                        $('.loader').hide();
                        $('.control-table').html("");
                        $('.control-table').html(response.view);
                        $('.collapse').removeClass('show')
                    } else {
                        $('.loader').hide();
                        notyf.error("Error: " + response.msg);
                    }
                    },
                    error: function() { // Corrected error handling
                    notyf.success("An error occurred during the request.");
                    $('.loader').hide();
                    }
                });
            });
            $(document).on('click', '#prints', function() {
                $(".modal-confirmation-text").html('Do you want to Downlaod prints ?');
                $("#YesPrints").attr('data-code', $(this).attr('data-type'));
                $("#ModelPrints").modal('show');
            });
            $(document).on('click', '#YesPrints', function() {
                var url = '/report_list_of_student_class_and_section-priview?type=is_print';
                data = $("#advance_search").serialize();
                $.ajax({
                    type: 'get',
                    url: url,
                    data: data,
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                    $('.loader').show();
                    },
                    success: function(response) {
                    if (response.status != 'success') {
                        $('.loader').hide();
                        $('.print-content').printThis({});
                        $('.print-content').html(response);
                        $('#ModelPrints').modal('hide');
                    } else {
                        $('.loader').hide();
                        notyf.error("Error: " + response.msg);
                    }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {}
                });
            });
        });
       
        </script>
</section>
@endsection