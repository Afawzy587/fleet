var kmlog_chart = document.getElementById("monthly_kmLog");
var kmLogChart = new Chart(kmlog_chart, {
    type: 'bar',
    data: {
        labels: ["Jan", "Feb", "Mar", "April", "May", "June"],
        datasets: [{
            label: 'الحد الأقصي',
            data: [20, 3, 5, 6, 2, 1],
            backgroundColor: '#a3a1fb',
            borderWidth: 0
        },
        {
            label: 'كم فعلي',
            data: [12, 19, 5, 2, 5, 6,],
            backgroundColor: '#ff9300',
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        barRoundness: 1,
        scales: {
            xAxes: [{
                barPercentage: 1,
                categoryPercentage: 0.6
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var kmCostlog_chart = document.getElementById("monthly_kmCostlog");
var kmCostLogChart = new Chart(kmCostlog_chart, {
    type: 'bar',
    data: {
        labels: ["Jan", "Feb", "Mar", "April", "May", "June"],
        datasets: [{
            label: 'الحد الأقصي',
            data: [20, 3, 5, 6, 2, 1],
            backgroundColor: '#a3a1fb',
            borderWidth: 0
        },
        {
            label: 'كم فعلي',
            data: [12, 19, 5, 2, 5, 6,],
            backgroundColor: '#ff9300',
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        barRoundness: 1,
        scales: {
            xAxes: [{
                barPercentage: 1,
                categoryPercentage: 0.6
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


var fuellog_chart = document.getElementById("fuellog");
var fuellogChart = new Chart(fuellog_chart, {
    type: 'bar',
    data: {
        labels: ["Jan", "Feb", "Mar", "April", "May", "June"],
        datasets: [{
            label: 'الحد الأقصي',
            data: [20, 3, 5, 6, 2, 1],
            backgroundColor: '#a3a1fb',
            borderWidth: 0
        },
        {
            label: 'كم فعلي',
            data: [12, 19, 5, 2, 5, 6,],
            backgroundColor: '#ff9300',
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        barRoundness: 1,
        scales: {
            xAxes: [{
                barPercentage: 1,
                categoryPercentage: 0.6
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var charts = {
    kmlog_chart: kmLogChart,
    kmCostlog_chart: kmCostLogChart,
    fuellog_chart: fuellogChart,
}

var startDate;
var endDate;

function update_barChart_startdate(chartname, date) {
    startDate = date.value;
    console.log(chartname + ' ' + startDate + " " + endDate);
    update_barChart(chartname, startDate, endDate);
}

function update_barChart_enddate(_chartname, date) {
    endDate = date.value;
    console.log(_chartname + ' ' + startDate + " " + endDate);
    update_barChart(_chartname, startDate, endDate);
}

function update_barChart(chart_name, startdate, enddate) {
    console.log(chart_name);
    var currentChart = charts[chart_name];
    console.log(currentChart);
    currentChart.config.data.labels = [];
    currentChart.config.data.labels = ['April', 'May', 'June', 'July', 'aug'];
    currentChart.data.datasets[0].data = [5, 9, 13, 4, 8];
    currentChart.data.datasets[1].data = [8, 2, 10, 7, 3];
    console.log(currentChart.config.data);
    currentChart.update();
}

// modal_view
function update_barChart_view(chart_name, view_option){
    console.log(chart_name +' '+ view_option.value);
    var currentChart = charts[chart_name];
    console.log(currentChart);
    currentChart.config.data.labels = [];
    currentChart.config.data.labels = ['April', 'May', 'June', 'July', 'aug'];
    currentChart.data.datasets[0].data = [5, 9, 13, 4, 8];
    currentChart.data.datasets[1].data = [8, 2, 10, 7, 3];
    console.log(currentChart.config.data);
    currentChart.update();
}
