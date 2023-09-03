<?php
// Set the HTTP response headers for CSV download
header('Content-Type: text/csv');

// Generate a unique filename with the current date and time
$currentDateTime = date('YmdHis');
$filename = "expenses_$currentDateTime.csv";

// Set the Content-Disposition header with the generated filename
header("Content-Disposition: attachment; filename=\"$filename\"");

// Read the CSV file and output it to the response
readfile('expenses.csv');
?>
