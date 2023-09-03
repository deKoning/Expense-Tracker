<?php
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $startDate = $_GET['start_date'];
    $endDate = $_GET['end_date'];
    
    // Initialize variables for data retrieval
    $labels = [];
    $incomeData = [];
    $expenseData = [];
    $totalIncome = 0;
    $totalExpense = 0;

    // Open the CSV file for reading
    if (($handle = fopen('expenses.csv', 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            $date = $row[0];
            if ($date >= $startDate && $date <= $endDate) {
                $labels[] = $date;
                $income = floatval($row[1]);
                $expense = floatval($row[2]);
                $incomeData[] = $income;
                $expenseData[] = $expense;
                $totalIncome += $income;
                $totalExpense += $expense;
            }
        }
        fclose($handle);
    }

    $data = [
        'labels' => $labels,
        'incomeData' => $incomeData,
        'expenseData' => $expenseData,
        'totalIncome' => $totalIncome,
        'totalExpense' => $totalExpense
    ];

    // Return data in JSON format
    header('Content-Type: application/json');
    echo json_encode($data);
}
?>
