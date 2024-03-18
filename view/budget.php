<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../function/budget_fxn.php"; 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);?>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget</title>
      <!-- MATERIAL CDN -->
      <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="../css/style.css" />
    <style>
        /********************* budgetS PAGE *****************/

        /* Style for the custom category form */
        #custom-category-form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
        }

        #category-name,
        #category-amount,
        #category-icon,
        #custom-category-form button[type="submit"] {
        padding: 10px;
        border: 1px solid var(--color-primary); /* Add border for better visibility */
        border-radius: 15px;
        }

        #category-name,
        #category-amount,
        #category-icon {
        flex: 1; /* Make input fields and select box take equal space */
        }

        #custom-category-form button[type="submit"] {
        background-color: var(--color-primary); /* Set background color */
        color: var(--color-white); /* Set text color */
        }

        #custom-category-form button[type="submit"]:hover {
        background-color: var(--color-primary-variant); /* Change background color on hover */
        }


        .budget{
        
        align-items:start;
        text-align: center; /* Center align all text */
        }

        .budget-table{
        width: 90%;
        margin: 20px 5px;
        }

        .budget-table table {
        width: 100%;
        margin: 20px 5px;
        border-collapse: collapse;
        }

        .budget-table th, td{
        padding: 10px;
        text-align: left;
        }

        .budget-table th {
        background-color: var(--color-primary);
        color: var(--color-white);
        }

        .budget-table tr:nth-child(1) {
        background-color: var(--color-light);
        }



        .budget-table .icon {
        margin-right: 5px;
        }

        .budget-table button{
        background-color: transparent;
        border: none;
        cursor: pointer; /* Add cursor pointer for better UX */
        }
        .budget-table .edit-button{
        color: var(--color-info-dark);
        }
        .budget-table .edit-button:hover{
        color: var(--color-dark);
        }
        .budget-table .delete-button{
        color: var(--color-danger);
        }

        .budget-table .delete-button:hover{
        color: #d44450;
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

        .budget-table table .edit-button{
        color: var(--color-info-dark);
        }
        .budget-table table .edit-button:hover{
        color: var(--color-dark);
        }
        .budget-table table .delete-button{
        color: var(--color-danger);
        }

        .budget-table table .delete-button:hover{
        color: #d44450;
        }

    </style>
</head>
<body>
    <div class="fill"></div>
    <h1>Budget Settings</h1>
    
    <!-- Add a form for users to add custom budgewitht categories -->
    <!-- Modified custom category form  icons dropdown -->

    <div class="budget-table">

        <form id="custom-category-form" action="../action/budget_creation_action.php" method="post">
            <input type="text" id="category-name" name="category-name" placeholder="Category Name" required>

            <input type="number" id="category-amount" name="category-amount" placeholder="Budget Amount" required>
            <button type="submit" name="submit">Add Budget</button>
        </form>


        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Budget Amount</th>
                    <th>Amount Left</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="budget-categories">
                 <?php 
                    display_budget_table();
                 ?>

            </tbody>
        </table>
    </div>

    <div id="modal_budget" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Edit Budget</h2>
                <form id="edit_budget-form">
                    <input type="hidden" id="budget-id" name="budget-id">
                    <label for="category-name">Category Name:</label>
                    <input type="text" id="category-name" name="category-name" required>
                    <label for="amount">Amount:</label>
                    <input type="number" id="amount" name="amount" required>
                    <button type="button" id="budget_update-btn">Update</button>
                </form>
            </div>
        </div>

        <div id="modal2_budget" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Are you sure you want to delete this Budget?</h2>
                <form id="question-form">
                    <button type="button" id="accept_budget-btn">Yes</button>
                    <button type="button" id="reject_budget-btn">No</button>
                </form>
            </div>
        </div>

<script>
    function openBudgetEditModal(budgetId) {
        var modal = document.getElementById("modal_budget");
        var xhr2 = new XMLHttpRequest();
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {
                console.log(xhr2.responseText); // Log the response for debugging
                var budget = JSON.parse(xhr2.responseText);
                console.log(budget); // Log the parsed budget object

                // Get the elements within the modal
                var budgetIdInput = modal.querySelector("#budget-id");
                var nameInput = modal.querySelector("#category-name");
                var amountInput = modal.querySelector("#amount");

                // Update the values of the inputs based on budget data
                budgetIdInput.value = budget.BudgetID;
                nameInput.value = budget.CategoryName;
                amountInput.value = budget.Amount;

                modal.style.display = "block";
            }
        };
        xhr2.open("GET", "../action/get_budget_details.php?budget-id=" + budgetId, true);
        xhr2.send();
    }

    function deletebudget(bugdetID) {
        event.preventDefault(); 
        var modal = document.getElementById("modal2_budget");
        modal.style.display = "block";

        var acceptBtn = document.getElementById("accept_budget-btn");
        var rejectBtn = document.getElementById("reject_budget-btn");

        // Add event listeners to the buttons in the modal
        acceptBtn.addEventListener("click", function() {
            // Send the request to delete the budget
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    console.log(xhr.responseText); // Log the response for debugging
                    if (xhr.status == 200) {
                        // Reload the page after successful deletion
                        window.location.reload();
                    } else {
                        alert("Error deleting budget. Please try again.");
                    }
                }
            };
            xhr.open("POST", "../action/delete_budget_action.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("budget-id=" + bugdetID);
            console.log(bugdetID);

            // Close the modal
            modal.style.display = "none";
        });

        rejectBtn.addEventListener("click", function() {
            // Close the modal without deleting the budget
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

    document.getElementById("budget_update-btn").addEventListener("click", function() {
        event.preventDefault(); 
        var formData = new FormData(document.getElementById("edit_budget-form"));
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Reload the page after successful update
                window.location.reload();
            }
        };
        xhr.open("POST", "../action/update_budget.php", true);
        xhr.send(formData);
    });

    var deleteButtons = document.getElementsByClassName("delete-button");
    Array.from(deleteButtons).forEach(function(button) {
        button.addEventListener("click", function() {
            var budgetID = this.getAttribute("data-id");
            deletebudget(budgetID);
        });
    });
</script>
<script src="../js/index.js"></script>
</body>
</html>