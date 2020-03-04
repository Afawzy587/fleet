
$(function () {
    $("#box").sortable();
    $("#box").disableSelection();
});

var ctx = document.getElementById('myChart').getContext('2d');
var mainChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'April'],
        datasets: [{
            label: ' اخري ',
            data: [7, 12, 5, 6],
            fill: true,
            backgroundColor: ['#ff8373', '#ff8373', '#ff8373', '#ff8373'],
            borderColor: ['#ff8373'],
            borderWidth: 1
        },
        {
            label: 'الصيانة',
            data: [10, 5, 14, 6],
            backgroundColor: ['#56d9fe', '#56d9fe', '#56d9fe', '#56d9fe'],
        },
        {
            label: 'الوقود',
            data: [3, 6, 7, 2],
            backgroundColor: ['#a3a1fb', '#a3a1fb', '#a3a1fb', '#a3a1fb'],
        }]
    },
    options: {
        scales: {
            pointLabels: { fontSize: 5 },
            yAxes: [{
                stacked: true,

                ticks: {
                    beginAtZero: true,
                    fontSize: 10
                },
                gridLines: {
                    offsetGridLines: false
                }
            }],
            xAxes: [{
                barPercentage: 0.4,
                gridLines: {
                    display: false
                },
                stacked: true,
            }]
        }
        , legend: { position: 'top' },
        barRoundness: 0.5
    }
});

var startDate;
var endDate;
function update_startdate(chartname, date) {
    startDate = date.value;
    console.log(chartname + ' ' + startDate + " " + endDate);
    update(chartname, startDate, endDate)
}

function update_enddate(_chartname, date) {
    endDate = date.value;
    console.log(_chartname + ' ' + startDate + " " + endDate);
    update(_chartname, startDate, endDate)
}

function update(chart_name, startdate, enddate) {
    console.log(chart_name);
    var currentChart = charts[chart_name];
    console.log(currentChart);
    currentChart.data.labels = [];
    currentChart.data.labels.push('April', 'May', 'June', 'July', 'aug');
    currentChart.data.datasets.forEach((dataset) => {
        dataset.data = [];
        dataset.data.push(1, 20, 5, 9, 6);
    });
    currentChart.update();
}


function update_lineChart_startdate(chartname, date) {
    startDate = date.value;
    // chartName = chartname;
    console.log(chartname + ' ' + startDate + " " + endDate);
    update_lineChart(chartname, startDate, endDate);
}

function update_lineChart_enddate(_chartname, date) {
    endDate = date.value;
    // chartName = _chartname;
    console.log(_chartname + ' ' + startDate + " " + endDate);
    update_lineChart(_chartname, startDate, endDate);
}

function update_lineChart(chart_name, startdate, enddate) {
    console.log(chart_name);
    var currentChart = charts[chart_name];
    console.log(currentChart);
    currentChart.config.data.labels = ['April', 'May', 'June', 'July', 'aug'];
    currentChart.data.datasets[0].data = [5, 9, 13, 4, 8];
    console.log(currentChart.config.data);
    currentChart.update();
}


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

var fuelchart = document.getElementById("fuelChart").getContext('2d');
var myChart = new Chart(fuelchart, {
    type: 'line',
    data: {
        labels: ['April', 'May', 'June', 'July'],
        datasets: [{
            label: 'الوقود',
            data: [500, 50, 242, 140, 141], // Specify the data values array
            fill: false,
            borderColor: '#a3a1fb', // Add custom color border (Line)
            backgroundColor: '#a3a1fb', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]
    },
    options: {
        responsive: true, // Instruct chart js to respond nicely.
        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
        scales: {
            yAxes: [{
                gridLines: {
                    offsetGridLines: false
                },
                ticks: {
                    beginAtZero: true,
                    fontSize: 10
                },

                scaleLabel: {
                    display: true,
                    labelString: "الف جنية مصري",
                }
            }],
            xAxes: [{
                barPercentage: 0.4,
                gridLines: {
                    display: false
                },
            }]
        }
    }
});


var service_chart = document.getElementById("serviceChart").getContext('2d');
var ServicesChart2 = new Chart(service_chart, {
    type: 'line',
    data: {
        labels: ['April', 'May', 'June', 'July'],
        datasets: [{
            label: 'ألصيانة',
            data: [500, 50, 242, 140, 141], // Specify the data values array
            fill: false,
            borderColor: '#56d9fe', // Add custom color border (Line)
            backgroundColor: '#56d9fe', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]
    },
    options: {
        responsive: true, // Instruct chart js to respond nicely.
        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
        scales: {
            yAxes: [{
                gridLines: {
                    offsetGridLines: false
                },
                ticks: {
                    beginAtZero: true,
                    fontSize: 10
                },

                scaleLabel: {
                    display: true,
                    labelString: "الف جنية مصري",
                }
            }],
            xAxes: [{
                barPercentage: 0.4,
                gridLines: {
                    display: false
                },
            }]
        }
    }
});

var expenses_chart = document.getElementById("expensesChart").getContext('2d');
var ExpensesChart = new Chart(expenses_chart, {
    type: 'line',
    data: {
        labels: ['April', 'May', 'June', 'July'],
        datasets: [{
            label: 'مصروفات آخري',
            data: [500, 50, 242, 140, 141], // Specify the data values array
            fill: false,
            borderColor: '#ff8373', // Add custom color border (Line)
            backgroundColor: '#ff8373', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]
    },
    options: {
        responsive: true, // Instruct chart js to respond nicely.
        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
        scales: {
            yAxes: [{
                gridLines: {
                    offsetGridLines: false
                },
                ticks: {
                    beginAtZero: true,
                    fontSize: 10
                },

                scaleLabel: {
                    display: true,
                    labelString: " الف جنية مصري",
                }
            }],
            xAxes: [{
                barPercentage: 0.4,
                gridLines: {
                    display: false
                },
            }]
        }
    }
});


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
    main_chart: mainChart,
    fuel_chart: myChart,
    service_chart: ServicesChart2,
    expenses_chart: ExpensesChart,
    kmlog_chart: kmLogChart,
    kmCostlog_chart: kmCostLogChart,
    fuellog_chart: fuellogChart,
}
