<!DOCTYPE html>
<html lang="en">
<head>
     
    <?php include "../function/select_category_fxn.php";?> 
    <?php include "../function/transaction_fxn.php"; 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);?>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <!-- MATERIAL CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="../css/style.css" />
    <style>

        /* ============= Transactions Page ============ */

        .transactions-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .expenditure_chart {
            width: 40%; /* Adjust width as needed */
            margin-right: 50px;
        }

        .transaction-form {
            width: 48%; /* Adjust width as needed */
        }

        @media (max-width: 768px) {
            .transactions-top {
                flex-direction: column;
            }

            .expenditure_chart,
            .transaction-form {
                width: 100%;
            }
        }

        .transactions-section {
            /* margin-top: 2rem; */
            padding: 50px;
        }

        .transactions-section h2 {
            margin-bottom: 0.8rem;
        }


        .transactions-section table{
        width: 80%;
        margin: 20px 20px;
        }

        .transactions-section table {
        width: 90%;
        margin: 20px 5px;
        border-collapse: collapse;
        }

        .transactions-section table th, td{
        padding: 10px;
        text-align: left;
        }

        .transactions-section table th {
        background-color: var(--color-primary);
        color: var(--color-white);
        }

        /* .transactions-section table tr:nth-child(1) {
        background-color: var(--color-light);
        }
        */


        .transactions-section table .icon {
        margin-right: 5px;
        }

        .transactions-section table button{
        background-color: transparent;
        border: none;
        cursor: pointer; /* Add cursor pointer for better UX */
        }
        .transactions-section table .edit-button{
        color: var(--color-info-dark);
        }
        .transactions-section table .edit-button:hover{
        color: var(--color-dark);
        }
        .transactions-section table .delete-button{
        color: var(--color-danger);
        }

        .transactions-section table .delete-button:hover{
        color: #d44450;
        }



        /* .transactions-section table {
            background: var(--color-white);
            width: 100%;
            border-radius: var(--card-border-radius);
            padding: var(--card-padding);
            text-align: center;
            box-shadow: var(--box-shadow);
            transition: all 300ms ease;
        }

        .transactions-section table:hover {
            box-shadow: none;
        }

        table tbody td {
            height: 2.8rem;
            border-bottom: 1px solid var(--color-light);
            color: var(--color-dark-variant);
        }

        table tbody tr:last-child td {
            border: none;
        }

        .transactions-section a {
            text-align: center;
            display: block;
            margin: 1rem auto;
            color: var(--color-primary);
        } */

        /* Styles for Transaction Form */
        /* ================ TRANSACTION FORM ================ */
        .transaction-form {
            margin-bottom: 2rem;
            width: 300px;
        }

        .transaction-form input,
        .transaction-form select {
            margin-bottom: 1rem;
            padding: 0.5rem;
            width: 100%;
            box-sizing: border-box;
            border-radius: 10px;
        }

        .transaction-form button {
            background-color: var(--color-primary);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 15px;
        } 


           /* Style the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Black background with opacity */
            overflow: auto;
        }
        /* Modal content */
        .modal-content {
            background-color: var(--color-white);
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 220px;
        }

        .modal-content button{
            background-color: var(--color-primary); /* Set background color */
            color: var(--color-white); /* Set text color */
        }

         .modal-content input,
         .modal-content button {
            margin: 5px;
            padding: 5px;
            border: 1px solid var(--color-primary); /* Add border for better visibility */
            border-radius: 15px;
        }

        /* Close button */
         .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

         .close:hover,
         .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        h2 {
        font-size: 1.2rem;
        }
      
    </style>
