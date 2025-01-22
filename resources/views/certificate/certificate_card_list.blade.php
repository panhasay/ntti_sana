<style>
    body {
        font-family: "Khmer OS Battambang", Tahoma, sans-serif !important;
    }

    table>thead>tr>th {
        font-family: "Khmer OS Battambang", Tahoma, sans-serif !important;
    }

    .text-white {
        font-family: "Khmer OS Battambang", Tahoma, sans-serif !important;
    }

    .form-group label {
        font-family: "Khmer OS Battambang", Tahoma, sans-serif !important;
    }


    .card.card-outline-tabs {
        border-top: 0;
    }

    .card-outline-tabs>.card-header {
        background: #2194ce !important;
    }

    .card-outline-tabs>.card-header>.nav-tabs>.nav-item>a {
        color: black !important;
    }

    .card-outline-tabs>.card-header>.nav-tabs .nav-link {
        border-top-left-radius: 0rem !important;
        border-top-right-radius: 0rem !important;
    }

    .nav-item .nav-link.active {
        background-color: #79c8f1 !important;
        color: #fff !important;
        font-weight: bold;
        border: 1px solid #0056b3;
    }


    .card {
        background: #f4f4f4 !important;
    }

    .student-card-view {
        max-width: 600px;
        margin: auto;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
    }

    .student-card-view img {
        object-fit: cover;
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
    }

    .student-card-view>.student-information {
        padding-top: 0px !important;
    }

    .student-card-view>.card-body {
        padding: 0px !important;
        padding-left: 15px !important;
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }

    .student-card-view>.card-body .name {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 0px;
    }

    .student-card-view>.card-body>.name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        width: 99%;
    }

    .student-card-view>.card-body .id,
    .card-body .phone,
    .card-body .info {
        font-size: 14px;
        margin-bottom: 0px;
    }
</style>

