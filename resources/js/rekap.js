const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
        display: false,
    },
    tooltips: {
        enabled: false,
    },
    elements: {
        point: {
            radius: 0
        },
    },
    scales: {
        xAxes: [{
            gridLines: false,
            scaleLabel: false,
            ticks: {
                display: false
            }
        }],
        yAxes: [{
            gridLines: false,
            scaleLabel: false,
            ticks: {
                display: false,
                suggestedMin: 0,
                suggestedMax: 10
            }
        }]
    }
};

var ctx = document.getElementById('chart1').getContext('2d');
var chart = new Chart(ctx, {
    type: "line",
    data: {
        labels: ["1", "2", "3", "4", "5", "6", "7"],
        datasets: [{
            backgroundColor: "rgba(253, 244, 255)",
            borderColor: "rgba(232, 121, 249)",
            borderWidth: 2,
            data: [1, 3, 2, 5, 4, 5, 7],
        },],
    },
    options: chartOptions
});

var ctx = document.getElementById('chart2').getContext('2d');
var chart = new Chart(ctx, {
    type: "line",
    data: {
        labels: ["1", "2", "3", "4", "5", "6", "7"],
        datasets: [{
            backgroundColor: "rgba(236, 254, 255)",
            borderColor: "rgba(34, 211, 238)",
            borderWidth: 2,
            data: [1, 5, 4, 5, 3, 6, 3],
        },],
    },
    options: chartOptions
});

var ctx = document.getElementById('chart3').getContext('2d');
var chart = new Chart(ctx, {
    type: "line",
    data: {
        labels: ["1", "2", "3", "4", "5", "6", "7"],
        datasets: [{
            backgroundColor: "rgba(255, 251, 235)",
            borderColor: "rgba(251, 191, 36)",
            borderWidth: 2,
            data: [2, 5, 4, 6, 3, 5, 7],
        },],
    },
    options: chartOptions
});

var ctx = document.getElementById('chart4').getContext('2d');
var chart = new Chart(ctx, {
    type: "line",
    data: {
        labels: ["1", "2", "3", "4", "5", "6", "7"],
        datasets: [{
            backgroundColor: "rgba(236, 253, 245)",
            borderColor: "rgba(52, 211, 153)",
            borderWidth: 2,
            data: [1, 5, 2, 5, 3, 7, 6],
        },],
    },
    options: chartOptions
});