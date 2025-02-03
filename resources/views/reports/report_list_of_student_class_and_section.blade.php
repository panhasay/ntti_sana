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
        <div class="page-header flex-wrap">
            <div class="header-left">
                <button data-page="student" id="btn-priview" type="button"
                    class="btn btn-outline-primary btn-icon-text btn-sm">
                    <i class="mdi mdi-eye"></i> Priview </button>
                <button type="button" onclick="prints()"
                    class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2"> Print
                    <i class="mdi mdi-printer btn-icon-append"></i>
                </button><button type="button" id="BtnDownlaodExcel"
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
        <div class="collapse " id="Fliter" style="">
            <div class="card card-body">
                <form id="advance_search" role="form" class="form-horizontal" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <span class="labels">ដេប៉ាតឺម៉ង់</span>
                                    <select class="js-example-basic-single FieldRequired select2-hidden-accessible"
                                        id="department_code" name="department_code" style="width: 100%;"
                                        data-select2-id="department_code" tabindex="-1" aria-hidden="true">
                                        <option value="" data-select2-id="2">&nbsp;</option>
                                        <option value="D_CL">
                                            ដេប៉ាតឺម៉ង់វិស្វកម្មសំណង់ស៊ីវិល
                                        </option>
                                        <option value="D_EL">
                                            ដេប៉ាតឺម៉ង់វិស្វកម្មអគ្គិសនី និងអេឡិចត្រូនិច
                                        </option>
                                        <option value="D_IT">
                                            ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា
                                        </option>
                                        <option value="D_CD">
                                            ផ្នែកអភិវឌ្ឍន៍កម្មវិធីសិក្សា
                                        </option>
                                        <option value="D_AF">
                                            ផ្នែករដ្ឋបាល និងហិរញ្ញវត្ថុ
                                        </option>
                                        <option value="D_AC_R_D">
                                            ផ្នែកអភិវឌ្ឍន៍ធនធានសិក្សា
                                        </option>
                                        <option value="D_RE_P">
                                            ដេប៉ាតឺម៉ង់ស្រាវជ្រាវ និងស្ថិតិផែនការ
                                        </option>
                                        <option value="D_S_EN">
                                            ដេប៉ាតឺម៉ង់វិទ្យាសាស្ត្រអប់រំបណ្តុះបណ្តាលបច្ចេកទេស និងវិជ្ជាជីវៈ
                                        </option>
                                        <option value="D_TL">
                                            ផ្នែកបច្ចេកទេស
                                        </option>
                                    </select><span class="select2 select2-container select2-container--default"
                                        dir="ltr" data-select2-id="1" style="width: 100%;"><span class="selection">
                                            <span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>

                                <div class="col-sm-3">
                                    <span class="labels">ជំនាញ</span>
                                    <select class="js-example-basic-single FieldRequired select2-hidden-accessible"
                                        id="skills_code" name="skills_code" style="width: 100%;"
                                        data-select2-id="skills_code" tabindex="-1" aria-hidden="true">
                                        <option value="" data-select2-id="4">&nbsp;</option>
                                        <option value="IT">
                                            IT - ព័ត៌មានវិទ្យា
                                        </option>
                                        <option value="CL">
                                            CL - សំណង់ស៊ីវិល
                                        </option>
                                        <option value="AC">
                                            AC - ស្ថាបត្យកម្ម
                                        </option>
                                        <option value="ET">
                                            ET - អគ្គិសនី
                                        </option>
                                        <option value="EL">
                                            EL - អេឡិចត្រូនិច
                                        </option>
                                        <option value="MEL">
                                            MEL - មេកាត្រូនិច
                                        </option>
                                        <option value="AIR">
                                            AIR - បរិក្ខារត្រជាក់
                                        </option>
                                    </select><span class="select2 select2-container select2-container--default"
                                        dir="ltr" data-select2-id="3" style="width: 100%;"><span class="selection"><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>


                                <div class="col-sm-3">
                                    <span class="labels">វេន</span>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single FieldRequired select2-hidden-accessible"
                                            id="sections_code" name="sections_code" style="width: 100%;"
                                            data-select2-id="sections_code" tabindex="-1" aria-hidden="true">
                                            <option value="" data-select2-id="6">&nbsp;</option>
                                            <option value="A">
                                                A - រសៀល
                                            </option>
                                            <option value="M">
                                                M - ព្រឹក
                                            </option>
                                            <option value="N">
                                                N - យប់
                                            </option>
                                        </select><span class="select2 select2-container select2-container--default"
                                            dir="ltr" data-select2-id="5" style="width: 100%;"><span
                                                class="selection"><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <span class="labels col-sm-3 col-form-label text-end">កម្រិត<strong
                                            style="color:red; font-size:15px;"> *</strong></span>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single select2-hidden-accessible" id="level"
                                            name="level" style="width: 100%;" data-select2-id="level" tabindex="-1"
                                            aria-hidden="true">
                                            <option value="" data-select2-id="8">&nbsp;</option>
                                            <option value="បរិញ្ញាបត្រ">
                                                បរិញ្ញាបត្រ
                                            </option>
                                            <option value="បរិញ្ញាបត្ររង">
                                                បរិញ្ញាបត្ររង
                                            </option>
                                            <option value="អនុបណ្ឌិត">
                                                អនុបណ្ឌិត
                                            </option>
                                            <option value="សញ្ញាបត្រC1">
                                                សញ្ញាបត្រC1
                                            </option>
                                            <option value="សញ្ញាបត្រC2">
                                                សញ្ញាបត្រC2
                                            </option>
                                            <option value="សញ្ញាបត្រC3">
                                                សញ្ញាបត្រC3
                                            </option>
                                            <option value="បន្តបរិញ្ញាបត្របច្ចេកវីទ្យា">
                                                បន្តបរិញ្ញាបត្របច្ចេកវីទ្យា
                                            </option>
                                        </select><span class="select2 select2-container select2-container--default"
                                            dir="ltr" data-select2-id="7" style="width: 100%;"><span
                                                class="selection"><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary text-white" data-page="class-new"
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
        </div><br>
        <!-- tabal report -->
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
            $(document).on('click', '#btnDelete', function() {
                $(".modal-confirmation-text").html('Do you want to delete?');
                $("#btnYes").attr('data-code', $(this).attr('data-code'));
                $("#divConfirmation").modal('show');
            });
            $(document).on('click', '#btnYes', function() {
                var code = $(this).attr('data-code');
                $.ajax({
                    type: "POST",
                    url: `/classes-delete`,
                    data: {
                        code: code
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $("#divConfirmation").modal('hide');
                            $("#row" + code).remove();
                            notyf.success(response.msg);
                        }
                    }
                });
            });
        });

        function prints(ctrl) {
            var url = 'departments/print';
            var data = '';
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
                    $('.loader').hide();
                    $('.print-content').html(response);
                    $('.print-content').printThis({});
                },
                error: function(xhr, ajaxOptions, thrownError) {}
            });
        }

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
        </script>
</section>
@endsection