<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Settings</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
    /* Updated table styles */


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

table {
    width: 100%;
    margin: 20px 5px;
    border-collapse: collapse;
}

th, td{
    padding: 10px;
    text-align: left;
}

th {
    background-color: var(--color-primary);
    color: var(--color-white);
}

tr:nth-child(1) {
    background-color: var(--color-light);
}



.icon {
    margin-right: 5px;
}

button{
    background-color: transparent;
    border: none;
    cursor: pointer; /* Add cursor pointer for better UX */
}
.edit-button{
    color: var(--color-info-dark);
}
.edit-button:hover{
    color: var(--color-dark);
}
.delete-button{
    color: var(--color-danger);
}

.delete-button:hover{
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
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 250px;
}

.modal-content button{
    background-color: var(--color-primary); /* Set background color */
    color: var(--color-white); /* Set text color */
}

.modal-content input,
.modal-content button {
    margin: 5px;
    padding: 10px;
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




    </style>
</head>
<body>

    <section id="budget">
        <div class="fill"></div>
        <h1>Budget Settings</h1>
        
        <!-- Add a form for users to add custom budget categories -->
     <!-- Modified custom category form with icons dropdown -->

            <div class="budget-table">

                <form id="custom-category-form">
                    <input type="text" id="category-name" placeholder="Category Name" required>
                    <select id="category-icon" required>
                        <option value="" disabled selected>Select Icon</option>
                        <option value="attach_money">attach_money</option>
                        <option value="shopping_cart">shopping_cart</option>
                        <option value="headset_mic">headset_mic</option>
                        <option value="restaurant">restaurant</option>
                        <option value="sports_esports">sports_esports</option>
                        <option value="commute">commute</option>
                        <option value="local_pharmacy">local_pharmacy</option>
                        <option value="fitness_center">fitness_center</option>
                        <option value="school">school</option>
                        <option value="card_giftcard">card_giftcard</option>
                        <option value="savings">savings</option>
                        <!-- Add more options for other icons -->
                    </select>
                    <input type="number" id="category-amount" placeholder="Budget Amount" required>
                    <button type="submit">Add Category</button>
                </form>

                <div id="modal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Update Budget</h2>
                        <input type="number" id="new-amount" placeholder="New Budget Amount" required>
                        <button id="update-btn">Update</button>
                    </div>
                </div>
                

                <table>
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Budget</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="budget-categories">
                        <!-- Overall Budget row -->
                        <tr>
                            <td><i class="material-icons-sharp icon">attach_money</i>Overall Budget</td>
                            <td>$5000</td>
                            <td>
                                <button class="edit-button"><i class="material-icons-sharp">edit</i></button>
                            </td>
                            
                        </tr>
                        <!-- Individual Category rows -->
                        <tr>
                            <td><i class="material-icons-sharp icon">attach_money</i>Music</td>
                            <td>$100</td>
                            <td>
                                <button class="edit-button"><i class="material-icons-sharp">edit</i></button>
                                <button class="delete-button"><i class="material-icons-sharp">delete</i></button>
                            </td>
                            
                        </tr>
                        <tr>
                            <td><i class="material-icons-sharp icon">restaurant</i>Restaurant</td>
                            <td>$200</td>
                            <td>
                                <button class="edit-button"><i class="material-icons-sharp">edit</i></button>
                                <button class="delete-button"><i class="material-icons-sharp">delete</i></button>
                            </td>
                                             
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
    </section>
<script>
    // Function to handle form submission for adding custom category
document.getElementById('custom-category-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    // Get user input
    const categoryName = document.getElementById('category-name').value;
    const categoryIcon = document.getElementById('category-icon').value;
    const categoryAmount = document.getElementById('category-amount').value;

    // Create HTML elements for the new category
    const categoryElement = document.createElement('tr');
    categoryElement.innerHTML = `
        <td><i class="material-icons-sharp icon">${categoryIcon}</i>${categoryName}</td>
        <td>$${categoryAmount}</td>
        <td>
            <button class="edit-button"><i class="material-icons-sharp">edit</i></button>
            <button class="delete-button"><i class="material-icons-sharp">delete</i></button>
        </td>
    `;

    // Add the new category to the budget categories list
    document.getElementById('budget-categories').appendChild(categoryElement);

    // Clear form fields
    document.getElementById('category-name').value = '';
    document.getElementById('category-icon').value = '';
    document.getElementById('category-amount').value = '';

    // Attach event listener to the newly created edit button
    const newEditButton = categoryElement.querySelector('.edit-button');
    newEditButton.addEventListener('click', function() {
        modal.style.display = 'block';
    });
});

// Get the modal
const modal = document.getElementById('modal');

// Get the <span> element that closes the modal
const closeBtn = document.querySelector('.close');

// Close the modal when the user clicks on <span> (x)
closeBtn.onclick = function() {
    modal.style.display = 'none';
};

// Close the modal when the user clicks anywhere outside of the modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};

// Handle update button click
document.getElementById('update-btn').addEventListener('click', function() {
    const newAmount = document.getElementById('new-amount').value;
    // Update the budget amount here (replace this comment with your code)
    modal.style.display = 'none';
});

// Get all existing edit buttons and attach event listeners
const editButtons = document.querySelectorAll('.edit-button');
editButtons.forEach(button => {
    button.addEventListener('click', function() {
        modal.style.display = 'block';
    });
});

</script>
    
</body>
</html>
