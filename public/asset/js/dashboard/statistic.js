google.charts.load("current", {
    packages: ["corechart"],
});

google.charts.setOnLoadCallback(drawChart);
const studentData = window.studentCounts || [];
function drawChart() {
    const dataArray = [
        [
            "Session Year",
            "និស្សិតសរុប",
            {
                role: "annotation",
            },
            "និស្សិតស្រី",
            {
                role: "annotation",
            },
        ],
    ];

    studentData.forEach((item) => {
        const totalStudents = parseInt(item.total_students);
        const totalFemale = parseInt(item.total_female);

        dataArray.push([
            item.code,
            totalStudents,
            totalStudents.toString(),
            totalFemale,
            totalFemale.toString(),
        ]);
    });

    const data = google.visualization.arrayToDataTable(dataArray);

    const options = {
        chartArea: {
            width: "100%",
        },
        colors: ["#4285F4", "#50b763"],
        legend: {
            position: "top",
        },
        annotations: {
            alwaysOutside: true,
            textStyle: {
                fontSize: 12,
                bold: true,
                color: "#333",
            },
        },
        hAxis: {
            title: "ស្ថិតិនិស្សិតសរុបតាមឆ្នាំសិក្សាសរុប",
        },
    };

    const chart = new google.visualization.ColumnChart(
        document.getElementById("barchart_div")
    );
    chart.draw(data, options);
}

window.addEventListener("resize", drawChart);