<style>
    .dropzone {
        border: 2px dashed #0d6efd;
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .dropzone.dragover {
        background-color: #e9f7fe;
    }

    .dropzone img {
        max-width: 100%;
        height: auto;
        margin-top: 15px;
    }
</style>
@extends('app_layout.app_layout')
@section('content')
    <x-breadcrumbs :array="[
        ['route' => request()->path(), 'title' => $arr_module[0]->name_kh],
        ['route' => 'certificate/dept-menu/' . $arr_dept[0]->code, 'title' => 'ត្រួតពិនិត្យលិខិតបញ្ជាក់'],
        ['route' => 'certificate/dept-menu', 'title' => $arr_dept[0]->name_2],
        ['route' => 'department-menu', 'title' => 'ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់'],
    ]" />

    <div class="row">
        <div class="page-header flex-wrap" style="border-bottom: 0px solid #dfdcdc;">
            <div class="header-left p-3">
                <button type="button" id="prints" class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2">Print
                    <i class="mdi mdi-printer btn-icon-append"></i>
                </button>
                <button type="button" class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2" name="btn_exel"
                    id="btn_exel">Excel <i class="mdi mdi-printer btn-icon-append"></i>
                </button>
            </div>
            <div class="d-grid d-md-flex justify-content-md-end p-3">
                <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-toggle="collapse"
                    href="#collapse_search" role="button" aria-expanded="false" aria-controls="collapseExample"
                    name="btn_filter" id="btn_filter">
                    Fliter <i class="mdi mdi-arrow-up-bold"></i>
                </a>
            </div>
        </div>
        <div class="collapse show" id="collapse_search">
            <div class="card card-body">
                <form id="fm_search_student" role="form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-sm-3" hidden>
                                    <span class="form-label">ដេប៉ាតឺម៉ង់</span>
                                    <div class="input-group">
                                        <select class="select2-search" id="sch_dept" name="sch_dept" style="width: 100%"
                                            placeholder="សូមជ្រើសរើសដេប៉ាតឺម៉ង់">
                                            <option value="">សូមជ្រើសរើសដេប៉ាតឺម៉ង់</option>
                                            @foreach ($record_dept as $item)
                                                <option value="{{ $item->code }}">{{ $item->name_2 }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <span class="form-label">ក្រុម</span>
                                    <div class="input-group">
                                        <select class="select2-search class_code" id="sch_class_spec" name="sch_class_spec"
                                            style="width: 100%" placeholder="សូមជ្រើសរើសក្រុម">
                                            <option value="">សូមជ្រើសរើសក្រុម</option>
                                            @foreach ($record_class as $item)
                                                <option value="{{ $item->code }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <span class="form-label">កម្រិត</span>
                                    <div class="input-group">
                                        <select class="select2-search sch_level" id="sch_level" name="sch_level"
                                            style="width: 100%">
                                            <option value="">សូមជ្រើសរើសកម្រិត</option>
                                            @foreach ($record_level as $item)
                                                <option value="{{ $item->level }}">{{ $item->level }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <span class="form-label">វេន</span>
                                    <div class="input-group">
                                        <select class="select2-search" id="sch_shift" name="sch_shift" style="width: 100%">
                                            <option value="">សូមជ្រើសរើសវេន</option>
                                            @foreach ($record_shift as $item)
                                                <option value="{{ $item->code }}">{{ $item->name_2 }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <span class="form-label">ជំនាញ</span>
                                    <div class="input-group">
                                        <select class="select2-search" id="sch_skill" name="sch_skill" style="width: 100%">
                                            <option value="">សូមជ្រើសរើសជំនាញ</option>
                                            @foreach ($record_skill as $item)
                                                <option value="{{ $item->code }}">{{ $item->name_2 }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="col-md-3 pull-left">
                                <input type="text" class="form-control mb-2 mb-md-0 me-2" name="sch_info_student"
                                    id="sch_info_student" placeholder="ស្វែងរក អត្តលេខ ឈ្មោះ">
                            </div>
                            <div class="row">
                                <div class="col-md-3 pull-left">
                                    <button type="button" class="btn btn-primary text-white" id="btn_search">ស្វែងរក
                                    </button>
                                    <button type="button" class="btn btn-primary text-white" data-toggle="modal"
                                        data-target="#modal_card_upload_zip_photo">Upload
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card card-primary card-outline card-outline-tabs" style="border-left: 0px">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item" style="border:1px">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                        href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                        aria-selected="false" style="font-family: 'Khmer OS Battambang', serif;"><i
                        class="mdi mdi-account-card-details"></i> Card View
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-card-list-tab" data-toggle="pill" href="#custom-tabs-card-list"
                        role="tab" aria-controls="custom-tabs-card-list" aria-selected="false"
                        style="font-family: 'Khmer OS Battambang', serif;"><i class="mdi mdi-format-list-bulleted"></i>
                        Card List
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                aria-labelledby="custom-tabs-four-home-tab">
                <div class="col-md-12">
                    <div class="row" id="tbl_stu_card_view">
                    </div>
                    <div id="pagination" class="mt-3"></div>
                </div>
            </div>

            <div class="tab-pane fade" id="custom-tabs-card-list" role="tabpanel"
                aria-labelledby="custom-tabs-card-list-tab">
                <div class="col-md-12">
                    <div class="row">
                        <div class="control-table table-responsive custom-data-table-wrapper2">
                            <div class="col-md-12 mt-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="general-data">
                                            <th>ល.រ</th>
                                            <th>អត្តលេខ</th>
                                            <th>គោត្តនាម និងនាម</th>
                                            <th>ឈ្មោះជាឡាតាំង</th>
                                            <th>ភេទ</th>
                                            <th>ថ្ងៃខែឆ្នាំកំណើត</th>
                                            <th>លេខទូរស័ព្ទ</th>
                                            <th>ក្រុម/ថ្នាក់</th>
                                            <th>ជំនាញ</th>
                                            <th>កម្រិត</th>
                                            <th>រូបភាព</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_card_stu_list">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="pagination_list" class="mt-3"></div>
                </div>
            </div>
        </div>
        <br><br>
        <!-- /.card -->
    </div>

    <x-modal-first id="modal_card_print_card" title="Confirmation">
        <input type="hidden" id="hidden_stu_code" name="stu_code">
        <input type="hidden" id="hidden_dept_code" name="dept_code">
        <input type="hidden" id="hidden_class_code" name="class_code">
        <h4 class="text-center p-4">Do you want to Downlaod prints ?</h4>
        <x-slot name="footer">
            <x-close-modal />
            <x-close-modal class="btn btn-primary" label="OK" btn="btn_print_card" />
        </x-slot>
    </x-modal-first>
    <x-modal-first id="modal_card_disable_active" title="Disable Active Print Card">
        <input type="hidden" id="hidden_disable_stu_code" name="stu_code">
        <input type="hidden" id="hidden_disable_dept_code" name="dept_code">
        <input type="hidden" id="hidden_diable_class_code" name="class_code">
        <h4 class="text-center p-4">Do you want to Disable Active Print ?</h4>
        <x-slot name="footer">
            <x-close-modal />
            <x-close-modal class="btn btn-primary" label="OK" btn="btn_card_disable_active" />
        </x-slot>
    </x-modal-first>
    <x-modal-first id="modal_card_update" title="កែប្រែកាលបរិច្ឆេទ" size="lg" centered="true" scrollable="true"
        fullscreen="true">
        <input type="hidden" id="hidden_update_stu_code" name="stu_code">
        <input type="hidden" id="hidden_update_dept_code" name="dept_code">
        <input type="hidden" id="hidden_update_class_code" name="class_code">
        <div class="row g-2">
            <div class="col-md-3 stretch-card">
                <div class="card profile-card text-center">
                    <div class="card-body position-relative">
                        <div class="profile-image position-relative d-inline-block" style="width: 172px;">
                            <img id="txt_photo_student" src="{{ asset('asset/NTTI/images/faces/default_User.jpg') }}"
                                height="120" width="120" alt="Profile Picture">
                            <input type="file" id="fileUploadProfileStu"
                                class="btn position-absolute top-0 start-0 opacity-0 w-100 h-100">
                            {{-- <button
                                class="btn btn-primary position-absolute top-0 end-0 translate-middle p-1 rounded-circle"
                                style="width: 40px; height: 40px;" id="uploadIcon" title="Upload Image">
                                <i class="bi bi-upload"></i>
                                <input type="file" id="fileUploadProfileStu"
                                    class="btn position-absolute top-0 start-0 opacity-0 w-100 h-100">
                            </button> --}}

                        </div>
                        <h5 class="card-title mt-3" id="txt_up_view_name"></h5>
                        <hr>
                        <div class="row">
                            <div class="col-6 text-left" style="text-align: left"><strong>អត្តលេខ:</strong>
                            </div>
                            <div class="col-6 text-right" id="txt_up_view_id"></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left" style="text-align: left"><strong>ក្រុម:</strong>
                            </div>
                            <div class="col-6 text-right" id="txt_up_view_class"></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left" style="text-align: left"><strong>ជំនាញ:</strong>
                            </div>
                            <div class="col-6 text-right" id="txt_up_view_skill"></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left" style="text-align: left"><strong>កម្រិត:</strong>
                            </div>
                            <div class="col-6 text-right" id="txt_up_view_level"></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left" style="text-align: left">
                                <strong>វេនសិក្សា:</strong>
                            </div>
                            <div class="col-6 text-right" id="txt_up_view_shift"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form id="fm_card_update_info" role="form" class="form-horizontal"
                            enctype="multipart/form-data" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <span class="form-label">កាលបរិច្ចេទ</span>
                                            <div class="input-group">
                                                <input type="date" class="form-control form-control-sm"
                                                    id="txt_up_date_card" name="txt_up_date_card"
                                                    value="{{ now()->format('Y-m-d') }}" placeholder="ថ្ងៃខែឆ្នាំកំណើត"
                                                    aria-label="ថ្ងៃខែឆ្នាំកំណើត">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <span class="form-label">កាលបរិច្ឆេទតាមច័ន្ទគតិខ្មែរ</span>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm"
                                                    id="txt_up_khmer_lunar" name="txt_up_khmer_lunar"
                                                    placeholder="កាលបរិច្ឆេទតាមច័ន្ទគតិខ្មែរ">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="form-label">កាលបរិច្ឆេទតាមសុរិយគតិខ្មែរ</span>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm"
                                                    id="txt_up_date_create" name="txt_up_date_create"
                                                    placeholder="កាលបរិច្ឆេទតាមសុរិយគតិខ្មែរ" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <x-close-modal />
            <x-close-modal class="btn btn-primary" label="OK" btn="btn_update_info" />
        </x-slot>
    </x-modal-first>
    <x-modal-first class="modal-select2" id="modal_card_upload_zip_photo" title="Upload Photo Multiple Option"
        size="lg" centered="true" scrollable="true" fullscreen="true">
        <div class="card-body">
            <form id="fm_up_card_base_option" role="form" class="form-horizontal" enctype="multipart/form-data"
                method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <span class="form-label">ជ្រើសរើសប្រភេទឯកសារ</span>
                                <div class="input-group">
                                    <select class="select2-sch-modal" id="up_type_option" name="up_type_option"
                                        style="width: 100%" placeholder="សូមជ្រើសរើសប្រភេទឯកសារ">
                                        <option value="">សូមជ្រើសរើសប្រភេទឯកសារ</option>
                                        <option value="zip" selected>File Zip</option>
                                        <option value="multiple">Multiple Photo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3" id="up_zip">
                                <label for="zipFile" class="form-label">Choose ZIP File</label>
                                <input type="file" class="form-control" id="zipFile" name="zip_file"
                                    accept=".zip" required style="height: 40px;">
                            </div>

                            <div id="up_multiple" hidden>
                                <form>
                                    <div id="dropzone" class="dropzone">
                                        <p class="mb-0">Drag & drop your photos here, or click to upload</p>
                                        <input type="file" id="fileInput" accept="image/*" multiple
                                            style="display: none;">
                                    </div>
                                    <div id="previewContainer" class="preview-container"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-slot name="footer">
            <x-close-modal />
            <x-button class="btn-primary" label="OK" btn="btn_upload_zip_photo" />
        </x-slot>
    </x-modal-first>

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
            <button type="button" id="YesPrints" data-class="" data-code="{{ $_GET['assing_no'] ?? '' }}" data-id=""
                class="btn btn-primary">Yes</button>
            </div>
        </div>
        </div>
    </div>
    <!---PRINT CONNECT--->
    <div class="print" style="display: none">
        <div class="print-content">
    
        </div>
    </div>
    <!-- Modal -->
    <script>
        const dept_code = @json(request()->route('dept_code'), JSON_THROW_ON_ERROR);
        // var dept_code = {{ $arr_dept[0]->code }};
    </script>

    <script>
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.getElementById('previewContainer');

        // Handle drag and drop events
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('dragover');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('dragover');

            const files = Array.from(e.dataTransfer.files);
            handleFiles(files);
        });

        // Handle click to open file input
        dropzone.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            const files = Array.from(fileInput.files);
            handleFiles(files);
        });

        // Display image previews
        function handleFiles(files) {
            files.forEach((file) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = "150px";
                        img.style.height = "200px";
                        img.style.objectFit = "cover";
                        img.style.borderRadius = "5px";
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // $(document).on('change.select2', '#sch_class_spec', function() {
        //     alert('Hello');
        // });

        $(document).ready(function() {
            $('.class_code').on('change', function() {
                let selectedValue = $(this).val();
                $("#YesPrints").attr('data-class', selectedValue);
            });
            $(document).on('click', '#prints', function() {
                $(".modal-confirmation-text").html('Do you want to Downlaod prints ?');
                $("#YesPrints").attr('data-code', $(this).attr('data-type'));
                $("#ModelPrints").modal('show');
            });
            $(document).on('click', '#YesPrints', function() {
                var DataClass = $(this).attr('data-class'); 

                if (DataClass == '') {
                    return notyf.error("សូមជ្រើសរើស ថ្នាក់/ក្រុម");
                }
                var url = 'certificate/card-student-print?class_code=' + DataClass + '&type=is_print';
                data = $("#advance_search").serialize();
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
@endsection
