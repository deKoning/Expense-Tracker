<?php
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $startDate = $_GET['start_date'];
    $endDate = $_GET['end_date'];

    // Read the CSV file and filter data within the date range
    $csvData = array_map('str_getcsv', file('expenses.csv'));
    $labels = [];
    $incomePercentages = [];
    $expensePercentages = [];

    $totalIncome = 0;
    $totalExpense = 0;

    foreach ($csvData as $row) {
        $date = $row[0];
        if ($date >= $startDate && $date <= $endDate) {
            $labels[] = $date;
            $income = floatval($row[1]);
            $expense = floatval($row[2]);
            $totalIncome += $income;
            $totalExpense += $expense;

            // Calculate income and expense percentages
            $incomePercentage = ($income / ($totalIncome + $totalExpense)) * 100;
            $expensePercentage = ($expense / ($totalIncome + $totalExpense)) * 100;

            $incomePercentages[] = round($incomePercentage, 2);
            $expensePercentages[] = round($expensePercentage, 2);
        }
    }

    $data = [
        'labels' => $labels,
        'incomePercentages' => $incomePercentages,
        'expensePercentages' => $expensePercentages,
        'totalIncome' => round($totalIncome, 2),
        'totalExpense' => round($totalExpense, 2)
    ];

    // Return data in JSON format
    echo json_encode($data);
}
?>
