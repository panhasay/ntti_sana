const $sch_class_spec = $("#sch_class_spec");
const $sch_level = $("#sch_level");
const $sch_shift = $("#sch_shift");
const $sch_skill = $("#sch_skill");
const $sch_info_student = $("#sch_info_student");
const $btn_search = $("#btn_search");
const $loader = $(".loader");
const $pagination = $("#pagination");
const $pagination_list = $("#pagination_list");
const $btn_print_card = $("#btn_print_card");
const $btn_print_card_view = $("#btn_print_card_view");
const $btn_update_view_info_print = $("#btn_update_view_info_print");
var $txt_up_date_card = $("#txt_up_date_card");

let currentPage = 1;
let currentPageList = 1;

function levelShiftSkill() {
    const class_code = $sch_class_spec.val();
    const sch_level = $sch_level.val();
    const sch_shift = $sch_shift.val();
    const sch_skill = $sch_skill.val();

    const requestData = {
        dept_code: dept_code,
        class_code: class_code,
        sch_level: sch_level,
        sch_shift: sch_shift,
        sch_skill: sch_skill,
    };
    $.ajax({
        url: "/certificate/level_shift_skill",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (response) {
            if (response.record_level && response.record_level.length > 0) {
                const recordLevel = response.record_level[0].level;
                const recordShift = response.record_level[0].sections_code;
                const recordSkill = response.record_level[0].skills_code;

                $sch_level.val(recordLevel);
                $sch_shift.val(recordShift);
                $sch_skill.val(recordSkill);
                $sch_level.select2();
                $sch_shift.select2();
                $sch_skill.select2();
            } else {
                $sch_level.val("");
                $sch_shift.val("");
                $sch_skill.val("");
                $sch_level.select2();
                $sch_shift.select2();
                $sch_skill.select2();
            }
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${
                    xhr.statusText || "Unknown error"
                }`
            );
        },
    });
}

function showClassStudent() {
    const class_code = "";
    const sch_level = $sch_level.val();
    const sch_shift = $sch_shift.val();
    const sch_skill = $sch_skill.val();
    const requestData = {
        dept_code: dept_code,
        class_code: class_code,
        sch_level: sch_level,
        sch_shift: sch_shift,
        sch_skill: sch_skill,
    };
    $.ajax({
        url: "/certificate/level_shift_skill",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (response) {
            if (response.record_level && response.record_level.length > 0) {
                const group = response.record_level[0].name;
                $sch_class_spec.val(group);
                $sch_class_spec.select2();
            } else {
                notyf.error("រកមិនឃើញទិន្ន័យនៅក្នុងប្រព័ន្ធ");
            }
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${
                    xhr.statusText || "Unknown error"
                }`
            );
        },
    });
}

function showCardView() {
    $loader
        .css({
            position: "fixed",
            top: "50%",
            left: "50%",
            transform: "translate(-50%, -50%)",
            "z-index": "1000",
        })
        .fadeIn("slow");

    const class_code = $sch_class_spec.val();
    const requestData = {
        dept_code: dept_code,
        class_code: class_code,
        search: $sch_info_student.val(),
        page: currentPage,
        rows_per_page: parseInt($("#pagination .rows_per_page").val() ?? 50),
    };
    $.ajax({
        url: "/certificate/card_view",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (response) {
            const $tbl = $("#tbl_stu_card_view");
            $tbl.html(generateStudentCardHTML(response));
            $("#pagination").html(response.links);
            setTimeout(function () {
                $loader.fadeOut();
            }, 100);
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${
                    xhr.statusText || "Unknown error"
                }`
            );
        },
    });
}

function showCardViewList() {
    $loader
        .css({
            position: "fixed",
            top: "50%",
            left: "50%",
            transform: "translate(-50%, -50%)",
            "z-index": "1000",
        })
        .fadeIn("slow");

    const class_code = $sch_class_spec.val();
    const requestData = {
        dept_code: dept_code,
        class_code: class_code,
        search: $sch_info_student.val(),
        page: currentPageList,
        rows_per_page: parseInt(
            $("#pagination_list .rows_per_page").val() ?? 50
        ),
    };
    $.ajax({
        url: "/certificate/card_view_list",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (response) {
            const $tbl_card_stu_list = $("#tbl_card_stu_list");
            $tbl_card_stu_list.html(generateStudentTableHTML(response));
            $("#pagination_list").html(response.links);

            setTimeout(function () {
                $loader.fadeOut();
            }, 100);
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${
                    xhr.statusText || "Unknown error"
                }`
            );
        },
    });
}

