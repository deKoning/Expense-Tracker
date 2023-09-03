<?php
// Set the HTTP response headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="expenses.csv"');

// Read the CSV file and output it to the response
readfile('expenses.csv');
?>