</head>
<body>
    <div class="fill"></div>

    <h1>All Transactions</h1>
    <div class="transactions-section">
        <div class="transactions-top">
            <!-- Transaction Form -->
            <div class="transaction-form">
                <h2>Add Transaction</h2>
                <form id="addTransactionForm" action ="../action/transaction_user_action.php" method ="post">
                    <label for="amount">Amount:</label>
                    <input type="text" id="amount" name="amount" required>

                    <label for="transactionDate">Transaction Date:</label>
                    <input type="date" id="transactionDate" name="transactionDate" required>

                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" required>

                    <label for="transactionType">Transaction Type:</label>
                    <select id="transactionType" name="transactionType" required>
                    <option value="" disabled selected>Category</option>
                    <?php
                    foreach ($q_result as $category) {  
                        echo "<option value=".$category['CategoryName'].">".$category['CategoryName']."</option>"; 
                    }
                    ?>
                    </select>
                    <button type="submit" name ="submit" >Add Transaction</button>
                </form>
            </div>
            <div class="expenditure_chart" style="width: 50%;">
                <canvas id="expenditure_chart"></canvas>
            </div>
        </div>


        
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Edit Transaction</h2>
                <form id="edit-form">
                    <input type="hidden" id="transaction-id" name="transaction_id">
                    <label for="amount">Amount:</label>
                    <input type="number" id="amount" name="amount" required>
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" required>
                    <button type="button" id="update-btn">Update</button>
                </form>
            </div>
        </div>

        <div id="modal2" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Are you sure you want to delete this transaction?</h2>
                <form id="question-form">
                    <button type="button" id="accept-btn">Yes</button>
                    <button type="button" id="reject-btn">No</button>
                </form>
            </div>
        </div>
        <!-- Transaction Table -->
        <h2>Transactions</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="transactionTableBody">
           
                <?php 
                display_table();
               
                 ?>
                    <!-- Transactions will be dynamically added here -->
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>       
    
    <script>
    function openEditModal(transactionId) {
        var modal = document.getElementById("modal");
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText); // Log the response for debugging
                var transaction = JSON.parse(xhr.responseText);
                console.log(transaction); // Log the parsed transaction object

                // Get the elements within the modal
                var transactionIdInput = modal.querySelector("#transaction-id");
                var amountInput = modal.querySelector("#amount");
                var dateInput = modal.querySelector("#date");
                var descriptionInput = modal.querySelector("#description");

                // Update the values of the inputs based on transaction data
                transactionIdInput.value = transaction.TransactionID;
                amountInput.value = transaction.Amount;
                dateInput.value = transaction.TransactionDate;
                descriptionInput.value = transaction.Description;

                modal.style.display = "block";
            }
        };
        xhr.open("GET", "../action/get_transaction_details.php?transaction_id=" + transactionId, true);
        xhr.send();
    }

    function deleteTransaction(transactionId) {
        event.preventDefault(); 
        var modal = document.getElementById("modal2");
        modal.style.display = "block";

        var acceptBtn = document.getElementById("accept-btn");
        var rejectBtn = document.getElementById("reject-btn");

        // Add event listeners to the buttons in the modal
        acceptBtn.addEventListener("click", function() {
            // Send the request to delete the transaction
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    console.log(xhr.responseText); // Log the response for debugging
                    if (xhr.status == 200) {
                        // Reload the page after successful deletion
                        window.location.reload();
                    } else {
                        alert("Error deleting transaction. Please try again.");
                    }
                }
            };
            xhr.open("POST", "../action/delete_transaction.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("transaction_id=" + transactionId);
            console.log(transactionId);

            // Close the modal
            modal.style.display = "none";
        });

        rejectBtn.addEventListener("click", function() {
            // Close the modal without deleting the transaction
            modal.style.display = "none";
        });
    }

    // Close the modal when clicking on the close button
    document.querySelectorAll('.modal .close').forEach(function(closeBtn) {
        closeBtn.addEventListener('click', function() {
            this.closest('.modal').style.display = 'none';
        });
    });

    // Close the modal when clicking outside the modal
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    });

    document.getElementById("update-btn").addEventListener("click", function() {
        event.preventDefault(); 
        var formData = new FormData(document.getElementById("edit-form"));
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Reload the page after successful update
                window.location.reload();
            }
        };
        xhr.open("POST", "../action/update_transaction.php", true);
        xhr.send(formData);
    });

    var deleteButtons = document.getElementsByClassName("delete-button");
    Array.from(deleteButtons).forEach(function(button) {
        button.addEventListener("click", function() {
            var transactionId = this.getAttribute("data-id");
            deleteTransaction(transactionId);
        });
    });


        //****************  EXPENSES CHART  *********************************************************************
        document.addEventListener("DOMContentLoaded", function() {
    fetch('../function/fetch_transaction_data.php')
    .then(response => response.json())
    .then(data => {
        const ctx1 = document.getElementById('expenditure_chart').getContext('2d');
       
        // Check if all total amounts are zero
        const allZero = data.data.every(amount => amount === 0);

        if (allZero) {
            // Display a message to the user
            const message = document.createElement('p');
            message.textContent = 'No transactions have been done and no budget has been used.';
            document.body.appendChild(message);
        } else {
            // Prepare chart data
            const chartData = {
                labels: data.labels,
                datasets: [{
                    label: 'Total Amount Spent',
                    data: data.data,
                    backgroundColor: generateColors(data.labels.length),
                    borderWidth: 1
                }]
            };

            // Chart configuration
            const config = {
                type: 'doughnut',
                data: chartData,
                options: {
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            };

            // Create the chart
            const expenditure_chart = new Chart(ctx1, config);
        }
    })
    .catch(error => console.error('Error fetching data:', error));
});

function generateColors(numColors) {
    const colors = [];
    for (let i = 0; i < numColors; i++) {
        const hue = (i * (360 / numColors)) % 360;
        colors.push(`hsl(${hue}, 70%, 50%)`);
    }
    return colors;
}

    
</script>



    <script src="../js/index.js"></script>
</body>
</html>