function generateStudentCardHTML(data) {
    let currentPage = data.current_page;
    let rowsPerPage = data.page;
    let response = data.data;
    let $html = "";
    if (response && response.length > 0) {
        $.each(response, function (index, item) {
            const studentCard = `
                <div class="col-md-4 g-2 mt-2">
                    <div class="student-card-view" style="border: 2px solid ${
                        item.status_print == 1 ? "#2f99d1" : "#ddd"
                    };">
                        <img src="${
                            item.photo_status == false
                                ? "/asset/NTTI/images/faces/default_User.jpg"
                                : `/uploads/student/${item.stu_photo}`
                        }" alt="Profile Picture" width="150" height="200" name="btn_update_view_info_print" id="btn_update_view_info_print" data-stu_code="${
                item.code
            }" data-dept_code="${item.department_code}" data-class_code="${
                item.class_code
            }" data-toggle="modal" data-target="#modal_card_update">
                        <div class="card-body student-information">
                            <div class="name">${item.name_2} ${item.name}</div>
                            <div class="id">${item.code}</div>
                            <div class="phone">${item.phone_student}</div>
                            <div class="info">${item.dept}</div>
                            <div class="info">${
                                item.class == null ? "No Class" : item.class
                            }</div>
                            <hr/>
                            <button type="button" class="btn btn-outline-info btn-sm" title="Print" name="btn_print_card_view" id="btn_print_card_view" data-stu_code="${
                                item.code
                            }" data-dept_code="${
                item.department_code
            }" data-class_code="${
                item.class_code
            }" data-toggle="modal" data-target="#modal_card_print_card">
                                <i class="mdi mdi-printer btn-icon-append"></i>
                            </button>
                            <button type="button" class="btn btn-outline-success btn-sm" title="View Detail">
                                <i class="mdi mdi-account-search"></i>
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" title="Update" name="btn_update_view_info_print" id="btn_update_view_info_print" data-stu_code="${
                                item.code
                            }" data-dept_code="${
                item.department_code
            }" data-class_code="${
                item.class_code
            }" data-toggle="modal" data-target="#modal_card_update">
                                <i class="mdi mdi-border-color"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" ${
                                item.status_print == 1 ? "" : "hidden"
                            } title="Disable Active Print" name="btn_diable_view_info_print" id="btn_diable_view_info_print" data-stu_code="${
                item.code
            }" data-dept_code="${item.department_code}" data-class_code="${
                item.class_code
            }" data-toggle="modal" data-target="#modal_card_disable_active">
                                <i class="mdi mdi-shuffle-disabled"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon pull-right" style="width: 30px;
    height: 30px;margin-right:5px">
                            <label class="text-primary">${
                                index + 1 + (currentPage - 1) * rowsPerPage
                            }</label>
                          </button>
                        </div>
                    </div>
                </div>
            `;
            $html += studentCard;
        });
    } else {
        notyf.error("រកមិនឃើញទិន្ន័យនៅក្នុងប្រព័ន្ធ!");
        $html = `<label class="text-center">រកមិនឃើញទិន្ន័យនៅក្នុងប្រព័ន្ធ!</label>`;
    }

    return $html;
}

