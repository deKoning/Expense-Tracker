<?php
if (isset($_GET['row'])) {
    $rowToDelete = sanitizeInput($_GET['row']);

    // Read the CSV file into an array
    $csvData = array_map('str_getcsv', file('expenses.csv'));

    // Find and remove the row to delete based on the date
    foreach ($csvData as $key => $row) {
        if ($row[0] == $rowToDelete) {
            unset($csvData[$key]);
            break;
        }
    }

    // Open the CSV file for writing (overwrite existing data)
    $csvFile = fopen('expenses.csv', 'w');

    if ($csvFile === FALSE) {
        die("Error opening the CSV file.");
    }

    // Write the updated data to the CSV file
    foreach ($csvData as $row) {
        fputcsv($csvFile, $row);
    }

    // Close the CSV file
    fclose($csvFile);

    // Redirect back to the main page with a success message
    header("Location: index.php?success=deleted");
    exit();
} else {
    // Redirect back to the main page with an error message
    header("Location: index.php?error=notfound");
    exit();
}

// Function to sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}
?>
