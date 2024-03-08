const sideMenu = document.querySelector("aside");
const themeToggler = document.querySelector(".theme-toggler");

const menuBtn = document.querySelector('#menu-btn');
const closeBtn = document.querySelector('#close-btn');
const sidebar = document.querySelector('aside');

// Function to show the sidebar
function showSidebar() {
    sidebar.style.display = 'block';
}

// Function to hide the sidebar
function hideSidebar() {
    sidebar.style.display = 'none';
}

// Function to toggle sidebar visibility based on screen size
function toggleSidebar() {
    // Check screen size
    if (window.innerWidth >= 768) {
        // Always show sidebar when screen is above 786
        showSidebar();
    } else {
        // Toggle sidebar visibility using menuBtn and closeBtn
        sidebar.style.display = sidebar.style.display === 'block' ? 'none' : 'block';
    }
}

// Initial toggle based on screen size
toggleSidebar();

// Toggle sidebar when menu button is clicked
menuBtn.addEventListener('click', () => {
    toggleSidebar();
});

// Close sidebar when close button is clicked
closeBtn.addEventListener('click', () => {
    hideSidebar();
});

// Update sidebar visibility on window resize
window.addEventListener('resize', () => {
    toggleSidebar();
});



// change theme
themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
})



//****************  EXPENSES CHART  *********************************************************************

const ctx1 = document.getElementById('expenditure_chart').getContext('2d');

const expenditureData = {
    labels: ['Music', 'Restaurant', 'Games', 'Transportation', 'Pharmacy', 'Fitness', 'Shopping', 'Lending', 'School Fees', 'Gift', 'Savings'],
    datasets: [{
        label: 'Budget',
        data: [100, 200, 150, 80, 120, 90, 180, 70, 250, 50, 300],
        backgroundColor: [
            'rgba(255, 99, 132, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(255, 206, 86, 0.8)',
            'rgba(75, 192, 192, 0.8)',
            'rgba(153, 102, 255, 0.8)',
            'rgba(255, 159, 64, 0.8)',
            'rgba(0, 255, 0, 0.8)',
            'rgba(0, 0, 255, 0.8)',
            'rgba(255, 0, 255, 0.8)',
            'rgba(128, 128, 128, 0.8)',
            'rgba(0, 128, 128, 0.8)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(0, 255, 0, 1)',
            'rgba(0, 0, 255, 1)',
            'rgba(255, 0, 255, 1)',
            'rgba(128, 128, 128, 1)',
            'rgba(0, 128, 128, 1)'
        ],
        borderWidth: 1
    }]
};

const config = {
    type: 'bar',
    data: expenditureData,
    options: {
        plugins: {
            legend: {
                display: false // Hide legend
            }
        },
        scales: {
            x: {
                grid: {
                    display: false // Hide x-axis gridlines
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Spending'
                },
                beginAtZero: true
            }
        },
        indexAxis: 'y' // Horizontal bar chart
    }
};

const expenditure_chart = new Chart(ctx1, config);






//****************  DASHBOARD CHART  *********************************************************************

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





//**********   Transactions   **********************************************************************************

      // Dummy JavaScript content
        // You can replace this with your actual data fetching and rendering logic
        const transactions = [
            // Your transactions data here
        ];

        // Function to populate the transaction table
        function populateTransactions() {
            const transactionTableBody = document.getElementById('transactionTableBody');

            transactions.forEach(transaction => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${transaction.transactionID}</td>
                    <td>${transaction.userID}</td>
                    <td>${transaction.amount}</td>
                    <td>${transaction.transactionDate}</td>
                    <td>${transaction.description}</td>
                    <td>${transaction.transactionType}</td>
                `;
                transactionTableBody.appendChild(row);
            });
        }

        // Function to handle form submission
        function handleFormSubmit(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);
            const newTransaction = {};

            for (const [key, value] of formData.entries()) {
                newTransaction[key] = value;
            }

            // Dummy function to add the new transaction to the transactions array
            addTransaction(newTransaction);

            // Clear form fields after submission
            form.reset();
        }

        // Dummy function to add a new transaction to the transactions array
        function addTransaction(transaction) {
            // Add logic to push the new transaction to the transactions array
            transactions.push(transaction);

            // Re-populate the transaction table after adding the new transaction
            populateTransactions();
        }

        // Call the function to populate transactions
        populateTransactions();

        // Add event listener to the form for form submission
        const addTransactionForm = document.getElementById('addTransactionForm');
        addTransactionForm.addEventListener('submit', handleFormSubmit);
        
        
// ******************************************************************************************************************fill orders in table
// Orders.forEach(order => {
//     const tr = document.createElement('tr');
//     const trContent = `
//                         <td>${order.productName}</td>
//                         <td>${order.productNumber}</td>
//                         <td>${order.paymentStatus}</td>
//                         <td class="${order.shipping === 'Declined' ? 'danger' : order.shipping === 'pending' ? 'warning' : 'primary'}">${order.shipping}</td>
//                         <td class="primary">Details</td>
//                         `;
//     tr.innerHTML = trContent;
//     document.querySelector('table tbody').appendChild(tr);

// })