function generateStudentTableHTML(data) {
    let $html = "";
    let currentPage = data.current_page;
    let rowsPerPage = data.page;
    let response = data.data;
    if (response && response.length > 0) {
        $.each(response, function (index, item) {
            $html += `<tr>`;
            $html += `<td height="40">${
                index + 1 + (currentPage - 1) * rowsPerPage
            }</td>`;
            $html += `<td>${item.code}</td>`;
            $html += `<td>${item.name_2}</td>`;
            $html += `<td>${item.name}</td>`;
            $html += `<td>${item.gender}</td>`;
            $html += `<td>${item.date_of_birth ?? "No DOB"}</td>`;
            $html += `<td>${item.phone_student}</td>`;
            $html += `<td>${item.class == null ? "No Class" : item.class}</td>`;
            $html += `<td>${item.skill}</td>`;
            $html += `<td>${item.level}</td>`;
            $html += `<td>`;
            $html += `<div class="hover-photo">
                    <img src="${
                        item.photo_status == false
                            ? "/asset/NTTI/images/faces/default_User.jpg"
                            : `/uploads/student/${item.stu_photo}`
                    }"  alt="John's Photo">
                </div>`;
            $html += `</td>`;
            $html += `<td>${
                item.status_print == 1
                    ? '<div class="badge badge-success badge-pill">Already</div>'
                    : '<div class="badge badge-danger badge-pill">No</div>'
            }</td>`;
            $html += `<td><div class="dropdown">
            <button class="btn btn-primary dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-list me-2"></i> <!-- Add your icon class here -->
                Menu
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="javascript:void(0)" name="btn_print_card_view" id="btn_print_card_view" data-stu_code="${
                    item.code
                }" data-dept_code="${item.department_code}" data-class_code="${
                item.class_code
            }" data-toggle="modal" data-target="#modal_card_print_card"><i class="mdi mdi-printer btn-icon-append"></i> Print</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)" title="View Detail"><i class="mdi mdi-account-search"></i> View</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)" title="Update" name="btn_update_view_info_print" id="btn_update_view_info_print" data-stu_code="${
                    item.code
                }" data-dept_code="${item.department_code}" data-class_code="${
                item.class_code
            }" data-toggle="modal" data-target="#modal_card_update"><i class="mdi mdi-border-color"></i> Update</a></li>
                <li ${
                    item.status_print == 1 ? "" : "hidden"
                }><a class="dropdown-item" href="javascript:void(0)" title="Disable Active Print" name="btn_diable_view_info_print" id="btn_diable_view_info_print" data-stu_code="${
                item.code
            }" data-dept_code="${item.department_code}" data-class_code="${
                item.class_code
            }" data-toggle="modal" data-target="#modal_card_disable_active"><i class="mdi mdi-shuffle-disabled"></i> Disable</a></li>
            </ul>
            </div></td>`;
            $html += `</tr>`;
        });
    } else {
        notyf.error("រកមិនឃើញទិន្ន័យនៅក្នុងប្រព័ន្ធ!");
        $html += `<tr>`;
        $html += `<td class="text-center" colspan="14" height="40"><label class="text-center">រកមិនឃើញទិន្ន័យនៅក្នុងប្រព័ន្ធ!</label></td>`;
        $html += `</tr>`;
    }

    return $html;
}

$sch_class_spec.on("change", function () {
    levelShiftSkill();
    currentPage = 1;
    showCardView();

    currentPageList = 1;
    showCardViewList();
});
$sch_level.on("change", function () {
    showClassStudent();
});
$sch_level.attr("disabled", true);
$sch_shift.on("change", function () {
    showClassStudent();
});
$sch_shift.attr("disabled", true);
$sch_skill.on("change", function () {
    showClassStudent();
});
$sch_skill.attr("disabled", true);

