var chartData = [
    {
        label: 'Prices',
        backgroundColor: 'rgba(255,99,132,0.7)',
        borderColor: 'rgb(255,99,132)',
        data: prices
    }
];

document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: chartData
        },

        options: {
            tooltips: {
                callbacks: {
                    labelColor: function(tooltipItem, chart) {
                        return {
                            borderColor: 'rgb(255, 0, 0)',
                            backgroundColor: 'rgb(255, 0, 0)'
                        }
                    }
                }
            }
        }
    });
});
