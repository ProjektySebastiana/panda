window.onload = function () {
    if (dataPoints) {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            backgroundColor: "transparent",
            legend: {
                fontSize: 12
            },
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "#",
                dataPoints: dataPoints
            }]
        });
        chart.render();
    }
};