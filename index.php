<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Dark mode toggle script -->
    <script>
        function toggleDarkMode() {
            const body = document.body;
            body.classList.toggle("dark-mode");
        }
    
       
    //Add Expense function
        function addExpense() {
            $.ajax({
                url: 'process.php',
                type: 'POST',
                data: $('#expense-form').serialize(),
                success: function() {
                    // Reload the expense history table container
                    $('#expense-history-container').load('index.php #expense-history', function() {
                        // Recalculate the total after reloading
                        calculateTotal();
                    });
                    // Clear the form fields
                    $('#date').val('');
                    $('#income').val('');
                    $('#expense').val('');
                    $('#note').val(''); // Clear the note field
                    $('#category').val(''); // Reset category field
                }
            });
        }

        // ... (Existing code for sorting, calculating total, and checkbox handling)
   
        // Function to sort the table by a specific column
        function sortTable(columnIndex) {
            const table = document.getElementById('expense-table');
            const rows = Array.from(table.rows).slice(1); // Exclude the header row
            rows.sort((row1, row2) => {
                const cell1 = row1.cells[columnIndex].textContent;
                const cell2 = row2.cells[columnIndex].textContent;

                // For date column (index 0)
                if (columnIndex === 0) {
                    const date1 = new Date(cell1);
                    const date2 = new Date(cell2);
                    return date1 - date2;
                }

                // For numeric columns (index 1 and 2, income and expense)
                if (columnIndex === 1 || columnIndex === 2) {
                    const value1 = parseFloat(cell1.replace('€', '').replace(',', '')) || 0;
                    const value2 = parseFloat(cell2.replace('€', '').replace(',', '')) || 0;
                    return value1 - value2;
                }

                // For other columns (text sorting)
                return cell1.localeCompare(cell2);
            });

            // Clear the current table
            while (table.rows.length > 2) { // Exclude the header row and the "Total Expense" row
                table.deleteRow(1);
            }

            // Append sorted rows back to the table
            rows.forEach(row => {
                if (!row.classList.contains('total-row')) { // Exclude the "Total Expense" row
                    table.appendChild(row);
                }
            });
        }

        // Function to calculate the total for selected expenses
        function calculateTotal() {
            const selectedExpenses = document.querySelectorAll('input[name="select-expense"]:checked');
            let totalIncome = 0;
            let totalExpense = 0;

            selectedExpenses.forEach(expense => {
                const row = expense.closest('tr');
                const incomeCell = row.cells[1];
                const expenseCell = row.cells[2];

                // Get the text content of income and expense cells
                const incomeText = incomeCell.textContent;
                const expenseText = expenseCell.textContent;

                // Parse income and expense values (remove '€' and commas, parseFloat)
                const income = parseFloat(incomeText.replace('€', '').replace(',', '').trim()) || 0;
                const expenseAmount = parseFloat(expenseText.replace('€', '').replace(',', '').trim()) || 0;

                totalIncome += income;
                totalExpense += expenseAmount;
            });

        // Update the total values
        document.getElementById('selected-total-income').textContent = 'Total Income: €' + totalIncome.toFixed(2);
        document.getElementById('selected-total-expense').textContent = 'Total Expense: €' + totalExpense.toFixed(2);
    }

        // Call the calculateTotal function initially to calculate the total
        calculateTotal();




        // Function to handle checkbox clicks
        function handleCheckboxClick(checkbox) {
            // Recalculate the total when checkboxes are selected or deselected
            calculateTotal();
        }

        // Updated removeSelectedExpenses function
        function removeSelectedExpenses() {
            const selectedExpenses = document.querySelectorAll('input[name="select-expense"]:checked');
            const expensesToDelete = [];

            selectedExpenses.forEach(expense => {
                expensesToDelete.push(expense.value);
            });

            if (expensesToDelete.length === 0) {
                alert("No expenses selected for removal.");
                return;
            }

            if (confirm("Are you sure you want to remove the selected expenses?")) {
                // Send a GET request to delete.php for each selected expense
                expensesToDelete.forEach(rowToDelete => {
                    fetch('delete.php?row=' + rowToDelete, {
                        method: 'GET'
                    })
                    .then(response => {
                        if (response.ok) {
                            // Successfully removed the expense, refresh the page
                            location.reload();
                        } else {
                            // Handle errors if needed
                            console.error('Error removing expense');
                        }
                    })
                    .catch(error => {
                        console.error('Error removing expense:', error);
                    });
                });
            }
        }


        // New downloadCSV function
        function downloadCSV() {
    // Read the CSV data from the server
    $.ajax({
        url: 'download.php',
        type: 'GET',
        success: function (data) {
            // Generate a unique filename with the current date and time
            const currentDateTime = new Date().toISOString().replace(/[-:.]/g, "");
            const filename = `expenses_${currentDateTime}.csv`;

            // Create a Blob containing the CSV data
            const blob = new Blob([data], { type: 'text/csv' });

            // Create a temporary URL for the Blob
            const url = window.URL.createObjectURL(blob);

            // Create a hidden <a> element for downloading
            const a = document.createElement('a');
            a.href = url;
            a.download = filename; // Use the generated filename

            // Trigger a click event on the <a> element to start the download
            a.style.display = 'none';
            document.body.appendChild(a);
            a.click();

            // Clean up by revoking the Blob URL
            window.URL.revokeObjectURL(url);
        }
    });
}


        </script>

        <script>
                // Function to load categories from JSON file and populate the dropdown
                function loadCategories() {
                    fetch('categories.json') // Replace with the correct path to your JSON file
                    .then(response => response.json())
                    .then(data => {
                        const categoryDropdown = document.getElementById('category');
                        data.forEach(category => {
                            const option = document.createElement('option');
                            option.value = category;
                            option.textContent = category;
                            categoryDropdown.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error loading categories:', error);
                    });
                }

                // Call the function to load categories when the page loads
                loadCategories();
        </script>
    

</head>
<body>
    <div class="container">
    <h1 class="mt-5 text-center">Expense Tracker</h1>

    <!-- Dark Mode Toggle Button -->
    <button class="btn btn-dark mode-toggle-btn" onclick="toggleDarkMode()"><i class="fas fa-moon"></i> <!-- Moon icon for dark mode --> Toggle Dark Mode</span></button>
    
    
 
        <form method="post" action="process.php" class="mt-4" id="expense-form">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <div class="form-group">
                <label for="income">Income (€):</label>
                <input type="number" name="income" id="income" class="form-control">
            </div>

            <div class="form-group">
                <label for="expense">Expense (€):</label>
                <input type="number" name="expense" id="expense" class="form-control">
            </div>

            <!-- New input field for note -->
            <div class="form-group">
                <label for="note">Note:</label>
                <input type="text" name="note" id="note" class="form-control">
            </div>


            <!-- Inside the form -->
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" class="form-control">
                </select>
            </div>

            <!-- Add Button -->
            <button type="button" class="btn btn-primary" onclick="addExpense()"><i class="fas fa-solid fa-plus fa-beat-fade"></i> Add Expense</button>
          
            <!-- Refresh Button -->
            <button type="button" class="btn btn-secondary ml-2" onclick="location.reload()"><i class="fas fa-solid fa-arrows-rotate fa-beat-fade"></i> Refresh </button>

        </form>

        <h2 class="mt-4">Expense History</h2>

        <!-- Select All Checkbox -->
        <div class="mb-2">
            <label>Select All: </label>
            <input type="checkbox" id="select-all-checkbox" onchange="selectAll()">
        </div>


        <!-- Expense History Table Container -->
        <div id="expense-history-container">
                    <table class="table table-striped mt-3" id="expense-table">
                        <thead>
                            <tr>
                                <th onclick="sortTable(0)">Date <i class="fas fa-sort"></i></th>
                                <th onclick="sortTable(1)">Income (€) <i class="fas fa-sort"></i></th>
                                <th onclick="sortTable(2)">Expense (€) <i class="fas fa-sort"></i></th>
                                <th>Note</th> <!-- Note column -->
                                <th>Category</th> <!-- Category column -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (($handle = fopen("expenses.csv", "r")) !== FALSE) {
                                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                    echo "<tr>";
                                    echo "<td>" . $data[0] . "</td>";
                                    echo "<td>€" . $data[1] . "</td>";
                                    echo "<td>€" . $data[2] . "</td>";
                                    echo "<td>" . (isset($data[3]) ? $data[3] : '') . "</td>"; // Display the note or an empty string if it doesn't exist
                                    echo "<td>" . (isset($data[4]) ? $data[4] : '') . "</td>"; // Display the catagory or an empty string if it doesn't exist
                                    echo "<td><input type='checkbox' name='select-expense' value='" . $data[0] . "' onclick='handleCheckboxClick(this)'></td>";
                                    echo "</tr>";
                                }
                                fclose($handle);
                            }
                            ?>
                        </tbody>
                        <!-- Total Rows -->
                        <tfoot>
                            <tr class="total-row">
                                <td>Total:</td>
                                <td id="selected-total-income">€0.00</td>
                                <td id="selected-total-expense">€0.00</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>


        <!-- Remove Selected Button -->
        <button type="button" class="btn btn-danger mt-2" onclick="removeSelectedExpenses()"><i class="fa-solid fa-trash-can"></i> Remove Selected</button>

        <!-- Export CSV file and provide as download -->
        <button type="button" class="btn btn-secondary mt-2" onclick="downloadCSV()"><i class="fa-solid fa-floppy-disk"></i> Download CSV</button>

        <!-- Button to navigate to graph.php -->
        <a href="dashboard.php" class="btn btn-secondary mt-2"><i class="fa-solid fa-chart-simple fa-shake"></i> Go to Dashboard</a>

        <!-- Sort Buttons with Icons
        <div class="mt-2">
            <button type="button" class="btn btn-info" onclick="sortTable(1)">Sort by Income <i class="fas fa-sort"></i></button>
            <button type="button" class="btn btn-info ml-2" onclick="sortTable(2)">Sort by Expense <i class="fas fa-sort"></i></button>
            <button type="button" class="btn btn-info ml-2" onclick="sortTable(0)">Sort by Date <i class="fas fa-sort"></i></button>
        </div>
        -->

        

    </div>
    

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    // Add this function to select/deselect all checkboxes
    function selectAll() {
        const checkboxes = document.querySelectorAll('input[name="select-expense"]');
        const selectAllCheckbox = document.getElementById('select-all-checkbox');

        checkboxes.forEach((checkbox) => {
            checkbox.checked = selectAllCheckbox.checked;
        });

        // Recalculate the total when checkboxes are selected or deselected
        calculateTotal();
    }

    // ...
    </script>



</body>
</html>
