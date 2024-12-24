const $sch_class_spec = $("#class_code");
const $sch_level = $("#sch_level");
const $sch_shift = $("#sections_code");
const $sch_skill = $("#skills_code");
const $department_code = $("#department_code");
//$department_code.attr('readonly', true);
// $department_code.prop('disabled', true);
// $sch_shift.attr('disabled', true);
$(".select2-search")
    .select2()
    .on("select2:open", function () {
        let searchField = document.querySelector(".select2-search__field");
        if (searchField) {
            searchField.focus();
        }
    });

$sch_class_spec.on("change", function () {
    levelShiftSkill();
});

function levelShiftSkill() {
    const class_code = $sch_class_spec.val();

    const requestData = {
        class_code: class_code,
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
                const recordDept = response.record_level[0].department_code;

                $sch_level.val(recordLevel);
                $sch_shift.val(recordShift);
                $sch_skill.val(recordSkill);
                $department_code.val(recordDept);
                $sch_level.select2();
                $sch_shift.select2();
                $sch_skill.select2();
                $department_code.select2();
            } else {
                //notyf.error("ក្រុមមិនទាន់មានព័ត៏មានគ្រប់គ្រាន់ទេ!");
                $sch_level.val("");
                $sch_shift.val("");
                $sch_skill.val("");
                $department_code.val("");
                $sch_level.select2();
                $sch_shift.select2();
                $sch_skill.select2();
                $department_code.select2();
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
        dept_code: window.dept_code,
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
