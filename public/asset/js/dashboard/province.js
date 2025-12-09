// Load Google Charts
google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawProvinceChart);

function drawProvinceChart() {
    if (!window.student_per_province) {
        console.warn("No student province data found!");
        return;
    }

    const dataArray = [["Province", "សិស្ស", { role: "annotation" }]];

    // Add annotation (total_students) for display on each bar
    window.student_per_province.forEach((item) => {
        const total = parseInt(item.total_students);
        dataArray.push([
            item.bakdop_province || "ផ្សេង",
            total,
            total.toString(), // This will be shown as label
        ]);
    });

    const data = google.visualization.arrayToDataTable(dataArray);

    const options = {
        title: "ស្ថិតិនិស្សិតសរុបតាមខេត្ត",
        hAxis: {
            textStyle: { fontSize: 12, bold: true, color: "#333" },
        },
        vAxis: {
            title: "ចំនួននិស្សិត",
            minValue: 0,
            textStyle: { fontSize: 12 },
        },
        chartArea: { width: "100%", height: "70%" },
        legend: { position: "none" },
        colors: ["#4C9F70"],
        bar: { groupWidth: "70%" },
        annotations: {
            alwaysOutside: true,
            textStyle: {
                fontSize: 12,
                bold: true,
                color: "#000",
            },
        },
    };

    const chart = new google.visualization.ColumnChart(
        document.getElementById("province_bar_chart")
    );
    chart.draw(data, options);
}
