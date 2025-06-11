import { select2AdvancedModal } from "../utils/helpers";

const notyf = new Notyf({
    duration: 2000,
    ripple: true,
    dismissible: true,
    position: {
        x: "right",
        y: "top",
    },
});

const $sch_dept = $("#sch_dept");
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
var $btn_open_print_date = $("#btn_open_print_date");
var $txt_due_year = $("#txt_due_year");
var $txt_due_level = $("#txt_due_level");

let currentPage = 1;
let currentPageList = 1;

select2AdvancedModal("#txt_due_class", "#modal_card_due_date");
select2AdvancedModal("#txt_due_level", "#modal_card_create_expire_date");
select2AdvancedModal("#txt_due_year", "#modal_card_create_expire_date");

function levelShiftSkill() {
    const class_code = $sch_class_spec.val();
    const sch_level = $sch_level.val();
    const sch_shift = $sch_shift.val();
    const sch_skill = $sch_skill.val();

    const requestData = {
        dept_code: $sch_dept.val(),
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
        dept_code: $sch_dept.val(),
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
        dept_code: $sch_dept.val(),
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
        cache: true,
        success: function (response) {
            const $tbl = $("#tbl_stu_card_view");
            $tbl.empty();
            let currentPage = response.current_page;
            let rowsPerPage = response.page;
            let json = response.data;

            const fragment = document.createDocumentFragment();

            if (json && json.length > 0) {
                json.map((item, index) => {
                    let colors = item.status_print == 1 ? "#2f99d1" : "#ddd";
                    let photo =
                        item.photo_status == false
                            ? "/asset/NTTI/images/faces/default_User.jpg"
                            : `/uploads/student/${item.stu_photo}`;
                    const $row = $("<div>")
                        .addClass("col-md-4 g-2 mt-2")
                        .append(
                            $("<div>")
                                .addClass("student-card-view")
                                .css("border", `2px solid ${colors}`)
                                .append(
                                    $("<img>")
                                        .attr("src", photo)
                                        .attr("alt", "Profile Picture")
                                        .attr("width", "150")
                                        .attr("height", "200")
                                        .attr(
                                            "name",
                                            "btn_update_view_info_print"
                                        )
                                        .attr(
                                            "id",
                                            "btn_update_view_info_print"
                                        )
                                        .attr("data-stu_code", item.code)
                                        .attr(
                                            "data-dept_code",
                                            item.department_code
                                        )
                                        .attr(
                                            "data-class_code",
                                            item.class_code
                                        )
                                        .attr("data-toggle", "modal")
                                        .attr(
                                            "data-target",
                                            "#modal_card_update"
                                        )
                                )
                                .append(
                                    $("<div>")
                                        .addClass(
                                            "card-body student-information"
                                        )
                                        .append(
                                            $("<div>")
                                                .addClass("name")
                                                .text(
                                                    `${item.name_2} ${item.name}`
                                                )
                                        )
                                        .append(
                                            $("<div>")
                                                .addClass("id")
                                                .text(item.code)
                                        )
                                        .append(
                                            $("<div>")
                                                .addClass("phone")
                                                .text(item.phone_student)
                                        )
                                        .append(
                                            $("<div>")
                                                .addClass("info")
                                                .text(item.dept)
                                        )
                                        .append(
                                            $("<div>").addClass("info").html(`${
                                                item.class == null
                                                    ? "No Class"
                                                    : item.class
                                            }
                                                    <label class="${
                                                        item.class_remaining
                                                    } fw-bold" title="Expire Card">${
                                                item.expire_formate_date
                                            }</label>`)
                                        )
                                        .append($("<hr>"))
                                        .append(
                                            $("<button>")
                                                .addClass(
                                                    "btn btn-outline-info btn-sm"
                                                )
                                                .attr("type", "button")
                                                .attr(
                                                    "name",
                                                    "btn_print_card_view"
                                                )
                                                .attr(
                                                    "id",
                                                    "btn_print_card_view"
                                                )
                                                .attr(
                                                    "data-print_card_id",
                                                    item.id
                                                )
                                                .attr(
                                                    "data-stu_code",
                                                    item.code
                                                )
                                                .attr(
                                                    "data-dept_code",
                                                    item.department_code
                                                )
                                                .attr(
                                                    "data-class_code",
                                                    item.class_code
                                                )
                                                .attr("title", "បោះពុម្ភ")
                                                .attr("data-toggle", "modal")
                                                .attr(
                                                    "data-target",
                                                    "#modal_card_print_card"
                                                )
                                                .css({
                                                    "margin-right": "5px",
                                                })
                                                .html(
                                                    '<i class="mdi mdi-printer btn-icon-append"></i>'
                                                )
                                        )
                                        .append(
                                            $("<button>")
                                                .attr("type", "button")
                                                .addClass(
                                                    "btn btn-outline-danger btn-sm"
                                                )
                                                .attr("title", "បន្ថែមបោះពុម្ភ")
                                                .attr(
                                                    "name",
                                                    "btn_print_card_set_revision_view"
                                                )
                                                .attr(
                                                    "id",
                                                    "btn_print_card_set_revision_view"
                                                )
                                                .attr(
                                                    "data-print_card_id",
                                                    item.id
                                                )
                                                .attr(
                                                    "data-stu_code",
                                                    item.code
                                                )
                                                .attr(
                                                    "data-dept_code",
                                                    item.department_code
                                                )
                                                .attr(
                                                    "data-class_code",
                                                    item.class_code
                                                )
                                                .attr("data-toggle", "modal")
                                                .attr(
                                                    "data-target",
                                                    "#modal_card_print_revisino"
                                                )
                                                .attr(
                                                    "hidden",
                                                    item.status_print == 0 ||
                                                        item.status_print ==
                                                            null
                                                        ? true
                                                        : false
                                                )
                                                .append(
                                                    $("<i>").addClass(
                                                        "mdi mdi-plus btn-icon-append"
                                                    )
                                                )
                                                .css("margin-right", "5px")
                                        )
                                        .append(
                                            $("<button>")
                                                .attr("type", "button")
                                                .addClass(
                                                    "btn btn-outline-success btn-sm"
                                                )
                                                .attr("id", "btn_card_view")
                                                .attr("title", "មើល")
                                                .attr("data-toggle", "modal")
                                                .attr(
                                                    "data-target",
                                                    "#modal_card_view_detail"
                                                )
                                                .attr(
                                                    "data-stu_code",
                                                    item.code
                                                )
                                                .attr(
                                                    "data-dept_code",
                                                    item.department_code
                                                )
                                                .css({
                                                    "margin-right": "5px",
                                                })
                                                .attr(
                                                    "data-class_code",
                                                    item.class_code
                                                )
                                                .append(
                                                    $("<i>").addClass(
                                                        "mdi mdi-account-search"
                                                    )
                                                )
                                        )
                                        .append(
                                            $("<button>")
                                                .attr("type", "button")
                                                .addClass(
                                                    "btn btn-outline-primary btn-sm"
                                                )
                                                .attr("title", "កែប្រែ")
                                                .attr(
                                                    "name",
                                                    "btn_update_view_info_print"
                                                )
                                                .attr(
                                                    "id",
                                                    "btn_update_view_info_print"
                                                )
                                                .attr(
                                                    "data-stu_code",
                                                    item.code
                                                )
                                                .attr(
                                                    "data-dept_code",
                                                    item.department_code
                                                )
                                                .attr(
                                                    "data-class_code",
                                                    item.class_code
                                                )
                                                .attr("data-toggle", "modal")
                                                .attr(
                                                    "data-target",
                                                    "#modal_card_update"
                                                )
                                                .css({
                                                    "margin-right": "5px",
                                                })
                                                .append(
                                                    $("<i>").addClass(
                                                        "mdi mdi-border-color"
                                                    )
                                                )
                                        )
                                        .append(
                                            $("<button>")
                                                .attr("type", "button")
                                                .addClass(
                                                    "btn btn-outline-danger btn-sm"
                                                )
                                                .attr("title", "ដកបោះពុម្ភ")
                                                .attr(
                                                    "name",
                                                    "btn_diable_view_info_print"
                                                )
                                                .attr(
                                                    "id",
                                                    "btn_diable_view_info_print"
                                                )
                                                .attr(
                                                    "data-stu_code",
                                                    item.code
                                                )
                                                .attr(
                                                    "data-dept_code",
                                                    item.department_code
                                                )
                                                .attr(
                                                    "data-class_code",
                                                    item.class_code
                                                )
                                                .attr("data-toggle", "modal")
                                                .attr(
                                                    "data-target",
                                                    "#modal_card_disable_active"
                                                )
                                                .css({
                                                    "margin-right": "5px",
                                                })
                                                .append(
                                                    $("<i>").addClass(
                                                        "mdi mdi-shuffle-disabled"
                                                    )
                                                )
                                        )
                                        .append(
                                            $("<button>")
                                                .attr("type", "button")
                                                .addClass(
                                                    "btn btn-outline-secondary btn-rounded btn-icon pull-right"
                                                )
                                                .css({
                                                    width: "30px",
                                                    height: "30px",
                                                    "margin-right": "5px",
                                                })
                                                .append(
                                                    $("<label>")
                                                        .addClass(
                                                            "text-primary"
                                                        )
                                                        .text(
                                                            index +
                                                                1 +
                                                                (currentPage -
                                                                    1) *
                                                                    rowsPerPage
                                                        )
                                                )
                                        )
                                )
                        );

                    fragment.appendChild($row[0]);
                });
            } else {
                const $row = $("<div>")
                    .addClass("text-center")
                    .append(
                        $("<label>")
                            .addClass("text-center")
                            .text("រកមិនឃើញទិន្ន័យនៅក្នុងប្រព័ន្ធ!")
                    );
                fragment.appendChild($row[0]);
            }
            $tbl.append(fragment);
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
        dept_code: $sch_dept.val(),
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
        success: function (response) {
            const $tbl = $("#tbl_card_stu_list");
            $tbl.empty();
            let currentPage = response.current_page;
            let rowsPerPage = response.page;
            let json = response.data;
            const fragment = document.createDocumentFragment();
            if (json && json.length > 0) {
                $.each(json, function (index, item) {
                    var img =
                        item.photo_status == false
                            ? "/asset/NTTI/images/faces/default_User.jpg"
                            : `/uploads/student/${item.stu_photo}`;
                    const $row = $("<tr>");

                    $row.append(
                        $("<td>")
                            .attr("height", "40")
                            .text(index + 1 + (currentPage - 1) * rowsPerPage)
                    );
                    $row.append(
                        $("<td>").append(
                            $("<div>")
                                .addClass("hover-photo")
                                .append(
                                    $("<img>")
                                        .attr("src", img)
                                        .attr("alt", "NTTI Student")
                                        .css("cursor", "pointer")
                                        .attr("data-bs-toggle", "modal")
                                        .attr(
                                            "data-bs-target",
                                            `#imageModal-${item.code}`
                                        )
                                )
                                .append(" ")
                                .append($("<span>").text(item.code))
                        )
                    );
                    $("body").append(`
                        <div class="modal fade" id="imageModal-${item.code}" tabindex="-1" aria-labelledby="imageModalLabel-${item.code}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-m-header">
                                        <h5 class="modal-title" id="imageModalLabel-${item.code}">Student Photo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img
                                            src="${img}"
                                            alt="NTTI Student"
                                            class="img-fluid"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    $row.append($("<td>").text(item.name_2));
                    $row.append($("<td>").text(item.name));
                    $row.append($("<td>").text(item.gender));
                    $row.append($("<td>").text(item.date_of_birth ?? "No DOB"));
                    $row.append($("<td>").text(item.phone_student));
                    $row.append(
                        $("<td>").text(
                            item.class == null ? "No Class" : item.class
                        )
                    );
                    $row.append($("<td>").text(item.skill));
                    $row.append($("<td>").text(item.level));

                    $row.append(
                        $("<td>")
                            .addClass("text-center")
                            .text(item.count_revision)
                    );

                    // Status badge column
                    const $statusBadge = $("<div>")
                        .addClass("badge badge-pill mb-2 mb-md-0 me-2")
                        .addClass(
                            item.status_print == 1
                                ? "badge-success"
                                : "badge-danger"
                        )
                        .text(
                            item.status_print == 1
                                ? "បានបោះពុម្ភ"
                                : "មិនទាន់បោះពុម្ភ"
                        );
                    $row.append($("<td>").append($statusBadge));

                    // Dropdown menu
                    const $dropdown = $("<div>")
                        .addClass("dropdown")
                        .append(
                            $("<button>")
                                .attr({
                                    type: "button",
                                    id: "dropdownMenuButton",
                                    "data-bs-toggle": "dropdown",
                                    "aria-expanded": "false",
                                    title: "More Options",
                                })
                                .addClass(
                                    "btn btn-outline-secondary btn-rounded btn-icon"
                                )
                                .css({
                                    width: "35px",
                                    height: "35px",
                                    "margin-right": "5px",
                                })
                                .append(
                                    $("<i>").addClass(
                                        "mdi mdi-dots-vertical"
                                    )
                                )
                        )
                        .append(
                            $("<ul>")
                                .addClass("dropdown-menu")
                                .attr("aria-labelledby", "dropdownMenuButton")
                                .append(
                                    $("<li>").append(
                                        $("<a>")
                                            .addClass("dropdown-item")
                                            .attr({
                                                href: "javascript:void(0)",
                                                name: "btn_print_card_view",
                                                id: "btn_print_card_view",
                                                "data-print_card_id": item.id,
                                                "data-stu_code": item.code,
                                                "data-dept_code":
                                                    item.department_code,
                                                "data-class_code":
                                                    item.class_code,
                                                "data-toggle": "modal",
                                                "data-target":
                                                    "#modal_card_print_card",
                                            })
                                            .append(
                                                $("<i>").addClass(
                                                    "mdi mdi-printer btn-icon-append"
                                                ),
                                                " បោះពុម្ភ"
                                            )
                                    )
                                )
                                .append(
                                    item.status_print == 0 ||
                                        item.status_print == null
                                        ? ""
                                        : $("<li>").append(
                                              $("<a>")
                                                  .addClass("dropdown-item")
                                                  .attr({
                                                      href: "javascript:void(0)",
                                                      name: "btn_print_card_set_revision_view",
                                                      id: "btn_print_card_set_revision_view",
                                                      "data-print_card_id":
                                                          item.id,
                                                      "data-stu_code":
                                                          item.code,
                                                      "data-dept_code":
                                                          item.department_code,
                                                      "data-class_code":
                                                          item.class_code,
                                                      "data-toggle": "modal",
                                                      "data-target":
                                                          "#modal_card_print_revisino",
                                                  })
                                                  .append(
                                                      $("<i>").addClass(
                                                          "mdi mdi-plus btn-icon-append"
                                                      ),
                                                      " បន្ថែមបោះពុម្ភ"
                                                  )
                                          )
                                )
                                .append(
                                    $("<li>").append(
                                        $("<a>")
                                            .addClass("dropdown-item")
                                            .attr({
                                                href: "javascript:void(0)",
                                                title: "View Detail",
                                                id: "btn_card_view",
                                                "data-toggle": "modal",
                                                "data-target":
                                                    "#modal_card_view_detail",
                                                "data-stu_code": item.code,
                                                "data-dept_code":
                                                    item.department_code,
                                                "data-class_code":
                                                    item.class_code,
                                            })
                                            .append(
                                                $("<i>").addClass(
                                                    "mdi mdi-account-search"
                                                ),
                                                " មើល"
                                            )
                                    )
                                )
                                .append(
                                    $("<li>").append(
                                        $("<a>")
                                            .addClass("dropdown-item")
                                            .attr({
                                                href: "javascript:void(0)",
                                                title: "កែប្រែ",
                                                name: "btn_update_view_info_print",
                                                id: "btn_update_view_info_print",
                                                "data-stu_code": item.code,
                                                "data-dept_code":
                                                    item.department_code,
                                                "data-class_code":
                                                    item.class_code,
                                                "data-toggle": "modal",
                                                "data-target":
                                                    "#modal_card_update",
                                            })
                                            .append(
                                                $("<i>").addClass(
                                                    "mdi mdi-border-color"
                                                ),
                                                " កែប្រែ"
                                            )
                                    )
                                )
                                .append(
                                    $("<li>").append(
                                        $("<a>")
                                            .addClass("dropdown-item")
                                            .attr({
                                                href: "javascript:void(0)",
                                                title: "ដកបោះពុម្ភ",
                                                name: "btn_diable_view_info_print",
                                                id: "btn_diable_view_info_print",
                                                "data-stu_code": item.code,
                                                "data-dept_code":
                                                    item.department_code,
                                                "data-class_code":
                                                    item.class_code,
                                                "data-toggle": "modal",
                                                "data-target":
                                                    "#modal_card_disable_active",
                                            })
                                            .append(
                                                $("<i>").addClass(
                                                    "mdi mdi-shuffle-disabled"
                                                ),
                                                " ដកបោះពុម្ភ"
                                            )
                                    )
                                )
                        );

                    $row.append($("<td>").append($dropdown));
                    fragment.appendChild($row[0]);
                });
            } else {
                const $row = $("<div>")
                    .addClass("text-center")
                    .append(
                        $("<label>")
                            .addClass("text-center")
                            .attr("colspan", 4)
                            .attr("height", 40)
                            .text("រកមិនឃើញទិន្ន័យនៅក្នុងប្រព័ន្ធ!")
                    );
                fragment.appendChild($row[0]);
            }
            $tbl.append(fragment);
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

function showCardTotalStudent() {
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
        dept_code: $sch_dept.val(),
        class_code: class_code,
    };
    $.ajax({
        url: "/certificate/card_total_student",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        success: function (data) {
            $("#tt_students").html(Number(data.total_students));
            $("#tt_students_f").html(data.total_female);
            $("#tt_students_m").html(data.total_male);

            $("#total_status_1").html(data.total_status_1);
            $("#total_female_status_1").html(data.total_female_status_1);
            $("#total_male_status_1").html(data.total_male_status_1);

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

function showExpireClass() {
    $loader
        .css({
            position: "fixed",
            top: "50%",
            left: "50%",
            transform: "translate(-50%, -50%)",
            "z-index": "1111",
        })
        .fadeIn("slow");

    const level_code = $("#txt_due_level").val();
    const class_code = $("#txt_due_class").val();
    const $tbl = $("#tbl_view_expire");
    const $tbody = $("#tbl_view_expire tbody");
    const totalColumns = $tbl.find("thead th").length;
    const fragment = document.createDocumentFragment();
    const requestData = {
        level_code: level_code,
        class_code: class_code,
    };
    $.ajax({
        url: "/certificate/student_card/expire/show",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        beforeSend: function () {},
        success: function (response) {
            if (response && response.length > 0) {
                $.each(response, function (index, item) {
                    let classData = item.class;
                    let isHiddenUpdate = item.updated_by;

                    const $row = $("<tr>");
                    $row.append(
                        $("<td>")
                            .attr("height", "40")
                            .text(index + 1)
                    );
                    $row.append($("<td>").text(classData.qualification.name_3));
                    $row.append($("<td>").text(classData.name));
                    $row.append($("<td>").text(`ឆ្នាំទី ${item.year}`));
                    $row.append($("<td>").text(item.expire_date));
                    $row.append($("<td>").text(item.print_expire_date));
                    $row.append(
                        $("<td>").append(
                            $("<div>")
                                .append(
                                    $("<button>", {
                                        type: "button",
                                        class: "btn btn-outline-secondary btn-rounded btn-icon",
                                        css: {
                                            width: "30px",
                                            height: "30px",
                                            "margin-right": "5px",
                                        },
                                    }).append(
                                        $("<label>", {
                                            class: "text-primary",
                                            html: `<i class="mdi mdi-account-check"></i>`,
                                        })
                                    )
                                )
                                .append(
                                    $("<label>", {
                                        class: "text-primary",
                                        html:
                                            item.created_by.name +
                                            ":" +
                                            item.create_by_date,
                                    })
                                )
                        )
                    );
                    if (isHiddenUpdate == null) {
                        $row.append(
                            $("<td>").append(
                                $("<label>", {
                                    class: "text-primary",
                                    html: "---",
                                })
                            )
                        );
                    } else {
                        $row.append(
                            $("<td>").append(
                                $("<div>")
                                    .append(
                                        $("<button>", {
                                            type: "button",
                                            class: "btn btn-outline-secondary btn-rounded btn-icon",
                                            css: {
                                                width: "30px",
                                                height: "30px",
                                                "margin-right": "5px",
                                            },
                                        }).append(
                                            $("<label>", {
                                                class: "text-primary",
                                                html: `<i class="mdi mdi-account-check"></i>`,
                                            })
                                        )
                                    )
                                    .append(
                                        $("<label>", {
                                            class: "text-primary",
                                            html:
                                                item.updated_by.name +
                                                ":" +
                                                item.update_by_date,
                                        })
                                    )
                            )
                        );
                    }

                    fragment.appendChild($row[0]);
                });
            } else {
                const $row = $("<tr>");
                $row.append(
                    $("<td>")
                        .attr("height", "40")
                        .attr("colspan", totalColumns)
                        .addClass("text-center")
                        .append(
                            $("<label>").text("រកមិនឃើញទិន្ន័យនៅក្នុងប្រព័ន្ធ!")
                        )
                );
                fragment.appendChild($row[0]);
            }

            $tbody.html(fragment);
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

$("#fm_search_student input").keydown(function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
    }
});

$sch_dept.on("change", function () {
    levelShiftSkill();
    showCardTotalStudent();
    currentPage = 1;
    showCardView();

    currentPageList = 1;
    showCardViewList();
});
$sch_class_spec.on("change", function () {
    levelShiftSkill();
    showCardTotalStudent();
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

// $btn_search.on("click", function () {
//     currentPage = 1;
//     showCardView();

//     currentPageList = 1;
//     showCardViewList();
// });
$("#sch_info_student").on("keyup", function () {
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
    const print_card_id = $(this).data("print_card_id");
    const stu_code = $(this).data("stu_code");
    const dept_code = $(this).data("dept_code");
    const class_code = $(this).data("class_code");

    $("#hidden_print_card_id").val(print_card_id);
    $("#hidden_stu_code").val(stu_code);
    $("#hidden_dept_code").val(dept_code);
    $("#hidden_class_code").val(class_code);
});

$("body").on("click", "#btn_print_card", function (e) {
    e.preventDefault();
    const requestData = {
        print_card_id: $("#hidden_print_card_id").val(),
        stu_code: $("#hidden_stu_code").val(),
        dept_code: $("#hidden_dept_code").val(),
        class_code: $("#hidden_class_code").val(),
    };
    $.ajax({
        url: "/certificate/print_card",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        async: true,
        success: function (response) {
            jQuery(function ($) {
                const printContainer = $("<div>").html(response);
                $("body").append(printContainer);
                printContainer.printThis({
                    importCSS: false,
                    importStyle: false,
                    removeInline: true,
                    base: false,
                    formValues: true,
                    iframe: true,
                    debug: false,
                });
                printContainer.remove();
            });
        },
        complete: function () {
            //showCardTotalStudent();
            // showCardView();
            // showCardViewList();
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

$("body").on("click", "#btn_print_card_set_revision_view", function (e) {
    const print_card_id = $(this).data("print_card_id");
    const stu_code = $(this).data("stu_code");
    const dept_code = $(this).data("dept_code");
    const class_code = $(this).data("class_code");

    $("#hidden_revision_print_card_id").val(print_card_id);
    $("#hidden_revision_stu_code").val(stu_code);
    $("#hidden_revision_dept_code").val(dept_code);
    $("#hidden_revision_class_code").val(class_code);
});

$("body").on("click", "#btn_print_set_revision", function (e) {
    const requestData = {
        print_card_id: $("#hidden_revision_print_card_id").val(),
        stu_code: $("#hidden_revision_stu_code").val(),
        dept_code: $("#hidden_revision_dept_code").val(),
        class_code: $("#hidden_revision_class_code").val(),
    };
    $.ajax({
        url: "/certificate/print_card_revision",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        async: true,
        success: function (response) {
            notyf.success(response.message);
        },
        complete: function () {
            showCardTotalStudent();
            showCardView();
            showCardViewList();
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
        success: function (data) {
            $("#txt_up_view_name").html(data.name);
            $("#txt_up_view_id").html(data.code);
            $("#txt_up_view_class").html(data.class);
            $("#txt_up_view_skill").html(data.skill);
            $("#txt_up_view_level").html(data.level);
            $("#txt_up_view_shift").html(data.section_type);
            $("#txt_up_view_expire_card").html(
                data.print_expire_date == 0 ? "N/A" : data.print_expire_date
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
$("body").on("click", "#btn_card_view", function (e) {
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
        success: function (data) {
            $("#txt_view_name").html(data.name);
            $("#txt_view_id").html(data.code);
            $("#txt_view_class").html(data.class);
            $("#txt_view_skill").html(data.skill);
            $("#txt_view_level").html(data.level);
            $("#txt_view_shift").html(data.section_type);
            $("#txt_view_expire_card").html(
                data.print_expire_date == "0" ? "N/A" : data.print_expire_date
            );

            $("#txt_view_fullname_kh").html(data.name_2);
            $("#txt_view_fullname_eng").html(data.name);
            $("#txt_view_dob").html(data.date_of_birth);
            $("#txt_view_class_1").html(data.class);
            $("#txt_view_phone").html(data.phone_student);
            $("#txt_view_skill_1").html(data.skill);
            $("#txt_view_email").html(data.email);
            $("#txt_view_gender").html(data.gender);
            $("#txt_view_addr").html(data.student_address);
            $("#txt_view_dept").html(data.dept);

            $("#txt_view_father").html(data.father_name);
            $("#txt_view_father_phone").html(data.father_phone);
            $("#txt_view_father_job").html(data.father_occupation);

            $("#txt_view_mother").html(data.mother_name);
            $("#txt_view_mother_phone").html(data.mother_phone);
            $("#txt_view_mother_job").html(data.mother_occupation);

            $("#txt_guardian_name").html(data.guardian_name);
            $("#txt_guardian_phone").html(data.guardian_phone);
            $("#txt_guardian_occupation").html(data.guardian_occupation);
            $("#txt_guardian_address").html(data.guardian_address);

            var img =
                data.photo_status == false
                    ? "/asset/NTTI/images/faces/default_User.jpg"
                    : `/uploads/student/${data.stu_photo}`;
            $("#txt_view_photo").attr("src", img);
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
    if (fileInput) {
        formData.append("photo", fileInput);
    } else {
        notyf.error("សូមជ្រើសរើសរូបថត");
        return false;
        formData.append("photo", null);
    }

    $.ajax({
        url: "/certificate/upload_student_info",
        type: "POST",
        processData: false,
        contentType: false,
        cache: true,
        async: true,
        data: formData,
        success: function (data) {
            if (data.success == true) {
                $("#modal_card_update .btn-close").trigger("click");
                $("#fileUploadProfileStu").val("");
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
        success: function (data) {
            if (data.success == true) {
                showCardTotalStudent();
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
        success: function (data) {
            $("#txt_up_khmer_lunar").val(data.date_lunar);
            $("#txt_up_date_create").val(`រាជធានីភ្នំពេញ, ${data.date_khmer}`);
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
$("#sl_due_expire_date").on("change", function () {
    const requestData = {
        date: $(this).val(),
    };
    $.ajax({
        url: "/certificate/show_change_date_print_card",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        success: function (data) {
            $("#txt_due_expire_date").val(data.date_lunar);
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
    let up_type_option = $("#up_type_option").val();
    let formData = new FormData();
    var fileInput = $("#zipFile")[0].files[0];

    if (!fileInput && up_type_option == "zip") {
        notyf.error("សូមជ្រើសរើសឯកសារ ZIP");
        return false;
    }

    formData.append("type", up_type_option);
    formData.append("zipFile", fileInput);
    formData.append("dept_code", dept_code);

    $("#previewContainer img").each(function () {
        let base64Data = $(this).attr("src");
        let fileName = $(this).attr("data-name");

        if (!fileName && up_type_option == "multiple") {
            notyf.error("សូមជ្រើសរើសរូបថត");
            return false;
        }

        formData.append("imageSources[]", base64Data);
        formData.append("fileNames[]", fileName);
    });
    if (!up_type_option) {
        notyf.error("សូមជ្រើសរើសប្រភេទ File Upload");
        return false;
    }
    $.ajax({
        url: "/certificate/upload_zip_photo",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        data: formData,
        success: function (data) {
            if (data.status == 200) {
                $("#fm_up_card_base_option")[0].reset();
                $("#modal_card_upload_zip_photo .btn-close").trigger("click");

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

// $("body").on("click", "#btn_print_card_pdf", function (e) {
//     e.preventDefault();

//     const stu_code = $(this).data("stu_code");
//     const dept_code = $(this).data("dept_code");
//     const class_code = $(this).data("class_code");

//     const requestData = {
//         stu_code: stu_code,
//         dept_code: dept_code,
//         class_code: class_code,
//     };

//     const newTab = window.open("", "_blank");

//     $.ajax({
//         url: "/certificate/print_card_pdf",
//         type: "GET",
//         contentType: "application/json",
//         data: JSON.stringify(requestData),
//         success: function (response) {

//             newTab.location.href = "/certificate/generateTranscript"
//             // if (response.pdf_url) {
//             //     newTab.location.href = "/certificate/generateTranscript"
//             // } else {
//             //     newTab.close();
//             //     alert("Error generating PDF.");
//             // }
//         },
//         complete: function () {
//             showCardView();
//             showCardViewList();
//         },
//         error: function (xhr, status, error) {
//             notyf.error(
//                 `Error submitting class code: ${
//                     xhr.statusText || "Unknown error"
//                 }`
//             );
//         },
//     });
// });
$("body").on("click", "#btn_print_card_pdf", function (e) {
    e.preventDefault();

    const stu_code = $(this).data("stu_code");
    const dept_code = $(this).data("dept_code");
    const class_code = $(this).data("class_code");

    const url = `/certificate/print_card_pdf?stu_code=${stu_code}&dept_code=${dept_code}&class_code=${class_code}`;

    window.open(url, "_blank");
});

$("#txt_due_date").on("change", function () {
    const requestData = {
        date: $(this).val(),
    };
    $.ajax({
        url: "/certificate/show_change_date_print_card",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        success: function (data) {
            $("#txt_due_khmer_lunar").val(data.date_lunar);
            $("#txt_due_date_create").val(`រាជធានីភ្នំពេញ, ${data.date_khmer}`);
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

$("#modal_card_due_date").on(
    "click",
    "#btn_due_date_this_session",
    function (e) {
        let print_khmer_lunar = $("#txt_due_khmer_lunar").val();
        let txt_due_date_create = $("#txt_due_date_create").val();
        let txt_due_expire_date = $("#txt_due_expire_date").val();
        const requestData = {
            session_code: $("#session_code").val(),
            print_date: $("#txt_due_date").val(),
            print_khmer_lunar: print_khmer_lunar,
            print_date_due: txt_due_date_create,
            print_expire_date: txt_due_expire_date,
        };
        let isValid = true;

        let fields = ["#txt_due_khmer_lunar", "#txt_due_date_create"];

        fields.forEach(function (selector) {
            let field = $(selector);
            if ($.trim(field.val()) === "") {
                field.css("border", "2px solid red");
                isValid = false;
            } else {
                field.css("border", "");
            }
        });
        if (!isValid) {
            return false;
        }
        $.ajax({
            url: "/certificate/card_due_date",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(requestData),
            success: function (data) {
                if (data.status == 200) {
                    notyf.success(data.message);
                    $("#fm_card_due_date")[0].reset();
                    $("#modal_card_due_date .btn-close").trigger("click");
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
    }
);
$("#modal_card_due_date").on(
    "click",
    "#btn_update_date_this_session",
    function (e) {
        let print_khmer_lunar = $("#txt_due_khmer_lunar").val();
        let txt_due_date_create = $("#txt_due_date_create").val();
        let txt_due_expire_date = $("#txt_due_expire_date").val();
        const requestData = {
            session_code: $("#session_code").val(),
            print_date: $("#txt_due_date").val(),
            print_khmer_lunar: print_khmer_lunar,
            print_date_due: txt_due_date_create,
            print_expire_date: txt_due_expire_date,
        };
        let isValid = true;

        let fields = ["#txt_due_khmer_lunar", "#txt_due_date_create"];

        fields.forEach(function (selector) {
            let field = $(selector);
            if ($.trim(field.val()) === "") {
                field.css("border", "2px solid red");
                isValid = false;
            } else {
                field.css("border", "");
            }
        });
        if (!isValid) {
            return false;
        }
        $.ajax({
            url: "/certificate/card_due_date_update",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(requestData),
            success: function (data) {
                if (data.status == 200) {
                    notyf.success(data.message);
                    $("#fm_card_due_date")[0].reset();
                    $("#modal_card_due_date .btn-close").trigger("click");
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
    }
);
$("#modal_card_create_expire_date").on(
    "click",
    "#btn_due_expire_card",
    function (e) {
        let txt_due_level = $("#txt_due_level").val();
        let txt_due_class = $("#txt_due_class").val();
        let sl_due_expire_date = $("#sl_due_expire_date").val();
        let txt_due_expire_date = $("#txt_due_expire_date").val();
        let year = $("#txt_due_year").val();
        const requestData = {
            session_code: $("#session_code").val(),
            level: txt_due_level,
            class_code: txt_due_class,
            year: year,
            expire_date: sl_due_expire_date,
            print_expire_date: txt_due_expire_date,
        };

        let isValid = true;

        let fields = [
            "#txt_due_level",
            "#txt_due_class",
            "#sl_due_expire_date",
            "#txt_due_expire_date",
        ];

        fields.forEach(function (selector) {
            let field = $(selector);
            if ($.trim(field.val()) === "") {
                field.css("border", "2px solid red");
                isValid = false;
            } else {
                field.css("border", "");
            }
        });

        let selectFields = [
            "#txt_due_level",
            "#txt_due_class",
            "#txt_due_year",
        ];
        selectFields.forEach(function (selector) {
            let field = $(selector);
            let select2Container = field.next(".select2-container");

            if ($.trim(field.val()) === "") {
                select2Container
                    .find(".select2-selection")
                    .css("border", "2px solid red");
                isValid = false;
            } else {
                select2Container.find(".select2-selection").css("border", "");
            }
        });
        if (!isValid) {
            return false;
        }
        $.ajax({
            url: "/certificate/card_due_expire",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(requestData),
            success: function (data) {
                if (data.status == 200) {
                    notyf.success(data.message);
                    showExpireClass();
                    showCardView();
                    showCardViewList();
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
    }
);
$("#modal_card_create_expire_date").on(
    "click",
    "#btn_due_update_expire_card",
    function (e) {
        let txt_due_level = $("#txt_due_level").val();
        let txt_due_class = $("#txt_due_class").val();
        let sl_due_expire_date = $("#sl_due_expire_date").val();
        let txt_due_expire_date = $("#txt_due_expire_date").val();
        const requestData = {
            session_code: $("#session_code").val(),
            level: txt_due_level,
            class_code: txt_due_class,
            expire_date: sl_due_expire_date,
            print_expire_date: txt_due_expire_date,
        };

        let isValid = true;

        let fields = [
            "#txt_due_level",
            "#txt_due_class",
            "#sl_due_expire_date",
            "#txt_due_expire_date",
        ];

        fields.forEach(function (selector) {
            let field = $(selector);
            if ($.trim(field.val()) === "") {
                field.css("border", "2px solid red");
                isValid = false;
            } else {
                field.css("border", "");
            }
        });

        let selectFields = ["#txt_due_level", "#txt_due_class"];
        selectFields.forEach(function (selector) {
            let field = $(selector);
            let select2Container = field.next(".select2-container");

            if ($.trim(field.val()) === "") {
                select2Container
                    .find(".select2-selection")
                    .css("border", "2px solid red");
                isValid = false;
            } else {
                select2Container.find(".select2-selection").css("border", "");
            }
        });
        if (!isValid) {
            return false;
        }
        $.ajax({
            url: "/certificate/card_due_expire_update",
            type: "PUT",
            contentType: "application/json",
            data: JSON.stringify(requestData),
            success: function (data) {
                if (data.status == 200) {
                    notyf.success(data.message);
                    // $("#fm_card_expire_date")[0].reset();
                    // $("#modal_card_create_expire_date .btn-close").trigger(
                    //     "click"
                    // );
                    showExpireClass();
                    showCardView();
                    showCardViewList();
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
    }
);

function generateDateExpire() {
    let level = $txt_due_level.val();
    let year = $txt_due_year.val();
    const requestData = {
        level: level,
        year: parseInt(year),
    };
    $.ajax({
        url: "/certificate/card_expire_show_level",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        beforeSend: function () {
            $("#txt_due_class").empty();
        },
        success: function (data) {
            let card = data.record_level;
            let formattedDate = new Date(data.record_date)
                .toISOString()
                .split("T")[0];
            $("#sl_due_expire_date").val(formattedDate);
            $("#txt_due_expire_date").val(data.record_exp_year);

            $("#txt_due_class").append(
                new Option("ជ្រើសរើសក្រុមទាំងអស់", "code_all", true, false)
            );

            $.map(data.record_level, function (item) {
                $("#txt_due_class").append(
                    new Option(item.name, item.code, false, false)
                );
            });
            select2AdvancedModal(
                "#txt_due_class",
                "#modal_card_create_expire_date"
            );

            showExpireClass();
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
function generateDateExpireBaseYear() {
    let level = $txt_due_level.val();
    let year = $txt_due_year.val();
    const requestData = {
        level: level,
        year: parseInt(year),
    };
    $.ajax({
        url: "/certificate/card_expire_show_level",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        beforeSend: function () {},
        success: function (data) {
            let card = data.record_level;
            let formattedDate = new Date(data.record_date)
                .toISOString()
                .split("T")[0];
            $("#sl_due_expire_date").val(formattedDate);
            $("#txt_due_expire_date").val(data.record_exp_year);

            showExpireClass();
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

$("#modal_card_create_expire_date").on(
    "change",
    "#txt_due_level",
    function (e) {
        generateDateExpire();
    }
);
$("#modal_card_create_expire_date").on("change", "#txt_due_year", function (e) {
    generateDateExpireBaseYear();
});
$("#modal_card_create_expire_date").on(
    "change",
    "#txt_due_class",
    function (e) {
        showExpireClass();
    }
);

$("body").on("click", "#btn_open_expire_date", function (e) {
    $("#modal_card_create_expire_date").modal("toggle");
    showExpireClass();
});

$btn_open_print_date.on("click", function (e) {
    const requestData = {
        session_code: $("#session_code").val(),
    };
    $.ajax({
        url: "/certificate/card_due_date_show",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        beforeSend: function () {
            $("#modal_card_due_date").modal("toggle");
        },
        success: function (data) {
            if (data.status == 200) {
                $("#txt_due_khmer_lunar").val(data.data.print_khmer_lunar);
                $("#txt_due_date_create").val(data.data.print_date_due);
            }
        },
        error: function (xhr, status, error) {
            notyf.error(xhr.statusText);
        },
    });
});

showCardView();
showCardViewList();
showCardTotalStudent();
