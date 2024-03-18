<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "../settings/core.php";?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
      <!-- MATERIAL CDN -->
      <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="../css/style.css" />
    <style>

        /* ==================== RECENT TRANSACTIONS ================ */
      
        .recent-transactions {
            width:100%;
            min-width: 450px;
            max-width: 900px; /* Set maximum width for better readability */
            padding: 20px 5px; /* Adjust padding as needed */
        }

        .recent-transactions .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .recent-transactions .header a {
            display: flex;
            align-items: center;
            color: var(--color-primary);
            margin-right: 25px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Adjust column width as needed */
            grid-gap: 0px; /* Adjust gap between grid items */
        }

        .transaction {
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 1.5rem var(--card-padding);
            border-radius: var(--card-border-radius);
            transition: all 300ms ease;
            cursor: pointer;
            max-width: 200px;
        }

        .transaction:hover {
            background: var(--color-white);
        }

        .service {
            display: flex;
            gap: 1rem;
        }

        .icon {
            padding: var(--padding-2);
            border-radius: var(--border-radius-1);
            display: flex;
            align-items: center;
        }

        /********************* CANVAS CHART *****************/

        .dashboard-main .graph {
        position: relative;
        }

        .dashboard-main canvas#chart {
        background: var(--color-white);
        max-width: 100%;
        margin-top: 2rem;
        border-radius: var(--card-border-radius);
        padding: var(--card-padding);
        position: relative; /* Ensure the canvas is positioned relative to its container */
        }

        .dashboard-main .graph h2 {
        position: absolute;
        top: 10px;
        left: 3.5%;
        }

        .dashboard-main .toggle-buttons {
        position: absolute;
        top: 10px; /* Adjust the top position as needed */
        right: 10px; /* Adjust the right position as needed */
        transform-origin: top right; /* Set the origin for scaling */
        transform: scale(1); /* Initial scale */
        display: flex;
        margin-top: 5px;
        transition: transform 0.3s ease; /* Add smooth transition */
        }

        .dashboard-main .toggle-buttons input[type="radio"] {
        display: none;
        }

        .dashboard-main .toggle-buttons label {
        padding: 3px 5px;
        margin: 0 5px;
        background-color: var(--color-light);
        border-radius: 5px;
        cursor: pointer;
        }

        .dashboard-main .toggle-buttons label:hover {
        background-color: var(--color-info-light);
        }

        .dashboard-main .toggle-buttons input[type="radio"]:checked + label {
        background-color: var(--color-primary);
        color: white;
        }

        /* Example: Scale the toggle buttons when the graph is scaled */
        .dashboard-main.scaled .toggle-buttons {
        transform: scale(0.8); /* Adjust the scale as needed */
        }


        /* ================== dashboard page ==================== */

        .dashboard-main{
          margin-right: 5rem;
        }

        .dashboard-main .date {
        display: inline-block;
        background: var(--color-light);
        border-radius: var(--border-radius-1);
        margin-top: 1rem;
        padding: 0.5rem 1.6rem;
        }

        .dashboard-main .date input[type="date"] {
        background: transparent;
        color: var(--color-dark);
        }

        .dashboard-main .insights {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.6rem;
        }

        .dashboard-main .insights > div {
        background: var(--color-white);
        padding: var(--card-padding);
        border-radius: var(--card-border-radius);
        margin-top: 1rem;
        box-shadow: var(--box-shadow);
        transition: all 300ms ease;
        }

        .dashboard-main .insights > div:hover {
        box-shadow: none;
        }

        .dashboard-main .insights > div span {
        background: var(--color-primary);
        padding: 0.5rem;
        border-radius: 50%;
        color: var(--color-white);
        font-size: 2rem;
        }

        .dashboard-main .insights > div.expenses span {
        background: var(--color-danger);
        }

        .dashboard-main .insights > div.income span {
        background: var(--color-success);
        }

        .dashboard-main .insights > div .middle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        }

        .dashboard-main .insights h3 {
        margin: 1rem 0 0.6rem;
        font-size: 1rem;
        }

        .dashboard-main .insights .progress {
        position: relative;
        width: 92px;
        height: 92px;
        border-radius: 50%;
        }

        .dashboard-main .insights svg {
        width: 7rem;
        height: 7rem;
        }

        .dashboard-main .insights svg circle {
        fill: none;
        stroke: var(--color-primary);
        stroke-width: 14;
        stroke-linecap: round;
        transform: translate(5px, 5px);
        }

        .dashboard-main .insights .sales svg circle {
        stroke-dashoffset: -30;
        stroke-dasharray: 100;
        }

        .dashboard-main .insights .expenses svg circle {
        stroke-dashoffset: 20;
        stroke-dasharray: 50;
        }

        .dashboard-main .insights .income svg circle {
        stroke-dashoffset: 35;
        stroke-dasharray: 10;
        }

        .dashboard-main .insights .progress .number {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        }

        .dashboard-main .insights small {
        margin-top: 1.3rem;
        display: block;
        }
    </style>
