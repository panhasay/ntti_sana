@extends('app_layout.app_layout')

@section('content')
    {{-- Meta for AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="page-head page-head-custom">
        <div class="row">

            <div class="col-md-6 col-sm-6 col-6">
                <div class="page-title page-title-custom text-right">
                    <h4 class="text-right"></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="page-header flex-wrap">
        <div class="header-left">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate"
                href="{{ url('classes/transaction/?type=cr') }}">
                <i class="mdi mdi-account-plus"></i> បន្ថែមថ្មី
            </a>
        </div>
        <div class="d-grid d-md-flex justify-content-md-end p-3">
            <a class="btn btn-primary mb-2 mb-md-0 me-2" data-toggle="collapse" href="#Fliter" role="button"
                aria-expanded="false" aria-controls="Fliter">
                Filter
            </a>
        </div>
    </div>

    <div class="collapse" id="Fliter">
        <div class="card card-body">
            @include('system.option_advance_search_class_schedule', ['page_name' => 'Certificate-Degree'])
        </div>
    </div>

    {{-- Confirmation Modal --}}
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
                    <button type="button" id="YesPrints" data-code="" data-id="" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Hidden Print Area --}}
    <div class="print" style="display: none">
        <div class="print-content"></div>
    </div>

    {{-- Preview Modal --}}
    <div class="modal fade" id="ModalPriviewCertificate" tabindex="-1" aria-labelledby="ModalTeacherSchedule"
        aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1000ch">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark title-modal">កែសម្រួល ព័ត៌មានបោះពុម្ព</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បិទ</button>
                    <button type="button" data-id="" class="btn btn-primary" id="SaveTeacherSchedule">រក្សាទុក</button>
                </div>
            </div>
        </div>
    </div>

    @include('certificate.certificate_degree_lists')

    <script>
        $(function() {
            // Handle print click
            $("#certificateLink").on('click', function() {
                var selectedIds = $(".certificate-checkbox:checked").map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length === 0) {
                    alert("សូមជ្រើសរើសយ៉ាងហោចណាស់មួយ (Please select at least one)");
                    return;
                }

                var url = "/certificate/certificate/degree-temporary-multi?ids=" + selectedIds.join(",");
                window.open(url, '_blank');
            });

            // Handle select all checkbox
            $("#flexCheckDefault").on('change', function() {
                $(".certificate-checkbox").prop('checked', $(this).is(':checked'));
            });
        });


        function prints(ctrl) {
            var data = $("#advance_search").serialize();
            $.ajax({
                type: 'get',
                url: 'departments/print',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(response) {
                    $('.loader').hide();
                    $('.print-content').html(response);
                    $('.print-content').printThis({});
                }
            });
        }
    </script>
@endsection
