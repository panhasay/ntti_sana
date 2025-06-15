<style>
    body :not(nav):not(nav *) {
        font-family: 'Khmer OS Battambang', Tahoma, sans-serif !important;
    }

    /* customize css modal */
    .modal-content {
        border: 0px solid #e4e9f0 !important;
    }
</style>

@extends('app_layout.app_layout')

@section('content')
    {{-- <x-breadcrumbs :array="[
        ['route' => request()->fullUrl(), 'title' => request()->get('module') . ':បង្កើតលេខកូដ'],
        ['route' => 'certificate/module-menu', 'title' => 'ត្រួតពិនិត្យលិខិតបញ្ជាក់'],
        ['route' => 'department-menu', 'title' => 'ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់']
    ]" /> --}}

    <div class="row">
        <div>
            <div class="card card-body">
                <div id="validation-errors" class="alert alert-danger d-none">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-information-outline me-2"></i>
                        <strong>Ensure that these requirements are met:</strong>
                    </div>
                    <ul class="mb-0 mt-2" id="error-list"></ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form id="formCreateCode">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <span class="form-label">កម្រិត</span>
                                    <div class="input-group">
                                        <select class="select2-search" id="sch_level" name="sch_level" style="width: 100%"
                                            placeholder="ជ្រើសរើសកម្រិតទាំងអស់">
                                            <option value="">ជ្រើសរើសកម្រិត</option>
                                            @foreach ($qualification as $item)
                                                <option value="{{ $item->code }}">{{ $item->name_3 }} :
                                                    {{ $item->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="error sch_level-error text-danger"
                                        style="padding-top: -50px !important"></span>
                                </div>
                                <div class="col-sm-3">
                                    <span class="form-label">ជំនាញ</span>
                                    <div class="input-group">
                                        <select class="select2-search" id="sch_skill" name="sch_skill" style="width: 100%"
                                            placeholder="ជ្រើសរើសជំនាញទាំងអស់">
                                            <option value="">ជ្រើសរើសជំនាញ</option>
                                            @foreach ($skills as $item)
                                                <option value="{{ $item->code }}">{{ $item->name_2 }} :
                                                    {{ $item->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="error sch_skill-error text-danger"></span>
                                </div>
                                <div class="col-sm-3">
                                    <span class="form-label">កូដ</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control mb-2 mb-md-0 me-2" name="sch_code"
                                            id="sch_code" placeholder="កូដ" autocomplete="off">
                                    </div>
                                    <span class="error sch_code-error text-danger"></span>
                                </div>
                                <div class="col-sm-3 pull-left" style="margin-top: 30px;">
                                    <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                                        id="btn_save">
                                        <i class="mdi mdi-content-save"></i> រក្សាទុក
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr />
                        <div class="form-group row">
                            <!-- Search Field -->
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="form-control mb-2 mb-md-0 me-2" name="sch_data"
                                        id="sch_data" placeholder="ស្វែងរកឈ្មោះ កម្រិត ជំនាញ" autocomplete="off">
                                </div>
                            </div>

                            <!-- Status Dropdown -->
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <select class="form-select select2-search" id="sch_status" name="sch_status"
                                        placeholder="ជ្រើសរើស Status ទាំងអស់">
                                        <option value="">ជ្រើសរើស Status ទាំងអស់</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="row">
            <div class="control-table table-responsive custom-data-table-wrapper2">
                <div class="col-md-12 mt-0">
                    <table class="table table-striped" id="tbl_card_stu_list">
                        <thead>
                            <tr class="general-data">
                                <th>ល.រ</th>
                                <th>កូដ</th>
                                <th>កម្រិត</th>
                                <th>ជំនាញ</th>
                                <th>Status</th>
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
@endsection

<x-modal id="modal_update" additionalClasses="modal-select2" title="កែប្រែ" size="xl">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form id="formUpdateCode">
                    <input type="hidden" id="transcript_id" name="transcript_id">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <span class="form-label">កម្រិត</span>
                            <div class="input-group">
                                <select class="select2-sch-modal" id="sch_ulevel" name="sch_ulevel" style="width: 100%"
                                    placeholder="ជ្រើសរើសកម្រិតទាំងអស់">
                                    <option value="">ជ្រើសរើសកម្រិត</option>
                                    @foreach ($qualification as $item)
                                        <option value="{{ $item->code }}">{{ $item->name_3 }} :
                                            {{ $item->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <span class="form-label">ជំនាញ</span>
                            <div class="input-group">
                                <select class="select2-sch-modal" id="sch_uskill" name="sch_uskill"
                                    style="width: 100%" placeholder="ជ្រើសរើសជំនាញទាំងអស់">
                                    <option value="">ជ្រើសរើសជំនាញ</option>
                                    @foreach ($skills as $item)
                                        <option value="{{ $item->code }}">{{ $item->name_2 }} :
                                            {{ $item->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <span class="form-label">កូដ</span>
                            <div class="input-group">
                                <input type="text" class="form-control mb-2 mb-md-0 me-2" name="sch_ucode"
                                    id="sch_ucode" placeholder="កូដ" autocomplete="off">
                            </div>
                            <span class="error sch_ucode-error text-danger"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-bs-dismiss="modal">
            <i class="mdi mdi-close-circle-outline"></i> បោះបង់
        </button>
        <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
            id="btn_update_transcript">
            <i class="mdi mdi-content-save"></i> យល់ព្រម
        </button>
    </x-slot>
</x-modal>
<x-modal id="modal_inactive" additionalClasses="modal-select2" title="Inactive">
    <div class="card bg-light rounded-3 shadow-sm p-3 mb-3">
        <form id="formInactive">
            <input type="hidden" name="id" id="id">
            <div class="mb-2">
                <span class="fw-bold">កូដ</span><br>
                <span id="codeID">N/A</span>
            </div>
            <div>
                <span class="fw-bold">កម្រិត</span><br>
                <span id="levelID">N/A</span>
            </div>
            <div>
                <span class="fw-bold">ជំនាញ</span><br>
                <span id="skillID">N/A</span>
            </div>
        </form>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-bs-dismiss="modal">
            <i class="mdi mdi-close-circle-outline"></i> បោះបង់
        </button>
        <button type="button" class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btn_save_inactive">
            <i class="mdi mdi-content-save"></i> យល់ព្រម
        </button>
    </x-slot>
</x-modal>

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

            const $sch_level = $("#sch_level");
            const $sch_skill = $("#sch_skill");
            const $sch_code = $("#sch_code");
            const $tbl = $("#tbl_card_stu_list");
            const $tbody = $("#tbl_card_stu_list tbody");
            var $sch_ulevel = $("#sch_ulevel");
            var $sch_uskill = $("#sch_uskill");
            var $sch_ucode = $("#sch_ucode");

            function show() {
                const requestData = {
                    search: $("#sch_data").val(),
                    status: $("#sch_status").val(),
                };

                $.ajax({
                    url: "/certificate/transcript/create-code/show",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify(requestData),
                    cache: true,
                    success: function(response) {
                        renderTable(response);
                    },
                    error: function(xhr, status, error) {
                        notyf.error(xhr.statusText);
                    },
                });
            }

            function renderTable(response) {
                let html = ``;
                const json = response.records_data;

                if (json && json.length > 0) {
                    $.each(json, function(index, item) {
                        let active = item.active;
                        let isActive = active == 0 ? 'disabled' : '';
                        html += `<tr>`;
                        html += `<td height="40">${index + 1}</td>`;
                        html += `<td>${item.code}</td>`;
                        html += `<td>${item.lv_full}</td>`;
                        html += `<td>${item.sk_kh}</td>`;
                        html +=
                            `<td>${item.active == 1 ? '<div class="badge badge-pill mb-2 mb-md-0 me-2 badge-success">Active</div>':'<div class="badge badge-pill mb-2 mb-md-0 me-2 badge-danger">Inactive</div>'}</td>`;
                        html += `<td>`;
                        html +=
                            `<button type="button" ${isActive}
                        class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btn_update" data-id="${item.id}"><i class="mdi mdi-pencil"></i></button>`;
                        html +=
                            `<button type="button" ${isActive}
                        class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btn_inactive" data-id="${item.id}"><i class="mdi mdi-delete-restore"></i></button>`;
                        html += `</td>`;
                        html += `</tr>`;
                    });
                } else {
                    html += `<tr>`;
                    html +=
                        `<td colspan="10" height="40"><div class="text-center"><label class="text-center">រកមិនឃើញទិន្ន័យនៅក្នុងប្រព័ន្ធ!</label></div></td>`;
                    html += `</tr>`;
                }

                $tbody.html(html);
            }

            $('#btn_save11').on('click', function(e) {
                e.preventDefault();
                var formData = new FormData($('#formCreateCode')[0]);
                $.ajax({
                    url: '/certificate/transcript/create-code/create',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('.error').text('');
                        notyf.success('Data saved successfully!');
                        $('#formCreateCode')[0].reset();
                        $('.is-invalid').removeClass('is-invalid');
                        $('.select2-selection').removeClass('border border-danger');
                        $('.invalid-feedback').remove();

                        $sch_level.val('');
                        $sch_level.select2();
                        $sch_skill.val('');
                        $sch_skill.select2();
                        show();
                    },
                    error: function(xhr) {
                        $('.error').text('');
                        if (xhr.status === 422) {
                            $('.is-invalid').removeClass('is-invalid');
                            $('.select2-selection').removeClass('border border-danger');
                            $('.invalid-feedback').remove();
                            $.each(xhr.responseJSON.errors, function(field, messages) {
                                let input = $('[name="' + field + '"]');
                                input.addClass('is-invalid');
                                if (input.hasClass('select2-search')) {
                                    input.next('.select2-container').find(
                                        '.select2-selection').addClass(
                                        'border border-danger');
                                }
                                $(`.${field}-error`).text(messages);
                            });
                        } else {
                            notyf.error('An error occurred!');
                        }
                    }
                });
            });
            $('#btn_save').on('click', function(e) {
                e.preventDefault();
                var formData = new FormData($('#formCreateCode')[0]);
                $.ajax({
                    url: '/certificate/transcript/create-code/create',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        notyf.success('Data saved successfully!');
                        $('#formCreateCode')[0].reset();
                        $('#validation-errors').addClass('d-none');
                        $('#error-list').empty();

                        $sch_level.val('');
                        $sch_level.select2();
                        $sch_skill.val('');
                        $sch_skill.select2();
                        show();
                    },
                    error: function(xhr) {
                        $('.error').text('');
                        if (xhr.status === 422) {
                            $('.is-invalid').removeClass('is-invalid');
                            $('.select2-selection').removeClass('border border-danger');
                            $('.invalid-feedback').remove();

                            $('#validation-errors').removeClass('d-none');
                            $('#error-list').empty(); // Clear any old errors

                            $.each(xhr.responseJSON.errors, function(field, messages) {
                                let input = $('[name="' + field + '"]');
                                input.addClass('is-invalid');
                                if (input.hasClass('select2-search')) {
                                    input.next('.select2-container').find(
                                        '.select2-selection').addClass(
                                        'border border-danger');
                                }
                                $('#error-list').append('<li>' + messages + '</li>');
                            });
                        } else {
                            notyf.error('An error occurred!');
                        }
                    }
                });
            });

            $("body").on("click", "#btn_update", function(e) {
                const id = $(this).data("id");
                $("#transcript_id").val(id);
                const requestData = {
                    id
                };
                $.ajax({
                    url: "/certificate/transcript/create-code/show-first",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify(requestData),
                    cache: true,
                    success: function(response) {
                        let data = response.records_data;
                        let $form = $("#formUpdateCode");
                        $form.find("#sch_ulevel").val(data.qualification_code).trigger('change')
                            .prop("disabled", true);
                        $form.find("#sch_uskill").val(data.skills_code).trigger('change').prop(
                            "disabled", true);
                        $form.find("#sch_ucode").val(data.code);
                        $("#modal_update").modal("show");
                    },
                    error: function(xhr, status, error) {
                        notyf.error(xhr.statusText);
                    },
                });
            });

            $('#btn_update_transcript').on('click', function(e) {
                e.preventDefault();
                var formData = new FormData($('#formUpdateCode')[0]);
                $.ajax({
                    url: '/certificate/transcript/create-code/update',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('.error').text('');
                        notyf.success('Update successfully!');
                        $('#formUpdateCode')[0].reset();
                        $('.is-invalid').removeClass('is-invalid');
                        $('.select2-selection').removeClass('border border-danger');
                        $('.invalid-feedback').remove();

                        $sch_ulevel.val('');
                        $sch_ulevel.select2();
                        $sch_uskill.val('');
                        $sch_uskill.select2();

                        const modalEl = document.getElementById('modal_update');
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        modal.hide();
                        show();
                    },
                    error: function(xhr) {
                        $('.error').text('');
                        if (xhr.status === 422) {
                            let form = $('#formUpdateCode');
                            form.find('.is-invalid').removeClass('is-invalid');
                            form.find('.select2-selection').removeClass('border border-danger');
                            form.find('.invalid-feedback').remove();
                            $.each(xhr.responseJSON.errors, function(field, messages) {
                                let input = form.find('[name="' + field + '"]');
                                input.addClass('is-invalid');
                                if (input.hasClass('select2-hidden-accessible')) {
                                    input.next('.select2-container').find(
                                        '.select2-selection').addClass(
                                        'border border-danger');
                                }
                                if (input.length) {
                                    const errorElement = $(
                                        '<div class="invalid-feedback d-block">' +
                                        messages[0] + '</div>');
                                    input.after(errorElement);
                                }
                            });
                        } else {
                            notyf.error('An error occurred!');
                        }
                    }
                });
            });

            $("body").on("click", "#btn_inactive", function(e) {
                const id = $(this).data("id");
                let $form = $("#formInactive");
                $form.find('input[name="id"]').val(id);
                const requestData = {
                    id
                };
                $.ajax({
                    url: "/certificate/transcript/create-code/show-first-full",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify(requestData),
                    cache: true,
                    success: function(response) {
                        let data = response.records_data;

                        $form.find("#codeID").text(data.code || "N/A");
                        $form.find("#levelID").text(data.qualification?.name_3 || "N/A");
                        $form.find("#skillID").text(data.skill?.name_2 || "N/A");
                        $("#modal_inactive").modal("show");
                    },
                    error: function(xhr, status, error) {
                        notyf.error(xhr.statusText);
                    },
                });
            });
            $("body").on("click", "#btn_save_inactive", function(e) {
                let $form = $("#formInactive");
                const requestData = {
                    id: $form.find('input[name="id"]').val()
                };
                $.ajax({
                    url: "/certificate/transcript/create-code/update-inactive",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify(requestData),
                    cache: true,
                    success: function(response) {
                        notyf.success('Inactive successfully!');
                        const modalEl = document.getElementById('modal_inactive');
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        modal.hide();
                        show();
                    },
                    error: function(xhr, status, error) {
                        notyf.error(xhr.statusText);
                    },
                });
            });
            $("body").on("keyup", "#sch_data", function(e) {
                show();
            });
            $("body").on("change", "#sch_status", function(e) {
                show();
            });

            show();
        });
    </script>
@endpush
