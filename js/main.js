const chartCanvas = document.getElementById('chart');
const ctx = chartCanvas.getContext('2d');

// Initial data for week
let chartData = {
  labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
  datasets: [
    {
      label: 'Momo',
      data: [100, 200, 150, 250, 300, 200, 150],
      borderColor: "#FFCC08",
      borderWidth: 2
    },
    {
      label: 'Others',
      data: [150, 250, 200, 300, 350, 250, 200],
      borderColor: 'green',
      borderWidth: 2
    }
  ]
};

// Create chart
let myChart = new Chart(ctx, {
  type: 'line',
  data: chartData,
  options: {
    responsive: true,
    legend: {
      position: 'bottom',
      display: true,
    }
  }
});

// Event listener for radio button change
document.querySelectorAll('input[name="timePeriod"]').forEach((radio) => {
  radio.addEventListener('change', function() {
    const selectedValue = this.value;
    if (selectedValue === 'week') {
      updateChart('week');
    } else if (selectedValue === 'month') {
      updateChart('month');
    } else if (selectedValue === 'year') {
      updateChart('year');
    }
  });
});

// Function to update chart data based on time period
function updateChart(period) {
  if (period === 'week') {
    myChart.data.labels = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
    myChart.data.datasets[0].data = [100, 200, 150, 250, 300, 200, 150];
    myChart.data.datasets[1].data = [150, 250, 200, 300, 350, 250, 200];
  } else if (period === 'month') {
    myChart.data.labels = ["Week 1", "Week 2", "Week 3", "Week 4"];
    myChart.data.datasets[0].data = [800, 1200, 1000, 1500];
    myChart.data.datasets[1].data = [600, 1100, 900, 1400];
  } else if (period === 'year') {
    myChart.data.labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    myChart.data.datasets[0].data = [2000, 3000, 2500, 3500, 4000, 3000, 2500, 4500, 5000, 4000, 3500, 3000];
    myChart.data.datasets[1].data = [1800, 2800, 2300, 3300, 3800, 2800, 2300, 4300, 4800, 3800, 3300, 2800];
  }
  myChart.update();
}
