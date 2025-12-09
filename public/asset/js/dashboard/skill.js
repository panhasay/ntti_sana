// skill-chart.js

google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    const skills = window.student_per_skill || [];

    const dataArray = [
        [
            "Skill",
            "និស្សិតសរុប",
            { role: "annotation" },
            "និស្សិតស្រី",
            { role: "annotation" },
            "ចុះឈ្មោះថ្មី",
            { role: "annotation" },
            "និស្សិតស្រី",
            { role: "annotation" },
        ],
    ];

    skills.forEach((item) => {
        const totalStudents = parseInt(item.total_students) || 0;
        const totalFemale = parseInt(item.total_female) || 0;
        const newStudent = parseInt(item.new_student_registration) || 0;
        const newFemale = parseInt(item.new_female_registration) || 0;

        dataArray.push([
            item.name_2,
            totalStudents,
            totalStudents.toString(),
            totalFemale,
            totalFemale.toString(),
            newStudent,
            newStudent.toString(),
            newFemale,
            newFemale.toString(),
        ]);
    });

    const data = google.visualization.arrayToDataTable(dataArray);

    const options = {
        chartArea: { width: "100%" },
        colors: ["#4285F4", "#50b763", "#FFC107", "#E91E63"],
        legend: { position: "top" },
        annotations: {
            alwaysOutside: true,
            textStyle: { fontSize: 12, bold: true, color: "#333" },
        },
        hAxis: {
            title: "ស្ថិតិនិស្សិតសរុបតាមជំនាញ",
        },
    };

    const chart = new google.visualization.ColumnChart(
        document.getElementById("barchart_skill")
    );
    chart.draw(data, options);
}

// Redraw chart on window resize
window.addEventListener("resize", drawChart);
