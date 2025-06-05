import Highcharts from "highcharts";
import Exporting from "highcharts/modules/exporting";
import ExportData from "highcharts/modules/export-data";
import Accessibility from "highcharts/modules/accessibility";
import LayoutModule from "@highcharts/dashboards/modules/layout";
import Dashboards from "@highcharts/dashboards";
import HighchartsStock from "highcharts/modules/stock";
Exporting(Highcharts);
ExportData(Highcharts);
Accessibility(Highcharts);
LayoutModule(Dashboards);
HighchartsStock(Highcharts);

function updateDateTime() {
    const now = new Date();
    const options = {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false,
        timeZone: "Asia/Phnom_Penh",
    };
    $("#dateTime").text(now.toLocaleString("en-US", options));
}

function realTime() {
    const now = new Date();
    const options = {
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false,
        timeZone: "Asia/Phnom_Penh",
    };
    $(".real-time").text(now.toLocaleString("en-US", options));
}
function showBarModal(stu_code, code_years, code_semester) {
    const modal = new bootstrap.Modal(
        document.getElementById("modal_view_subject_score")
    );
    modal.show();

    const payload = {
        stu_code: stu_code,
        code_years: code_years,
        code_semester: code_semester,
    };

    $.ajax({
        url: "/dashboard/student/score_detail",
        type: "POST",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(payload),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        cache: true,
        success: function (response) {
            const data = response.data;
            const $tbl = $("#tbl_stu_score_detail_subject");
            let html = [];
            let total = 0;

            data.forEach((item, index) => {
                total += parseFloat(item.score);

                html.push(`
                    <tr>
                        <td height="40">${index + 1}</td>
                        <td>${item.dept_name}</td>
                        <td>${item.class_code}</td>
                        <td>${item.skill_name}</td>
                        <td>${item.subject}</td>
                        <td>សាស្ត្រាចារ្យ ${item.teacher}</td>
                        <td class="text-center">${item.years}</td>
                        <td class="text-center">${item.semester}</td>
                        <td class="text-center">${item.score}</td>
                    </tr>
                `);
            });

            // Append total row
            html.push(`
                <tr>
                    <td colspan="7"></td>
                    <td class="text-right" height="40" style="background: #d0d0d0e6;">សរុប៖</td>
                    <td height="40" class="text-center">${total.toFixed(
                        2
                    )} ពិន្ទុ</td>
                </tr>
            `);

            // Update the table in one operation for better performance
            $tbl.html(html.join(""));
        },
        error: function (xhr) {
            notyf.error(xhr.responseText);
        },
    });
}

function chartStudentBar() {
    $.ajax({
        url: "/dashboard/student/bar",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            stu_code: stu_code,
        }),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (response) {
            Highcharts.chart("chart_pie_student", {
                chart: {
                    type: "pie",
                },
                title: {
                    text: "ពិន្ទុប្រចាំឆមាស",
                    align: "left",
                },
                legend: {
                    enabled: true,
                    align: "center",
                    verticalAlign: "bottom",
                    layout: "horizontal",
                    labelFormatter: function () {
                        return this.y + " ពិន្ទុ";
                    },
                },
                tooltip: {
                    headerFormat: "",
                    pointFormat:
                        '<span style="color:{point.color}">\u25cf</span> ' +
                        "{point.name}: <b>{point.y} ពិន្ទុ</b>",
                },
                accessibility: {
                    enabled: true,
                    point: {
                        valueSuffix: "%",
                    },
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        borderWidth: 2,
                        cursor: "pointer",
                        dataLabels: {
                            enabled: true,
                            format: "{point.y} ពិន្ទុ",
                            distance: 20,
                        },
                        showInLegend: true,
                    },
                },
                credits: {
                    enabled: false,
                },
                series: [
                    {
                        name: "Scores",
                        colorByPoint: true,
                        data: response.chartData,
                        events: {
                            click: function (event) {
                                const code_years = event.point.code_years;
                                const code_semester = event.point.code_semester;
                                showBarModal(
                                    stu_code,
                                    code_years,
                                    code_semester
                                );
                            },
                        },
                    },
                ],
            });

            const jsonData = response.series;

            const categories = ["ពិន្ទុ", "មធ្យមភាគ"];
            const series = jsonData.map((item) => ({
                name: item.name,
                data: item.data.map((d) => [d.score, d.average]).flat(),
                stack: item.stack,
                code_years: item.code_years,
                code_semester: item.code_semester,
                events: {
                    click: function (event) {
                        const code_years = item.code_years;
                        const code_semester = item.code_semester;
                        showBarModal(stu_code, code_years, code_semester);
                    },
                },
            }));

            Highcharts.chart("chart_bar_student", {
                chart: {
                    type: "bar",
                },
                title: {
                    text: "ពិន្ទុប្រចាំឆមាស និងមធ្យមភាគ",
                    align: "left",
                },
                xAxis: {
                    categories: categories,
                    title: {
                        text: null,
                    },
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: "Values",
                        align: "high",
                    },
                    labels: {
                        overflow: "justify",
                    },
                },
                tooltip: {
                    valueSuffix: " ពិន្ទុ",
                },
                plotOptions: {
                    bar: {
                        borderRadius: "50%",
                        dataLabels: {
                            enabled: true,
                        },
                        groupPadding: 0.1,
                    },
                },
                legend: {
                    layout: "vertical",
                    align: "right",
                    verticalAlign: "top",
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor ||
                        "#FFFFFF",
                    shadow: true,
                },
                credits: {
                    enabled: false,
                },
                series: series,
            });
        },
        error: function (xhr, status, error) {
            notyf.error(xhr.responseText);
        },
    });
}

function showAttendanceStudentDaily() {
    const payload = {
        stu_code: stu_code,
    };
    $.ajax({
        url: "/dashboard/student/attendance",
        type: "POST",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(payload),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        cache: true,
        success: function (response) {
            const $noti_att_daily = $("#noti_att_daily");
            let html = ``;
            let data = response.data[0];
            if (response.data.length != 0) {
                let object = JSON.parse(data.att);
                $noti_att_daily.removeClass("hidde");
                html += `
                <div class="info-box bg-b-green">
                    <span class="info-box-icon"><span
                            class="mdi mdi-google-classroom"></span></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ការចូលរួមសិក្សាប្រចាំថ្ងៃ</span>
                        <span class="info-box-number real-time"
                            title="${dateNowFull}">${dateNow}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                            <label class="text-danger text-bold">${
                                object.current_week_details.week_score == null
                                    ? "អវត្តមាន"
                                    : `វត្តមាន ពិន្ទុ៖ ${object.current_week_details.week_score}`
                            }</label>
                        </span>
                    </div>
                </div>`;
            } else {
                $noti_att_daily.addClass("hidde");
            }

            $noti_att_daily.html(html);
        },
        error: function (xhr, status, error) {
            notyf.error(xhr.responseText);
        },
    });
}

function showAttendanceStudentDailyDebug() {
    const studentCode = stu_code;
    $.ajax({
        url: "/dashboard/student/attendance_debug",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            stu_code: studentCode,
        }),
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "X-Requested-With": "XMLHttpRequest",
        },
        success: function (response) {},
    });
}
updateDateTime();
realTime();

// Update time every second
setInterval(updateDateTime, 1000);
setInterval(realTime, 1000);

showAttendanceStudentDaily();
chartStudentBar();
showAttendanceStudentDailyDebug();
