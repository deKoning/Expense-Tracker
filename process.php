<?php
// Function to sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = isset($_POST["date"]) ? $_POST["date"] : date("Y-m-d"); // Set to today's date if not provided
    $income = isset($_POST["income"]) ? $_POST["income"] : 0;
    $expense = isset($_POST["expense"]) ? $_POST["expense"] : 0;
    $note = isset($_POST["note"]) ? $_POST["note"] : ''; // Get the note from the form

    // Basic validation
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date) || $income < 0 || $expense < 0) {
        die("Invalid input data.");
    }

    // Open the CSV file for writing (create if not exists)
    $csvFile = fopen('expenses.csv', 'a');

    if ($csvFile === FALSE) {
        die("Error opening the CSV file.");
    }

    // Write the data to the CSV file
    $category = isset($_POST["category"]) ? $_POST["category"] : "uncategorized";
    fputcsv($csvFile, [$date, $income, $expense, $note, $category]); // Include the category


    if ($success === FALSE) {
        die("Error writing data to the CSV file.");
    }

    // Close the CSV file
    fclose($csvFile);
}

// Redirect back to index.php after form submission
header("Location: index.php");
?>