</head>
<body>
    <div class="fill"></div>
    <div class="dashboard-main">
      <h1>Dashoard</h1>

      <div class="insights">
        <div class="sales">
          <span class="material-icons-sharp">analytics</span>
          <div class="middle">
            <div class="left">
              <h3>Total Budget</h3>
              <!-- PHP to display the total budget calculated in the budget creation page -->
              <h1>
              <?php 
               // Checking if total budget is set in session
                if (isset($_SESSION['totalbudget'])) {
                    $totalbudget = $_SESSION['totalbudget'];
                    echo "₵ ".$totalbudget;
                  } 
                    else {
                      echo "Error fetching total budget";}
                ?>
              </h1>           
            
            </div>
          </div>
        </div>
        <!------------ END OF SALES -------------->
        <div class="expenses">
          <span class="material-icons-sharp">bar_chart</span>
          <div class="middle">
            <div class="left">
              <h3>Total Expenses</h3>
              <h1>
              <?php 
                if (isset($_SESSION['totalTransactionAmount'])) {
                  $totalTransactionAmount = $_SESSION['totalTransactionAmount'];
                  echo "₵ ".$totalTransactionAmount;
              } else {
                  echo "Total transaction is not being fetched well properly";
              }
                ?>
              </h1>  
            </div>
            <!-- <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>62%</p>
              </div>
            </div> -->
          </div>
        </div>
        <!------------ END OF EXPENSES -------------->
        <!-- <div class="income">
          <span class="material-icons-sharp">stacked_line_chart</span>
          <div class="middle">
            <div class="left">
              <h3>Total Savings</h3>
              <h1>$10,864</h1>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>44%</p>
              </div>
            </div>
          </div>
          <small class="text-muted">Last 24 Hours</small>
        </div> -->
        <!------------ END OF INCOME -------------->
      </div>
      <!------------ END OF INSIGHTS -------------->
      
      <div class="graph">
        <canvas id="chart"></canvas>
        <h2 class="chart-header">Money Flow</h2>
        <div id="toggleButtons" class="toggle-buttons">
          <input type="radio" id="week" name="timePeriod" value="week" checked> <label for="week">Week</label>
          <input type="radio" id="month" name="timePeriod" value="month"> <label for="month">Month</label>
          <input type="radio" id="year" name="timePeriod" value="year"> <label for="year">Year</label>
        </div>
      </div>
      
    </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
   document.addEventListener("DOMContentLoaded", function() {
    //****************  DASHBOARD CHART  *********************************************************************
    const chartCanvas = document.getElementById('chart');
    const ctx = chartCanvas.getContext('2d');

    // Function to fetch chart data from server
    function fetchChartData() {
        return fetch('../function/fetch_transaction_chart_data.php')
            .then(response => response.json())
            .catch(error => console.error('Error fetching chart data:', error));
    }

    // Function to create and update the chart
    function createChart(data) {
        // Initial data for week
        const initialData = {
            labels: data.labels.week,
            datasets: [{
                label: 'Cash Flow',
                data: data.data.week,
                borderColor: 'green',
                borderWidth: 2
            }]
        };

        // Create chart
        const myChart = new Chart(ctx, {
            type: 'line',
            data: initialData,
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
                updateChart(selectedValue);
            });
        });

        // Function to update chart data based on time period
        function updateChart(period) {
            const newData = {
                labels: data.labels[period],
                datasets: [{
                    label: 'Cash Flow',
                    data: data.data[period],
                    borderColor: 'green',
                    borderWidth: 2
                }]
            };

            myChart.data = newData;
            myChart.update();
        }
    }

    // Fetch chart data and create chart
    fetchChartData()
        .then(data => {
            createChart(data);
        });
});

</script>
<script src="../js/index.js"></script>
</body>
</html>