$btn_search.on("click", function () {
    currentPage = 1;
    showCardView();

    currentPageList = 1;
    showCardViewList();
});
$pagination.on("click", ".btn_refresh", function () {
    currentPage = 1;
    $("#pagination .rows_per_page").val(50);
    showCardView();
});
$pagination.on("change", ".rows_per_page", function (e) {
    e.preventDefault();
    currentPage = 1;
    showCardView();
});
$pagination.on("click", ".page-link[data-page]", function (e) {
    e.preventDefault();
    var page = $(this).data("page");
    currentPage = page;
    showCardView();
});
$pagination_list.on("click", ".btn_refresh", function () {
    currentPageList = 1;
    $("#pagination_list .rows_per_page").val(50);
    showCardViewList();
});
$pagination_list.on("change", ".rows_per_page", function (e) {
    e.preventDefault();
    currentPageList = 1;
    showCardViewList();
});
$pagination_list.on("click", ".page-link[data-page]", function (e) {
    e.preventDefault();
    var page = $(this).data("page");
    currentPageList = page;
    showCardViewList();
});
$("body").on("click", "#btn_print_card_view", function (e) {
    const stu_code = $(this).data("stu_code");
    const dept_code = $(this).data("dept_code");
    const class_code = $(this).data("class_code");

    $("#hidden_stu_code").val(stu_code);
    $("#hidden_dept_code").val(dept_code);
    $("#hidden_class_code").val(class_code);
});

