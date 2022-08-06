Chart.defaults.global.pointHitDetectionRadius = 1;
Chart.defaults.global.tooltips.enabled = false;
Chart.defaults.global.tooltips.mode = "index";
Chart.defaults.global.tooltips.position = "nearest";
Chart.defaults.global.tooltips.custom = coreui.ChartJS.customTooltips;
Chart.defaults.global.defaultFontColor = coreui.Utils.getStyle("--color", document.getElementsByClassName("c-app")[0]);
document.body.addEventListener("classtoggle", function () {
    cardChart1.data.datasets[0].pointBackgroundColor = coreui.Utils.getStyle("--primary", document.getElementsByClassName("c-app")[0]);
    cardChart2.data.datasets[0].pointBackgroundColor = coreui.Utils.getStyle("--info", document.getElementsByClassName("c-app")[0]);
    Chart.defaults.global.defaultFontColor = coreui.Utils.getStyle("--color", document.getElementsByClassName("c-app")[0]);
    cardChart1.update();
    cardChart2.update();
    mainChart.update();
});

// chart 1 ..
var label_chart_1 = document.getElementById("card-chart1").getAttribute("label");

var key_chart_1 = document.getElementById("card-chart1").getAttribute("key");
var key_chart_1_arr = key_chart_1.split(",");

var val_chart_1 = document.getElementById("card-chart1").getAttribute("val");
var val_chart_1_arr = val_chart_1.split(","); 
// end chart 1 ..

// chart 2 ..
var label_chart_2 = document.getElementById("card-chart2").getAttribute("label");

var key_chart_2 = document.getElementById("card-chart2").getAttribute("key");
var key_chart_2_arr = key_chart_2.split(",");

var val_chart_2 = document.getElementById("card-chart2").getAttribute("val");
var val_chart_2_arr = val_chart_2.split(","); 
// end chart 2 ..

// chart 3 ..
var label_chart_3 = document.getElementById("card-chart3").getAttribute("label");

var key_chart_3 = document.getElementById("card-chart3").getAttribute("key");
var key_chart_3_arr = key_chart_3.split(",");

var val_chart_3 = document.getElementById("card-chart3").getAttribute("val");
var val_chart_3_arr = val_chart_3.split(","); 
// end chart 3 ..


// chart 4 ..
var label_chart_4 = document.getElementById("card-chart4").getAttribute("label");

var key_chart_4 = document.getElementById("card-chart4").getAttribute("key");
var key_chart_4_arr = key_chart_4.split(",");

var val_chart_4 = document.getElementById("card-chart4").getAttribute("val");
var val_chart_4_arr = val_chart_4.split(","); 
// end chart 4 ..

var cardChart1 = new Chart(document.getElementById("card-chart1"), {
    type: "line",
    data: {
        labels: key_chart_1_arr,
        datasets: [
            {
                label: label_chart_1,
                backgroundColor: "transparent",
                borderColor: "rgba(255,255,255,.55)",
                pointBackgroundColor: coreui.Utils.getStyle("--primary", document.getElementsByClassName("c-app")[0]),
                data: val_chart_1_arr,
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        legend: {display: false},
        scales: {xAxes: [{gridLines: {color: "transparent", zeroLineColor: "transparent"}, ticks: {fontSize: 2, fontColor: "transparent"}}], yAxes: [{display: false, ticks: {display: false, min: 0, max: 200}}]},
        elements: {line: {borderWidth: 1}, point: {radius: 4, hitRadius: 10, hoverRadius: 4}},
    },
});
var cardChart2 = new Chart(document.getElementById("card-chart2"), {
    type: "line",
    data: {
        labels: key_chart_2_arr,
        datasets: [
            {
                label: label_chart_2,
                backgroundColor: "transparent",
                borderColor: "rgba(255,255,255,.55)",
                pointBackgroundColor: coreui.Utils.getStyle("--info", document.getElementsByClassName("c-app")[0]),
                data: val_chart_2_arr,
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        legend: {display: false},
        scales: {xAxes: [{gridLines: {color: "transparent", zeroLineColor: "transparent"}, ticks: {fontSize: 2, fontColor: "transparent"}}], yAxes: [{display: false, ticks: {display: false, min: 0, max: 200}}]},
        elements: {line: {tension: 0.00001, borderWidth: 1}, point: {radius: 4, hitRadius: 10, hoverRadius: 4}},
    },
});
var cardChart3 = new Chart(document.getElementById("card-chart3", document.getElementsByClassName("c-app")[0]), {
    type: "line",
    data: {
        labels: key_chart_3_arr,
        datasets: [{label: label_chart_3, backgroundColor: "rgba(255,255,255,.2)", borderColor: "rgba(255,255,255,.55)", data: val_chart_3_arr }],
    },
    options: {maintainAspectRatio: false, legend: {display: false}, scales: {xAxes: [{display: false}], yAxes: [{display: false}]}, elements: {line: {borderWidth: 2}, point: {radius: 0, hitRadius: 10, hoverRadius: 4}}},
});
var cardChart4 = new Chart(document.getElementById("card-chart4"), {
    type: "bar",
    data: {
        labels: key_chart_4_arr,
        datasets: [{label: label_chart_4, backgroundColor: "rgba(255,255,255,.2)", borderColor: "rgba(255,255,255,.55)", data: val_chart_4_arr, barPercentage: 0.6}],
    },
    options: {maintainAspectRatio: false, legend: {display: false}, scales: {xAxes: [{display: false}], yAxes: [{display: false}]}},
});
var mainChart = new Chart(document.getElementById("main-chart"), {
    type: "line",
    data: {
        labels: ["M", "T", "W", "T", "F", "S", "S", "M", "T", "W", "T", "F", "S", "S", "M", "T", "W", "T", "F", "S", "S", "M", "T", "W", "T", "F", "S", "S"],
        datasets: [
            {
                label: "My First dataset",
                backgroundColor: coreui.Utils.hexToRgba(coreui.Utils.getStyle("--info", document.getElementsByClassName("c-app")[0]), 10),
                borderColor: coreui.Utils.getStyle("--info", document.getElementsByClassName("c-app")[0]),
                pointHoverBackgroundColor: "#fff",
                borderWidth: 2,
                data: [165, 180, 70, 69, 77, 57, 125, 165, 172, 91, 173, 138, 155, 89, 50, 161, 65, 163, 160, 103, 114, 185, 125, 196, 183, 64, 137, 95, 112, 175],
            },
            {
                label: "My Second dataset",
                backgroundColor: "transparent",
                borderColor: coreui.Utils.getStyle("--success", document.getElementsByClassName("c-app")[0]),
                pointHoverBackgroundColor: "#fff",
                borderWidth: 2,
                data: [92, 97, 80, 100, 86, 97, 83, 98, 87, 98, 93, 83, 87, 98, 96, 84, 91, 97, 88, 86, 94, 86, 95, 91, 98, 91, 92, 80, 83, 82],
            },
            {
                label: "My Third dataset",
                backgroundColor: "transparent",
                borderColor: coreui.Utils.getStyle("--danger", document.getElementsByClassName("c-app")[0]),
                pointHoverBackgroundColor: "#fff",
                borderWidth: 1,
                borderDash: [8, 5],
                data: [65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65],
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        legend: {display: false},
        scales: {xAxes: [{gridLines: {drawOnChartArea: false}}], yAxes: [{ticks: {beginAtZero: true, maxTicksLimit: 5, stepSize: Math.ceil(250 / 5), max: 250}}]},
        elements: {point: {radius: 0, hitRadius: 10, hoverRadius: 4, hoverBorderWidth: 3}},
    },
});
