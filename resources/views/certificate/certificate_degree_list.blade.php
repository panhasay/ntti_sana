<style>
    body {
        font-family: "Khmer OS Battambang", Tahoma, sans-serif !important;
    }

    /* start scroll bar */
    ::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }

    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 2px;
    }

    ::-webkit-scrollbar-thumb {
        background: #718093;
        border-radius: 2px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #718093;
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
</style>
@extends('app_layout.app_layout')
@section('content')
    <x-breadcrumbs :array="[
        ['route' => request()->path(), 'title' => $moduleDetails[0]->name_kh],
        ['route' => 'certificate/dept-menu/' . $departmentDetails[0]->code, 'title' => 'ត្រួតពិនិត្យលិខិតបញ្ជាក់'],
        ['route' => 'certificate/dept-menu', 'title' => $departmentDetails[0]->name_2],
        ['route' => 'department-menu', 'title' => 'ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់'],
    ]" />

    <div class="row">
        <div class="page-header flex-wrap" style="border-bottom: 0px solid #dfdcdc;">
            <div class="header-left p-3">
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
                                            @foreach ($departmentDetails as $item)
                                                <option value="{{ $item->code }}">{{ $item->name_2 }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <span class="form-label">ក្រុម</span>
                                    <div class="input-group">
                                        <select class="select2-search" id="sch_class_spec" name="sch_class_spec"
                                            style="width: 100%" placeholder="សូមជ្រើសរើសក្រុម">
                                            <option value="">សូមជ្រើសរើសក្រុម</option>
                                            @foreach ($records_class as $item)
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
                                            @foreach ($records_level as $item)
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
                                            @foreach ($activeSections as $item)
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
                                            @foreach ($records_skill as $item)
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
@endsection
