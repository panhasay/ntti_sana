<style>
    body :not(nav):not(nav *) {
        font-family: 'Khmer OS Battambang', Tahoma, sans-serif !important;
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
        ['route' => 'certificate/module-menu', 'title' => 'ត្រួតពិនិត្យលិខិតបញ្ជាក់'],
        ['route' => 'department-menu', 'title' => 'ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់'],
    ]" />

    <div class="row">
        <div class="page-header flex-wrap" style="border-bottom: 0px solid #dfdcdc;z-index:20;">
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
        <div class="collapse show" id="collapse_search" style="margin-top: -55px;">
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
                                            <option value="all">ជ្រើសរើសដេប៉ាតឺម៉ង់ទាំងអស់</option>
                                            @foreach ($record_dept as $item)
                                                <option value="{{ $item->code }}">
                                                    {{ $item->name_2 }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <span class="form-label">ក្រុម</span>
                                    <div class="input-group">
                                        <select class="select2-search" id="sch_class_spec" name="sch_class_spec"
                                            style="width: 100%" placeholder="ជ្រើសរើសក្រុមទាំងអស់">
                                            <option value="all">ជ្រើសរើសក្រុមទាំងអស់</option>
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
                                            <option value="all">ជ្រើសរើសកម្រិតទាំងអស់</option>
                                            @foreach ($record_level as $item)
                                                <option value="{{ $item->code }}">{{ $item->name_2 }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <span class="form-label">វេន</span>
                                    <div class="input-group">
                                        <select class="select2-search" id="sch_shift" name="sch_shift" style="width: 100%">
                                            <option value="all">ជ្រើសរើសវេនទាំងអស់</option>
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
                                            <option value="all">ជ្រើសរើសជំនាញទាំងអស់</option>
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
                                    id="sch_info_student" placeholder="ស្វែងរក អត្តលេខ ឈ្មោះខ្មែរ ឈ្មោះអង់គ្លេស"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="row">
            <div>
                <div class="col-md-12 mt-0">
                    <div class="d-flex justify-content-between mb-1">
                        <div class="d-flex gap-1" role="group" aria-label="Table Actions">
                            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btn_print_multiple">
                                <i class="mdi mdi-printer pl-2"></i> បោះពុម្ភ</a>
                            <a class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btn_reset">
                                <i class="mdi mdi-printer pl-2"></i> កំណត់ឡើងវិញ</a>
                        </div>
                    </div>
                    <table class="table table-striped" id="tbl_card_stu_list">
                        <thead>
                            <tr class="general-data">
                                <th>
                                    <input class="form-check-input" type="checkbox" id="checkAll"
                                        style="transform: scale(1.5);">
                                </th>
                                <th>ល.រ</th>
                                <th>អត្តលេខ</th>
                                <th>គោត្តនាម និងនាម</th>
                                <th>ឈ្មោះជាឡាតាំង</th>
                                <th>ក្រុម/ថ្នាក់</th>
                                <th>វគ្គសិក្សា</th>
                                <th>លេខ</th>
                                <th>ថ្ងៃបោះពុម្ភ</th>
                                <th>ស្ថានភាព</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="pagination_list" class="mt-3 mb-5"></div>
    </div>

    <x-modal id="modal_add_transcript" title="បង្កើតលេខកូដ">
        <input type="hidden" id="hidden_stu_code" name="stu_code">
        <input type="hidden" id="hidden_dept_code" name="dept_code">
        <input type="hidden" id="hidden_class_code" name="class_code">
        <h4 class="text-center p-4">តើអ្នកចង់បង្កើតលេខកូដសញ្ញាបត្រសម្រាប់គាត់ដែរឬទេ?</h4>
        <x-slot name="footer">
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-bs-dismiss="modal">
                <i class="mdi mdi-close-circle-outline"></i> បោះបង់
            </button>
            <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                id="btn_add_transcript">
                <i class="mdi mdi-content-save"></i> យល់ព្រម
            </button>
        </x-slot>
    </x-modal>

    <x-modal id="modal_generate_code" title="បង្កើតលេខកូដ">
        <input type="hidden" id="hidden_stu_code" name="stu_code">
        <input type="hidden" id="hidden_dept_code" name="dept_code">
        <input type="hidden" id="hidden_class_code" name="class_code">
        <h4 class="text-center p-4">តើអ្នកចង់បង្កើតលេខកូដសម្រាប់គាត់ដែរឬទេ?</h4>
        <x-slot name="footer">
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-bs-dismiss="modal">
                <i class="mdi mdi-close-circle-outline"></i> បោះបង់
            </button>
            <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btn_save_code">
                <i class="mdi mdi-content-save"></i> យល់ព្រម
            </button>
        </x-slot>
    </x-modal>
    <x-modal id="modal_is_check" title="ផ្តល់ជូន">
        <input type="hidden" id="hidden_stu_code" name="stu_code">
        <input type="hidden" id="hidden_dept_code" name="dept_code">
        <input type="hidden" id="hidden_class_code" name="class_code">
        <h4 class="text-center p-4">តើអ្នកចង់ផ្តល់ជូនសម្រាប់គាត់ដែរឬទេ?</h4>
        <x-slot name="footer">
            <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-bs-dismiss="modal">
                <i class="mdi mdi-close-circle-outline"></i> បោះបង់
            </button>
            <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btn_save_isCheck">
                <i class="mdi mdi-content-save"></i> យល់ព្រម
            </button>
        </x-slot>
    </x-modal>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const notyf = new Notyf({
                duration: 2000,
                ripple: true,
                dismissible: true,
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            const $loader = $(".loader");
            $loader.css({
                position: "fixed",
                top: "50%",
                left: "50%",
                transform: "translate(-50%, -50%)",
                "z-index": "1000",
            }).fadeIn();

            function debounce(func, delay) {
                let timer;
                return function(...args) {
                    clearTimeout(timer);
                    timer = setTimeout(() => func.apply(this, args), delay);
                };
            }

            const $sch_dept = $("#sch_dept");
            const $sch_class_spec = $("#sch_class_spec");
            const $sch_level = $("#sch_level");
            const $sch_shift = $("#sch_shift");
            const $sch_skill = $("#sch_skill");
            const $sch_info_student = $("#sch_info_student");
            const $tbl = $("#tbl_card_stu_list");
            const $tbody = $("#tbl_card_stu_list tbody");
            const $pagination_list = $("#pagination_list");

            let cache = {};
            let currentPageList = 1;

            function show() {
                const requestData = {
                    dept_code: $sch_dept.val(),
                    class_code: $sch_class_spec.val(),
                    qualification: $sch_level.val(),
                    sections_code: $sch_shift.val(),
                    skills_code: $sch_skill.val(),
                    search: $sch_info_student.val(),
                    page: currentPageList,
                    rows_per_page: parseInt($("#pagination_list .rows_per_page").val() ?? 50),
                };

                const cacheKey = JSON.stringify(requestData);

                // Check if data is already in cache
                if (cache[cacheKey]) {
                    renderTable(cache[cacheKey]);
                    return;
                }

                $.ajax({
                    url: "{{ route('student-status.show') }}",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify(requestData),
                    cache: true,
                    success: function(response) {
                        cache[cacheKey] = response; // Store response in cache
                        renderTable(response);
                    },
                    error: function(xhr, status, error) {
                        notyf.error(xhr.statusText);
                    },
                });
            }

            function renderTable(response) {
                $tbody.empty();
                let html = ``;
                const currentPage = response.current_page;
                const rowsPerPage = response.page;
                const json = response.data;

                if (json && json.length > 0) {
                    $.each(json, function(index, item) {
                        const record_assign_no = item.record_assign_no ?? [];
                        const record_print = item.record_print ?? [];
                        const photo = item.photo_status === false ?
                            '/asset/NTTI/images/faces/default_User.jpg' :
                            `/uploads/student/${item.stu_photo}`;

                        var isChecked = selectedStudentIds.includes(parseInt(item.code)) ? 'checked' : '';

                        html += `<tr>`;
                        html += `<td height="40">
                            <input class="form-check-input row-checkbox" type="checkbox" style="transform: scale(1.5);" value="${item.code}" data-student-id="${item.code}" ${isChecked}>
                        </td>`;

                        html += `<td >${index + 1 + (currentPage - 1) * rowsPerPage}</td>`;
                        html +=
                            `<td><div class="hover-photo"><img src="${photo}" alt="Student Photo"> ${item.code}</div></td>`;
                        html += `<td>${item.name_2}</td>`;
                        html += `<td>${item.name}</td>`;
                        html +=
                            `<td>${item.class == null ? "No Class" : item.class} <label class="fw-bold">|</label> ${item.section_type}</td>`;
                        html +=
                            `<td>${record_assign_no.years ? `ឆ្នាំទីៈ ${record_assign_no.years} | ឆមាសទីៈ ${record_assign_no.semester} | ${record_assign_no.qualification} | ${item.skill}` : '<label>---</label>'}</td>`;
                        html +=
                            `<td>${record_print.reference_code ? `${record_print.reference_code}` : '<label>---</label>'}</td>`;
                        html +=
                            `<td>${record_print.print_date ? new Date(record_print.print_date).toISOString().split('T')[0] : '<label>---</label>'}</td>`;
                        html +=
                            `<td class="align-items-center">${record_print.status == 1 ? `<i class="mdi mdi-check-decagram mdi-24px text-success"></i> បានផ្តល់ជូនបេក្ខជន` : `<i class="mdi mdi-close-octagon mdi-24px text-danger"></i>​មិនទាន់បានផ្តល់ជូនបេក្ខជន`}</td>`;
                        html += `<td>
                        <div class="dropdown">
                            <button type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" title="More Options"
                                class="btn btn-outline-secondary btn-rounded btn-icon" style="width: 35px; height: 35px; margin-right: 5px">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)" name="btn_modal_transcript" id="btn_modal_transcript" data-keyword="${item.keyword}"><i class="mdi mdi-printer btn-icon-append"></i>
                                        បោះពុម្ភ</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)" name="btn_modal_add_transcript" id="btn_modal_add_transcript"
                                        data-dept_code="${item.department_code}" data-class_code="${item.class_code}" data-stu_code="${item.code}"><i class="mdi mdi-plus btn-icon-append"></i>
                                        បង្កើត&ផ្តល់ជូន</a>
                                </li>
                                <li hidden>
                                    <a class="dropdown-item" href="javascript:void(0)" name="btn_modal_add_code" id="btn_modal_add_code"
                                        data-dept_code="${item.department_code}" data-class_code="${item.class_code}" data-stu_code="${item.code}"><i class="mdi mdi-plus btn-icon-append"></i>
                                        បង្កើតលេខកូដ</a>
                                </li>
                                <li hidden>
                                    <a class="dropdown-item" href="javascript:void(0)" name="btn_modal_is_check" id="btn_modal_is_check"
                                        data-dept_code="${item.department_code}" data-class_code="${item.class_code}" data-stu_code="${item.code}"><i class="mdi mdi-check-decagram btn-icon-append"></i>
                                        ផ្តល់ជូន</a>
                                </li>
                            </ul>
                        </div>
                    </td>`;
                        html += `</tr>`;
                    });
                }

                $tbody.html(html);
                $("#pagination_list").html(response.links);
            }
            let classCache = {};

            function showClass() {
                const sch_dept = $sch_dept.val();

                if (classCache[sch_dept]) {
                    renderClassOptions(classCache[sch_dept]);
                    return;
                }

                const requestData = {
                    dept_code: sch_dept,
                };
                $.ajax({
                    url: "/certificate/transcript/show-class",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify(requestData),
                    success: function(response) {
                        if (response && response.length > 0) {
                            classCache[sch_dept] = response;
                            renderClassOptions(response);
                        } else {
                            $sch_class_spec.empty();
                            $sch_class_spec.append(
                                new Option("No classes available", "", true, false)
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        notyf.error(
                            `Error fetching class data: ${xhr.statusText || "Unknown error"}`
                        );
                        $sch_class_spec.empty();
                        $sch_class_spec.append(
                            new Option("Error loading classes", "", true, false)
                        );
                    },
                    complete: function() {
                        $sch_class_spec.select2();
                    },
                });
            }

            function renderClassOptions(classes) {
                $sch_class_spec.empty();
                $sch_class_spec.append(
                    new Option("ជ្រើសរើសក្រុមទាំងអស់", "all", true, false)
                );

                $.map(classes, function(item) {
                    $sch_class_spec.append(
                        new Option(item.name, item.code, false, false)
                    );
                });

                $sch_class_spec.select2();
            }
            $pagination_list.on("click", ".btn_refresh", function() {
                currentPageList = 1;
                $("#pagination_list .rows_per_page").val(50);
                $loader.fadeIn();
                setTimeout(function() {
                    show();
                    $loader.fadeOut();
                }, 500);
            });
            $pagination_list.on("change", ".rows_per_page", function(e) {
                e.preventDefault();
                $loader.fadeIn();
                setTimeout(function() {
                    currentPageList = 1;
                    show();
                    $loader.fadeOut();
                }, 500);
            });
            $pagination_list.on("click", ".page-link[data-page]", function(e) {
                e.preventDefault();
                var page = $(this).data("page");

                $loader.fadeIn();
                setTimeout(function() {
                    currentPageList = page;
                    show();
                    $loader.fadeOut();
                }, 500);
            });
            $sch_dept.on("change", function() {
                $loader.fadeIn();
                setTimeout(function() {
                    showClass();
                    show();
                    currentPageList = 1;
                    $loader.fadeOut();
                }, 500);
            });
            $sch_class_spec.on("change", function() {
                $loader.fadeIn();
                setTimeout(function() {
                    show();
                    currentPageList = 1;
                    $loader.fadeOut();
                }, 500);
            });
            $sch_level.on("change", function() {
                $loader.fadeIn();
                setTimeout(function() {
                    show();
                    currentPageList = 1;
                    $loader.fadeOut();
                }, 500);
            });
            $sch_shift.on("change", function() {
                $loader.fadeIn();
                setTimeout(function() {
                    show();
                    currentPageList = 1;
                    $loader.fadeOut();
                }, 500);
            });
            $sch_skill.on("change", function() {
                $loader.fadeIn();
                setTimeout(function() {
                    show();
                    currentPageList = 1;
                    $loader.fadeOut();
                }, 500);
            });
            $sch_info_student.on("keyup", debounce(function() {
                $loader.fadeIn();
                currentPageList = 1;
                show();
                $loader.fadeOut();
            }, 300));

            $("body").on("click", "#btn_modal_transcript", function(e) {
                e.preventDefault();
                const key = $(this).data("keyword");
                const url = "{{ route('student-status.print', ':key') }}".replace(':key', key);
                window.open(url, '_blank');
            });
            $("body").on("click", "#btn_modal_add_transcript", function(e) {
                const stu_code = $(this).data("stu_code");
                const dept_code = $(this).data("dept_code");
                const class_code = $(this).data("class_code");
                $("#hidden_stu_code").val(stu_code);
                $("#hidden_dept_code").val(dept_code);
                $("#hidden_class_code").val(class_code);

                $("#modal_add_transcript").modal("show");
            });
            $("#btn_add_transcript").on("click", function() {
                $loader.fadeIn();
                const stu_code = $("#hidden_stu_code").val();
                const dept_code = $("#hidden_dept_code").val();
                const class_code = $("#hidden_class_code").val();
                const requestData = {
                    stu_code,
                    dept_code,
                    class_code,
                };
                $.ajax({
                    url: "{{ route('student-status.create') }}",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify(requestData),
                    success: function(data) {
                        if (data.status == 200) {
                            cache = {};
                            notyf.success(data.message);
                            $("#modal_add_transcript .btn-close").trigger(
                                "click"
                            );
                            show();
                        } else {
                            notyf.error(data.message);
                        }

                        setTimeout(function() {
                            show();
                            $loader.fadeOut();
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        notyf.error(error);
                    },
                });
            });
            $("body").on("click", "#btn_modal_add_code", function(e) {
                const stu_code = $(this).data("stu_code");
                const dept_code = $(this).data("dept_code");
                const class_code = $(this).data("class_code");
                $("#hidden_stu_code").val(stu_code);
                $("#hidden_dept_code").val(dept_code);
                $("#hidden_class_code").val(class_code);

                $("#modal_generate_code").modal("show");
            });
            $("#btn_save_code").on("click", function() {
                $loader.fadeIn();
                const stu_code = $("#hidden_stu_code").val();
                const dept_code = $("#hidden_dept_code").val();
                const class_code = $("#hidden_class_code").val();
                const requestData = {
                    stu_code,
                    dept_code,
                    class_code,
                };
                $.ajax({
                    url: "{{ route('student-status.generate-code') }}",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify(requestData),
                    success: function(data) {
                        if (data.status == 200) {
                            cache = {};
                            notyf.success(data.message);
                            $("#modal_generate_code .btn-close").trigger(
                                "click"
                            );
                            show();
                        } else {
                            notyf.error(data.message);
                        }

                        setTimeout(function() {
                            show();
                            $loader.fadeOut();
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        notyf.error(error);
                    },
                });
            });
            $("body").on("click", "#btn_modal_is_check", function(e) {
                const stu_code = $(this).data("stu_code");
                const dept_code = $(this).data("dept_code");
                const class_code = $(this).data("class_code");
                $("#hidden_stu_code").val(stu_code);
                $("#hidden_dept_code").val(dept_code);
                $("#hidden_class_code").val(class_code);

                $("#modal_is_check").modal("show");
            });
            $("#btn_save_isCheck").on("click", function() {
                $loader.fadeIn();
                const stu_code = $("#hidden_stu_code").val();
                const dept_code = $("#hidden_dept_code").val();
                const class_code = $("#hidden_class_code").val();
                const requestData = {
                    stu_code,
                    dept_code,
                    class_code,
                };
                $.ajax({
                    url: "{{ route('student-status.is-check') }}",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify(requestData),
                    success: function(data) {
                        if (data.status == 200) {
                            cache = {};
                            notyf.success(data.message);
                            $("#modal_generate_code .btn-close").trigger(
                                "click"
                            );
                            show();
                        } else {
                            notyf.error(data.message);
                        }

                        setTimeout(function() {
                            show();
                            $loader.fadeOut();
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        notyf.error(error);
                    },
                });
            });

            $('#fm_search_student input').keydown(function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                }
            });

            let selectedStudentIds = [];
            $("#btn_reset").on("click", function() {
                $loader.fadeIn();
                selectedStudentIds = [];
                $('#checkAll').prop('checked', false);
                setTimeout(function() {
                    show();
                    $loader.fadeOut();
                }, 500);
            });

            function updateSelectedStudentIds() {
                $('.row-checkbox:checked').each(function() {
                    let id = $(this).data('student-id');
                    if (!selectedStudentIds.includes(id)) {
                        selectedStudentIds.push(id);
                    }
                });
                $('.row-checkbox:not(:checked)').each(function() {
                    let id = $(this).data('student-id');
                    selectedStudentIds = selectedStudentIds.filter(item => item !== id);
                });
            }

            $('#checkAll').on('change', function() {
                $('.row-checkbox').prop('checked', this.checked);
                updateSelectedStudentIds()
            });

            $(document).on('change', '.row-checkbox', function() {
                if (!this.checked) {
                    $('#checkAll').prop('checked', false);
                } else if ($('.row-checkbox:checked').length === $('.row-checkbox').length) {
                    $('#checkAll').prop('checked', true);
                }
                updateSelectedStudentIds()
            });

            function getSelectedStudentIds() {
                return $('.row-checkbox:checked').map(function() {
                    return $(this).data('student-id');
                }).get();
            }

            $("body").on("click", "#btn_print_multiple", function(e) {
                e.preventDefault();

                if (selectedStudentIds.length === 0) {
                    notyf.error("សូមជ្រើសរើសសិស្សយ៉ាងហោចណាស់ម្នាក់!");
                    return;
                }
                const idParam = selectedStudentIds.join(',');

                const url = `/certificate/student-status/print-multilple/${idParam}`;
                window.open(url, '_blank');
            });

            show();
        });
    </script>
@endpush