$("body").on("click", "#btn_print_card", function (e) {
    const requestData = {
        stu_code: $("#hidden_stu_code").val(),
        dept_code: $("#hidden_dept_code").val(),
        class_code: $("#hidden_class_code").val(),
    };
    $.ajax({
        url: "/certificate/print_card",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        async: false,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        beforesend: function () {
            
        },
        success: function (response) {
            jQuery(function ($) {
                const printContainer = $("<div>").html(response.view);
                $("body").append(printContainer);
                printContainer.printThis({
                    importCSS: false,
                    importStyle: false,
                    removeInline: false,
                    printDelay: 333,
                    base: false,
                    formValues: false,
                });
                printContainer.remove();
            });
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${
                    xhr.statusText || "Unknown error"
                }`
            );
        },
    });
});
$("body").on("click", "#btn_update_view_info_print", function (e) {
    const stu_code = $(this).data("stu_code");
    const dept_code = $(this).data("dept_code");
    const class_code = $(this).data("class_code");

    $("#hidden_update_stu_code").val(stu_code);
    $("#hidden_update_dept_code").val(dept_code);
    $("#hidden_update_class_code").val(class_code);

    const requestData = {
        stu_code: stu_code,
        dept_code: dept_code,
        class_code: class_code,
    };
    $.ajax({
        url: "/certificate/card_view_info",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (data) {
            $("#txt_up_view_name").html(data.name);
            $("#txt_up_view_id").html(data.code);
            $("#txt_up_view_class").html(data.class);
            $("#txt_up_view_skill").html(data.skill);
            $("#txt_up_view_level").html(data.level);
            $("#txt_up_view_shift").html(data.section_type);
            $("#txt_up_khmer_lunar").val(data.print_khmer_lunar ?? "");
            $("#txt_up_date_create").val(
                `រាជធានីភ្នំពេញុ, ` + data.print_khmer_date_format ?? ""
            );

            var img =
                data.photo_status == false
                    ? "/asset/NTTI/images/faces/default_User.jpg"
                    : `/uploads/student/${data.stu_photo}`;
            $("#txt_photo_student").attr("src", img);
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${
                    xhr.statusText || "Unknown error"
                }`
            );
        },
    });
});
$("body").on("click", "#btn_update_info", function (e) {
    let formData = new FormData();
    formData.append("stu_code", $("#hidden_update_stu_code").val());
    formData.append("dept_code", $("#hidden_update_dept_code").val());
    formData.append("class_code", $("#hidden_update_class_code").val());

    var fileInput = $("#fileUploadProfileStu")[0].files[0];
    formData.append("date", $("#txt_up_date_card").val());
    formData.append("khmer_lunar", $("#txt_up_khmer_lunar").val());
    if (fileInput) {
        formData.append("photo", fileInput);
    } else {
        formData.append("photo", null);
    }

    $.ajax({
        url: "/certificate/upload_student_info",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        data: formData,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (data) {
            if (data.success == true) {
                jQuery(function ($) {
                    $("#fm_card_update_info")[0].reset();
                    $("#txt_photo_student").attr("src", "");
                });
                showCardView();
                showCardViewList();
                notyf.success(data.message);
            } else {
                notyf.error(data.errors.photo[0]);
            }
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${xhr.error || "Unknown error"}`
            );
        },
    });
});
$("#fileUploadProfileStu").on("change", function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $(".profile-image img").attr("src", e.target.result);
        };
        reader.readAsDataURL(file);
    }
});

$("body").on("click", "#btn_diable_view_info_print", function (e) {
    const stu_code = $(this).data("stu_code");
    const dept_code = $(this).data("dept_code");
    const class_code = $(this).data("class_code");

    $("#hidden_disable_stu_code").val(stu_code);
    $("#hidden_disable_dept_code").val(dept_code);
    $("#hidden_diable_class_code").val(class_code);
});
$("body").on("click", "#btn_card_disable_active", function (e) {
    const requestData = {
        stu_code: $("#hidden_disable_stu_code").val(),
        dept_code: $("#hidden_disable_dept_code").val(),
        class_code: $("#hidden_diable_class_code").val(),
    };
    $.ajax({
        url: "/certificate/disable_student_info",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (data) {
            if (data.success == true) {
                showCardView();
                showCardViewList();
                notyf.success(data.message);
            } else {
                notyf.error(data.message);
            }
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${
                    xhr.statusText || "Unknown error"
                }`
            );
        },
    });
});
$txt_up_date_card.on("change", function () {
    const requestData = {
        date: $(this).val(),
    };
    $.ajax({
        url: "/certificate/show_change_date_print_card",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (data) {
            $("#txt_up_khmer_lunar").val(data.date_lunar);
            $("#txt_up_date_create").val(`រាជធានីភ្នំពេញុ, ${data.date_khmer}`);
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${
                    xhr.statusText || "Unknown error"
                }`
            );
        },
    });
});

$("body").on("click", "#btn_upload_zip_photo", function (e) {
    let formData = new FormData();
    var fileInput = $("#zipFile")[0].files[0];
    if (!fileInput) {
        notyf.error("សូមជ្រើសរើស File Upload ប្រភេទ Zip");
        return false;
    }
    formData.append("zipFile", fileInput);
    formData.append("dept_code", dept_code);
    $.ajax({
        url: "/certificate/upload_zip_photo",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        data: formData,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (data) {
            if (data.status == 200) {
                $("#fm_up_card_base_option")[0].reset();
                $(".modal-select2").modal("hide");

                notyf.success(data.message);
                showCardView();
            } else {
                notyf.error(data.message);
            }
        },
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${xhr.error || "Unknown error"}`
            );
        },
    });
});
$("body").on("click", "#btn_card_upload_multiple", function (e) {
    let imageNames = [];
    $("#previewContainer img").each(function () {
        let src = $(this).attr("src");
        if (src.startsWith("data:image")) {
            let filename = $(this).attr("alt") || "unnamed";
            let nameWithoutExtension = filename
                .split(".")
                .slice(0, -1)
                .join(".");
            imageNames.push({ name: nameWithoutExtension, src });
        }
    });
    const requestData = {
        images: imageNames,
    };
    $.ajax({
        url: "/certificate/upload_multiple_photo",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (data) {},
        error: function (xhr, status, error) {
            notyf.error(
                `Error submitting class code: ${
                    xhr.statusText || "Unknown error"
                }`
            );
        },
    });
});
$("body").on("change", "#up_type_option", function (e) {
    var option = $(this).val();
    if (option == "zip") {
        $("#up_zip").removeAttr("hidden");
        $("#up_multiple").attr("hidden", true);
    } else if (option == "multiple") {
        $("#up_multiple").removeAttr("hidden");
        $("#up_zip").attr("hidden", true);
    }
});

showCardView();
showCardViewList();

// sendAjaxRequest(
//     "/users",
//     "POST",
//     JSON.stringify({ data: 1 }),
//     function (response) {
//         console.log("Success: " + JSON.stringify(response));
//     },
//     function (xhr, status, error) {
//         alert("Error: " + xhr.responseText);
//     }
// );
