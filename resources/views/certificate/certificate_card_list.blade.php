<style>
    body :not(nav):not(nav *) {
        font-family: 'Khmer OS Battambang', Tahoma, sans-serif !important;
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

    .nav-item .nav-link-stu.active {
        background-color: #088ccf !important;
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
        padding-top: 4px !important;
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

    .card-custom {
        display: flex;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .card-custom:hover {
        transform: scale(1.05);
    }

    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #fff;
        font-size: 24px;
        margin-right: 15px;
    }

    .bg-blue {
        background-color: #17a2b8;
    }

    .bg-green {
        background-color: #28a745;
    }

    .card-title {
        font-size: 16px;
        margin-bottom: 2px;
        font-weight: 600;
    }

    .card-value {
        font-size: 22px;
        font-weight: bold;
    }

    /* customize css modal */
    .modal-content {
        border: 0px solid #e4e9f0 !important;
    }

    /* customize css modal */
</style>



@extends('app_layout.app_layout')
@section('content')
    <x-breadcrumbs :array="[
        ['route' => request()->path(), 'title' => $arr_module[0]->name_kh],
        ['route' => 'certificate/dept-menu/' . $arr_dept[0]->code, 'title' => 'ត្រួតពិនិត្យលិខិតបញ្ជាក់'],
        ['route' => 'certificate/dept-menu', 'title' => $arr_dept[0]->name_2],
        ['route' => 'department-menu', 'title' => 'ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់'],
    ]" />
    <input type="hidden" name="session_code" id="session_code" value="{{ $sessionYear->code }}">

    <div class="row">
        <div class="page-header flex-wrap" style="border-bottom: 0px solid #dfdcdc;">
            <div class="header-left p-3">
                <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btn_open_print_date">
                    <i class="mdi mdi-av-timer"></i> កាលបរិច្ឆេទបោះពុម្ភ</a>

                <button type="button" id="btn_open_expire_date"
                    class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2">
                    <i class="mdi mdi-calendar-clock"></i> កាលបរិច្ឆេទផុតកំណត់
                </button>
                <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-toggle="modal"
                    data-target="#modal_card_upload_zip_photo"><i class="mdi mdi-cloud-upload"></i> រូបថត
                </button>
                <button type="button" id="prints" name="prints"
                    class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2">
                    <i class="mdi mdi-printer btn-icon-append"></i> បោះពុម្ភ
                </button>
                <button type="button" id="BtnDownlaodExcel"
                    class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2"><i
                        class="mdi mdi-file-excel"></i> ទាញយក Excel
                </button>
            </div>
            <div class="d-grid d-md-flex justify-content-md-end p-3">
                <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-toggle="collapse"
                    href="#collapse_search" role="button" aria-expanded="false" aria-controls="collapseExample"
                    name="btn_filter" id="btn_filter">
                    Filter <i class="mdi mdi-arrow-up-bold"></i>
                </a>
            </div>
        </div>
        <div class="collapse show" id="collapse_search">
            <div class="card card-body">
                <form id="fm_search_student" role="form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-sm-3">
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
                                        <select class="select2-search" id="sch_class_spec" name="sch_class_spec"
                                            style="width: 100%" placeholder="ជ្រើសរើសក្រុមទាំងអស់">
                                            <option value="">ជ្រើសរើសក្រុមទាំងអស់</option>
                                            @foreach ($record_class as $item)
                                                <option value="{{ $item->code }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
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
                                <div class="col-sm-2">
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
                                <div class="col-sm-2">
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
                            <div class="row" hidden>
                                <div class="col-md-3 pull-left">
                                    <button type="button" class="btn btn-primary text-white" id="btn_search">ស្វែងរក
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row g-3">
                <div class="col-md-2">
                    <div class="info-box bg-b-green-yellow">
                        <span class="info-box-icon"><span class="mdi mdi-account-multiple"></span></span>
                        <div class="info-box-content">
                            <span class="info-box-text">សិស្សសរុប</span>
                            <span class="info-box-number" id="tt_students">0</span>
                        </div>
                        <div class="progress" style="margin-top: -10px">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <small class="d-flex justify-content-between w-100">
                            <span class="text-start">ស្រី: <strong id="tt_students_f">0</strong></span>
                            <span class="text-center">|</span>
                            <span class="text-end">ប្រុស: <strong id="tt_students_m">0</strong></span>
                        </small>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box bg-b-green-yellow">
                        <span class="info-box-icon"><span class="mdi mdi-printer"></span></span>
                        <div class="info-box-content">
                            <span class="info-box-text">បោះពុម្ពសរុប</span>
                            <span class="info-box-number" id="total_status_1">0</span>
                        </div>
                        <div class="progress" style="margin-top: -10px">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <small class="d-flex justify-content-between w-100">
                            <span class="text-start">ស្រី: <strong id="total_female_status_1">0</strong></span>
                            <span class="text-center">|</span>
                            <span class="text-end">ប្រុស: <strong id="total_male_status_1">0</strong></span>
                        </small>
                    </div>
                </div>
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
                            class="mdi mdi-account-card-details"></i> កាតសិស្ស</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-card-list-tab" data-toggle="pill" href="#custom-tabs-card-list"
                        role="tab" aria-controls="custom-tabs-card-list" aria-selected="false"
                        style="font-family: 'Khmer OS Battambang', serif;"><i class="mdi mdi-format-list-bulleted"></i>
                        បញ្ជីកាតសិស្ស</a>
                </li>
            </ul>
        </div>
        <div class="tab-content pb-5" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                aria-labelledby="custom-tabs-four-home-tab">
                <div class="col-md-12 ps-3 pe-3">
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
                                            <th>ចំនួនបោះពុម្ភ</th>
                                            <th>ស្ថានភាព</th>
                                            <th>ជម្រើស</th>
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
        <!-- /.card -->
    </div>

    <x-modal-first id="modal_card_print_card" title="បោះពុម្ភកាតសិស្ស">
        <input type="hidden" id="hidden_print_card_id" name="print_card_id">
        <input type="hidden" id="hidden_stu_code" name="stu_code">
        <input type="hidden" id="hidden_dept_code" name="dept_code">
        <input type="hidden" id="hidden_class_code" name="class_code">
        <h4 class="text-center p-4">ប្រសិនបើអ្នកចង់បោះពុម្ភកាតសិស្ស សូមចុច?</h4>
        <x-slot name="footer">
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-dismiss="modal">
                <i class="mdi mdi-close-circle-outline"></i> បោះបង់
            </button>
            <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btn_print_card"
                data-dismiss="modal">
                <i class="mdi mdi-content-save"></i> យល់ព្រម
            </button>
        </x-slot>
    </x-modal-first>
    <x-modal-first id="modal_card_print_revisino" title="បោះពុម្ភកាតសិស្ស">
        <input type="hidden" id="hidden_revision_print_card_id" name="print_card_id">
        <input type="hidden" id="hidden_revision_stu_code" name="stu_code">
        <input type="hidden" id="hidden_revision_dept_code" name="dept_code">
        <input type="hidden" id="hidden_revision_class_code" name="class_code">
        <h4 class="text-center p-4">ប្រសិនបើអ្នកចង់បន្ថែមបោះពុម្ភកាតសិស្ស សូមចុច?</h4>
        <x-slot name="footer">
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-dismiss="modal">
                <i class="mdi mdi-close-circle-outline"></i> បោះបង់
            </button>
            <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                id="btn_print_set_revision" data-dismiss="modal">
                <i class="mdi mdi-content-save"></i> យល់ព្រម
            </button>
        </x-slot>
    </x-modal-first>
    <x-modal-first id="modal_card_disable_active" title="ដកបោះពុម្ពកាតសិស្ស">
        <input type="hidden" id="hidden_disable_stu_code" name="stu_code">
        <input type="hidden" id="hidden_disable_dept_code" name="dept_code">
        <input type="hidden" id="hidden_diable_class_code" name="class_code">
        <h4 class="text-center p-4">ប្រសិនបើអ្នកចង់ដកបោះពុម្ពកាតសិស្ស សូមចុច?</h4>
        <x-slot name="footer">
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-dismiss="modal">
                <i class="mdi mdi-close-circle-outline"></i> បោះបង់
            </button>
            <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                id="btn_card_disable_active" data-dismiss="modal">
                <i class="mdi mdi-content-save"></i> យល់ព្រម
            </button>
        </x-slot>
    </x-modal-first>
    <x-modal-first id="modal_card_update" title="កែប្រែរូបថត" size="fullscreen-md-down" centered="true">
        <input type="hidden" id="hidden_update_stu_code" name="stu_code">
        <input type="hidden" id="hidden_update_dept_code" name="dept_code">
        <input type="hidden" id="hidden_update_class_code" name="class_code">
        <div class="row g-2">
            <div class="col-md-12 stretch-card">
                <div class="card profile-card text-center">
                    <div class="card-body position-relative">
                        <div class="profile-image position-relative d-inline-block" style="width: 172px;">
                            <img id="txt_photo_student" src="{{ asset('asset/NTTI/images/faces/default_User.jpg') }}"
                                width="120" alt="Profile Picture">
                            <input type="file" id="fileUploadProfileStu"
                                class="btn position-absolute top-0 start-0 opacity-0 w-100 h-100">
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
                        <div class="row">
                            <div class="col-6 text-left" style="text-align: left">
                                <strong>កាលបរិច្ចេទសុពលភាព:</strong>
                            </div>
                            <div class="col-6 text-right" id="txt_up_view_expire_card"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-dismiss="modal">
                <i class="mdi mdi-close-circle-outline"></i> បោះបង់
            </button>
            <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btn_update_info">
                <i class="mdi mdi-content-save"></i> យល់ព្រម
            </button>
        </x-slot>
    </x-modal-first>
    <x-modal id="modal_card_due_date" title="កាលបរិច្ឆេទបោះពុម្ភកាតសិស្ស" size="xl">
        <div class="row g-2">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form id="fm_card_due_date" role="form" class="form-horizontal" enctype="multipart/form-data"
                            method="POST">
                            <i class="mdi mdi-star text-danger"></i>
                            <label class="title-page">{{ $sessionYear->name }}</label>
                            <br>
                            <br>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <span class="form-label">កាលបរិច្ចេទ</span>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-control-sm" id="txt_due_date"
                                                name="txt_due_date" value="{{ now()->format('Y-m-d') }}"
                                                placeholder="ថ្ងៃខែឆ្នាំកំណើត" aria-label="ថ្ងៃខែឆ្នាំកំណើត">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span class="form-label">កាលបរិច្ឆេទតាមច័ន្ទគតិខ្មែរ</span>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm"
                                                id="txt_due_khmer_lunar" name="txt_due_khmer_lunar"
                                                placeholder="កាលបរិច្ឆេទតាមច័ន្ទគតិខ្មែរ">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="form-label">កាលបរិច្ឆេទតាមសុរិយគតិខ្មែរ</span>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm"
                                                id="txt_due_date_create" name="txt_due_date_create"
                                                placeholder="កាលបរិច្ឆេទតាមសុរិយគតិខ្មែរ">
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
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-bs-dismiss="modal">
                <i class="mdi mdi-close-circle-outline"></i> បោះបង់
            </button>
            <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                id="btn_due_date_this_session">
                <i class="mdi mdi-content-save"></i> រក្សាទុក
            </button>
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                id="btn_update_date_this_session">
                <i class="mdi mdi-content-save-edit"></i> កែប្រែ
            </button>
        </x-slot>
    </x-modal>
    <x-modal id="modal_card_create_expire_date" title="កាលបរិច្ឆេទផុតកំណត់កាតសិស្ស" size="lg" fullscreen="true">
        <div class="row g-2">
            <div class="col-md-12 stretch-card">
                <div class="card" style="border-left: 0px solid #cae6f5;">
                    <div class="card-body">
                        <form id="fm_card_expire_date" role="form" class="form-horizontal"
                            enctype="multipart/form-data" method="POST">
                            <i class="mdi mdi-star text-danger"></i>
                            <label class="title-page">{{ $sessionYear->name }}</label>
                            <div class="col-md-12 mt-3">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <span class="form-label">កម្រិត</span>
                                        <div class="input-group">
                                            <select class="select2-sch-modal" id="txt_due_level" name="txt_due_level"
                                                style="width: 100%" placeholder="សូមជ្រើសរើសកម្រិត">
                                                <option value="">សូមជ្រើសរើសកម្រិត</option>
                                                @foreach ($record_level as $item)
                                                    <option value="{{ $item->code }}">{{ $item->name_3 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="form-label">ក្រុម</span>
                                        <div class="input-group">
                                            <select class="select2-sch-modal" id="txt_due_class" name="txt_due_class"
                                                style="width: 100%" placeholder="សូមជ្រើសរើសក្រុម">
                                                <option value="">សូមជ្រើសរើសក្រុម</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="form-label">ឆ្នាំទី</span>
                                        <div class="input-group">
                                            <select class="select2-sch-modal" id="txt_due_year" name="txt_due_year"
                                                style="width: 100%" placeholder="សូមជ្រើសរើសឆ្នាំទី">
                                                <option value="">សូមជ្រើសរើសឆ្នាំទី</option>
                                                @for ($year = 1; $year <= 5; $year++)
                                                    <option value="{{ $year }}">ឆ្នាំទី {{ $year }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <span class="form-label">កាលបរិច្ចេទសុពលភាព</span>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-control-sm"
                                                id="sl_due_expire_date" name="sl_due_expire_date"
                                                value="{{ now()->format('Y-m-d') }}" placeholder="កាលបរិច្ចេទសុពលភាព"
                                                aria-label="កាលបរិច្ចេទសុពលភាព">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="form-label">កាលបរិច្ឆេទសុពលភាព</span>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm"
                                                id="txt_due_expire_date" name="txt_due_expire_date"
                                                placeholder="កាលបរិច្ឆេទសុពលភាព">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card" style="border-left: 0px solid #cae6f5;">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <h4 class="text-center">View</h4>
                                </h3>
                            </div>
                            <div class="card-body px-0" style="margin-top: -30px !important;">
                                <div class="control-table table-responsive custom-data-table-wrapper2">
                                    <table id="tbl_view_expire" class="table table-striped">
                                        <thead>
                                            <tr class="general-data">
                                                <th>ល.រ</th>
                                                <th>កម្រិត</th>
                                                <th>ក្រុម</th>
                                                <th>ឆ្នាំទី</th>
                                                <th>កាលបរិច្ចេទផុតកំណត់</th>
                                                <th>កាលបរិច្ចេទផុតកំណត់</th>
                                                <th>បង្កើតដោយ</th>
                                                <th>កែប្រែដោយ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-bs-dismiss="modal">
                <i class="mdi mdi-close-circle-outline"></i> បោះបង់
            </button>
            <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                id="btn_due_expire_card">
                <i class="mdi mdi-content-save"></i> រក្សាទុក
            </button>
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                id="btn_due_update_expire_card">
                <i class="mdi mdi-content-save"></i> កែប្រែ
            </button>
        </x-slot>
        </x-modal-first>
        <x-modal-first class="modal-select2" id="modal_card_upload_zip_photo" title="រូបថតសិស្ស" size="lg"
            centered="true">
            <div class="card-body">
                <form id="fm_up_card_base_option" role="form" class="form-horizontal" enctype="multipart/form-data"
                    method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <span class="form-label">ជ្រើសរើសប្រភេទផ្ទុករូបថតសិស្ស</span>
                                    <div class="input-group">
                                        <select class="select2-sch-modal" id="up_type_option" name="up_type_option"
                                            style="width: 100%" placeholder="សូមជ្រើសរើសប្រភេទ Upload">
                                            <option value="">ជ្រើសរើសប្រភេទផ្ទុករូបថតសិស្ស</option>
                                            <option value="zip" selected>File ZIP</option>
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
                <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                    data-dismiss="modal">
                    <i class="mdi mdi-close-circle-outline"></i> បោះបង់
                </button>
                <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                    id="btn_upload_zip_photo">
                    <i class="mdi mdi-content-save"></i> រក្សាទុក
                </button>
            </x-slot>
        </x-modal-first>
        <x-modal-first id="modal_card_view_detail" title="ព័ត៌មាននិស្សិត" size="xl">
            <div class="row g-2">
                <div class="col-md-4 stretch-card">
                    <div class="card profile-card text-center">
                        <div class="card-body position-relative">
                            <div class="profile-image position-relative d-inline-block" style="width: 172px;">
                                <img id="txt_view_photo" src="{{ asset('asset/NTTI/images/faces/default_User.jpg') }}"
                                    height="120" width="120" alt="Profile Picture">
                            </div>
                            <h5 class="card-title mt-3" id="txt_view_name"></h5>
                            <hr>
                            <div class="row">
                                <div class="col-6 text-left" style="text-align: left"><strong>អត្តលេខ:</strong>
                                </div>
                                <div class="col-6 text-right" id="txt_view_id"></div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-left" style="text-align: left"><strong>ក្រុម:</strong>
                                </div>
                                <div class="col-6 text-right" id="txt_view_class"></div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-left" style="text-align: left"><strong>ជំនាញ:</strong>
                                </div>
                                <div class="col-6 text-right" id="txt_view_skill"></div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-left" style="text-align: left"><strong>កម្រិត:</strong>
                                </div>
                                <div class="col-6 text-right" id="txt_view_level"></div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-left" style="text-align: left">
                                    <strong>វេនសិក្សា:</strong>
                                </div>
                                <div class="col-6 text-right" id="txt_view_shift"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 stretch-card">
                    <div class="row g-2">
                        <ul class="nav nav-pills nav-pills-custom" role="tablist" id="pills-tab">
                            <li class="nav-item active" role="presentation">
                                <a class="nav-link active" id="pills-one-tab" data-bs-toggle="pill"
                                    href="#pills-info-stu-tab" role="tab" aria-controls="pills-one"
                                    aria-selected="true"> ព័ត៌មានសិស្ស </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-two-tab" data-bs-toggle="pill" href="#pills-guardian-tab"
                                    role="tab" aria-controls="pills-two" aria-selected="false" tabindex="-1">
                                    ព័ត៌មានអាណាព្យាបាល </a>
                            </li>
                        </ul>
                        <div class="tab-content tab-content-custom-pill" id="pills-tabContent"
                            style="border: 0 solid #e4e9f0;">
                            <div class="tab-pane fade active show" id="pills-info-stu-tab" role="tabpanel"
                                aria-labelledby="pills-one-tab">
                                <div class="profile-personal-info" style="padding-left: 10px;">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">គោត្តនាម និងនាម <span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_fullname_kh"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ឈ្មោះជាឡាតាំង <span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_fullname_eng"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ថ្ងៃខែឆ្នាំកំណើត <span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_dob"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ថ្នាក់ / ក្រុម <span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_class_1"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">លេខទូរស័ព្ទ <span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_phone"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ជំនាញ<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_skill_1"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">អ៊ីមែល<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_email"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ភេទ<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_gender"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">អាស័យ​ដ្ឋាន​បច្ចុប្បន្ន<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_addr"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ដេប៉ាដេម៉ង់<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_dept"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">កាលបរិច្ចេទសុពលភាព<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_expire_card"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-guardian-tab" role="tabpanel">
                                <div class="profile-personal-info" style="padding-left: 10px;">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ឈ្មោះ ឪពុក<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_father"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ទូរស័ព្ទ ឪពុក<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_father_phone"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">មុខរបរឪពុក<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_father_job"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ឈ្មោះ ម្ដាយ<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_mother"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ទូរស័ព្ទ ម្ដាយ<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_mother_phone"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">មុខរបរម្ដាយ<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_view_mother_job"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ឈ្មោះ អាណាព្យាបាល<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_guardian_name"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">ទូរស័ព្ទ អាណាព្យាបាល<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_guardian_phone"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500">មុខរបរ អាណាព្យាបាល<span class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_guardian_occupation"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                            <h5 class="f-w-500 text-wrap">អាសយដ្ឋាន អាណាព្យាបាល<span
                                                    class="pull-right">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                                            <span id="txt_guardian_address"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <x-slot name="footer">
                <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                    data-dismiss="modal">
                    <i class="mdi mdi-close-circle-outline"></i> បោះបង់
                </button>
            </x-slot>
        </x-modal-first>

        <!---PRINT--->
        <div class="modal fade" id="ModelPrints" tabindex="-1" role="dialog" aria-labelledby="ModelPrints"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-m-header">
                        <h5 class="modal-title" id="divConfirmation">បោះពុម្ភបញ្ជីសិស្ស </h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="modal-confirmation-text text-center p-4"></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                            data-bs-dismiss="modal">
                            <i class="mdi mdi-close-circle-outline"></i> បោះបង់
                        </button>
                        <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                            id="YesPrints" data-class="" data-code="{{ $_GET['assing_no'] ?? '' }}" data-id="">
                            <i class="mdi mdi-content-save"></i> យល់ព្រម
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="divConfirmationExcel" tabindex="-1" role="dialog"
            aria-labelledby="divConfirmationExcel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-m-header">
                        <h5 class="modal-title" id="divConfirmationExcel">ទាញយក Excel</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="modal-confirmation-text text-center p-4"></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                            data-bs-dismiss="modal">
                            <i class="mdi mdi-close-circle-outline"></i> បោះបង់
                        </button>
                        <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                            id="btnYesExcel" data-code="">
                            <i class="mdi mdi-content-save"></i> យល់ព្រម
                        </button>
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

            function handleFiles(files) {
                files.forEach((file) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const img = new Image();
                            img.onload = () => {
                                const canvas = document.createElement('canvas');
                                const ctx = canvas.getContext('2d');

                                const maxWidth = 150;
                                const maxHeight = 200;
                                let width = img.width;
                                let height = img.height;

                                if (width > height) {
                                    if (width > maxWidth) {
                                        height = Math.round((height * maxWidth) / width);
                                        width = maxWidth;
                                    }
                                } else {
                                    if (height > maxHeight) {
                                        width = Math.round((width * maxHeight) / height);
                                        height = maxHeight;
                                    }
                                }

                                canvas.width = width;
                                canvas.height = height;
                                ctx.drawImage(img, 0, 0, width, height);
                                const compressedDataUrl = canvas.toDataURL('image/jpeg', 0.7);


                                const previewImg = document.createElement('img');
                                previewImg.src = compressedDataUrl;
                                previewImg.style.width = "150px";
                                previewImg.style.height = "200px";
                                previewImg.style.objectFit = "cover";
                                previewImg.style.borderRadius = "5px";

                                const fileNameWithoutExt = file.name.split('.').slice(0, -1).join('.');

                                previewImg.setAttribute('data-name', fileNameWithoutExt);

                                previewContainer.appendChild(previewImg);
                            };
                            img.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            function handleFiles111(files) {
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

                            // Extract default name (without extension)
                            const fileNameWithoutExt = file.name.split('.').slice(0, -1).join('.');

                            // Set data-name attribute
                            img.setAttribute('data-name', fileNameWithoutExt);

                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        </script>

        <script>
            function DownlaodExcel(DataClass) {
                var url = 'certificate/card-student-excel';
                var data;
                let class_code = DataClass;

                if ($('#search_data').val() == '') {
                    data = $("#advance_search").serialize();
                } else {
                    data = 'class_code=' + class_code;
                }
                // Create a form to submit the data
                var form = $('<form>', {
                    action: url,
                    method: 'GET'
                });

                // Append the serialized data to the form
                $.each(data.split('&'), function(i, field) {
                    var parts = field.split('=');
                    form.append($('<input>', {
                        type: 'hidden',
                        name: decodeURIComponent(parts[0]),
                        value: decodeURIComponent(parts[1])
                    }));
                });

                // Append the form to the body and submit it
                $('body').append(form);
                form.submit();

                // Optionally, you can show a loader here
                $('.loader').hide();
                $("#divConfirmationExcel").modal('hide');
            }

            $(document).ready(function() {
                $('#sch_class_spec').on('change', function() {
                    let selectedValue = $(this).val();
                    $("#YesPrints").attr('data-class', selectedValue);
                    $("#btnYesExcel").attr('data-code', selectedValue);
                });

                $(document).on('click', '#prints', function() {
                    $(".modal-confirmation-text").html('ប្រសិនបើអ្នកចង់បោះពុម្ភបញ្ជីសិស្ស សូមចុច?');
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
                $(document).on('click', '#BtnDownlaodExcel', function() {
                    $(".modal-confirmation-text").html('ប្រសិនបើអ្នកចង់ទាញយក Excel សូមចុច?');
                    $("#btnYesExcel").attr('data-code', $(this).attr('data-type'));
                    $("#divConfirmationExcel").modal('show');
                });
                $(document).on('click', '#btnYesExcel', function() {
                    var DataClass = $(this).attr('data-code');

                    if (DataClass == '') {
                        return notyf.error("សូមជ្រើសរើស ថ្នាក់/ក្រុម");
                    }
                    DownlaodExcel(DataClass);
                });
            });
        </script>
    @endsection
