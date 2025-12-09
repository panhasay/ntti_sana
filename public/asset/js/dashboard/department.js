// department-chart.js

google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    const department = window.student_per_department || [];

    const dataArray = [
        [
            "Department",
            "និស្សិតសរុប",
            { role: "annotation" },
            "និស្សិតស្រី",
            { role: "annotation" },
        ],
    ];

    department.forEach((item) => {
        const totalStudents = parseInt(item.total_students) || 0;
        const totalFemale = parseInt(item.total_female) || 0;

        dataArray.push([
            item.department,
            totalStudents,
            totalStudents.toString(),
            totalFemale,
            totalFemale.toString(),
        ]);
    });

    const data = google.visualization.arrayToDataTable(dataArray);

    const options = {
        chartArea: { width: "100%" },
        colors: ["#0cf2d8", "#f8fd03"],
        legend: { position: "top" },
        annotations: {
            alwaysOutside: true,
            textStyle: { fontSize: 12, bold: true, color: "#333" },
        },
        hAxis: {
            title: "ស្ថិតិនិស្សិតសរុបតាមដេប៉ាតឺម៉ង់",
        },
    };

    const chart = new google.visualization.ColumnChart(
        document.getElementById("barchart_department")
    );
    chart.draw(data, options);
}

// Redraw chart on window resize
window.addEventListener("resize", drawChart);
