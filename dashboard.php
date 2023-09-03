<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Dashboard</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Expense Dashboard</h1>
        
        <!-- Navigation Button (Link to other pages) -->
        <a href="./" class="btn btn-primary"><i class="fa-solid fa-left-long"></i> Back to home</a>

        <!-- Date Range Input Fields -->
        <div class="row mt-4">
            <div class="col-md-3">
                <input type="date" id="start_date" class="form-control" placeholder="Start Date">
            </div>
            <div class="col-md-3">
                <input type="date" id="end_date" class="form-control" placeholder="End Date">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" id="update_graph">Update Graph</button>
            </div>
 
        </div>

        <!-- Buttons to Pre-fill Date Range -->
        <div class="row mt-2">
            <div class="col-md-3">
                <button class="btn btn-secondary" id="one_day">1 Day</button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-secondary" id="one_week">1 Week</button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-secondary" id="one_month">1 Month</button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-secondary" id="one_year">1 Year</button>
            </div>
        </div>

        <!-- Summary for Total Income and Total Expense -->
        <div class="row mt-4">
            <div class="col-md-6">
                <p>Total Income: <span id="total_income" style="color: green;">€0.00</span></p>
            </div>
            <div class="col-md-6">
                <p>Total Expense: <span id="total_expense" style="color: red;">€0.00</span></p>
            </div>
        </div>

        <!-- Year Selector Dropdown -->
        <div class="row mt-4">
            <div class="col-md-3">
                <select id="year_selector" class="form-control">
                    <option value="">Select Year</option>
                    <?php
                    // Assuming you want to provide a range of years (e.g., from 2010 to the current year)
                    $currentYear = date('Y');
                    for ($year = 2010; $year <= $currentYear; $year++) {
                        echo "<option value='$year'>$year</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Canvas for Chart -->
        <div class="row mt-4">
            <div class="col-md-12">
                <canvas id="incomeExpenseChart" width="800" height="400"></canvas>
            </div>
        </div>

        <!-- Placeholder for Funny Text Message -->
        <div id="funny_message" class="mt-4"></div>
    </div>

    <!-- Add Bootstrap JS and jQuery (you may need to download these files) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript to handle button clicks and update the page -->
    <script>
        // JavaScript to handle button clicks and update the page
        $(document).ready(function () {
            var chart = null; // Variable to store the chart instance

            // Function to update the chart and summary
            function updateChartAndSummary(startDate, endDate) {
                $.ajax({
                    url: 'get_data.php',
                    type: 'GET',
                    data: { start_date: startDate, end_date: endDate },
                    dataType: 'json',
                    success: function (data) {
                        // Extract data from the JSON response
                        var labels = data.labels;
                        var incomePercentages = data.incomePercentages;
                        var expensePercentages = data.expensePercentages;
                        var totalIncome = data.totalIncome;
                        var totalExpense = data.totalExpense;

                        // Destroy the previous chart instance if it exists
                        if (chart) {
                            chart.destroy();
                        }

                        // Check if there is data available
                        if (labels.length > 0) {
                            // Data is available, display the chart and update the total income and total expense text
                            $('#funny_message').empty();
                            $('#incomeExpenseChart').show();

                            // Create and update the chart
                            var ctx = document.getElementById('incomeExpenseChart').getContext('2d');
                            chart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [
                                        {
                                            label: 'Income Percentage',
                                            data: incomePercentages,
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        },
                                        {
                                            label: 'Expense Percentage',
                                            data: expensePercentages,
                                            borderColor: 'rgba(255, 99, 132, 1)',
                                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        },
                                    ],
                                },
                            });

                            // Update the total income and total expense text
                            $('#total_income').html('<span style="color: green;">€' + totalIncome.toFixed(2) + '</span>');
                            $('#total_expense').html('<span style="color: red;">€' + totalExpense.toFixed(2) + '</span>');
                        } else {
                            // No data available for the selected date range, display a funny message
                            $('#incomeExpenseChart').hide();
                            $('#funny_message').html('<p>No data available for this period. Try something else!</p>');
                        }
                    },
                    error: function () {
                        alert('Error fetching data');
                    },
                });
            }

            // Call the updateChartAndSummary function initially with default dates or when the "Update Graph" button is clicked
            $('#update_graph').click(function () {
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();
                updateChartAndSummary(startDate, endDate);
            });

            // Add click event handlers for pre-fill buttons
            $('#one_day').click(function () {
                // Calculate one day ago from today
                var oneDayAgo = new Date();
                oneDayAgo.setDate(oneDayAgo.getDate() - 1);
                $('#start_date').val(oneDayAgo.toISOString().split('T')[0]);
                $('#end_date').val(new Date().toISOString().split('T')[0]);
            });

            $('#one_week').click(function () {
                // Calculate one week ago from today
                var oneWeekAgo = new Date();
                oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
                $('#start_date').val(oneWeekAgo.toISOString().split('T')[0]);
                $('#end_date').val(new Date().toISOString().split('T')[0]);
            });

            $('#one_month').click(function () {
                // Calculate one month ago from today
                var oneMonthAgo = new Date();
                oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);
                $('#start_date').val(oneMonthAgo.toISOString().split('T')[0]);
                $('#end_date').val(new Date().toISOString().split('T')[0]);
            });

            $('#one_year').click(function () {
                // Calculate one year ago from today
                var oneYearAgo = new Date();
                oneYearAgo.setFullYear(oneYearAgo.getFullYear() - 1);
                $('#start_date').val(oneYearAgo.toISOString().split('T')[0]);
                $('#end_date').val(new Date().toISOString().split('T')[0]);
            });

            // Handle the year selector change event
            $('#year_selector').change(function () {
                var selectedYear = $(this).val();

                if (selectedYear) {
                    // Pre-fill the date input fields for the selected year
                    var startDate = selectedYear + '-01-01';
                    var endDate = selectedYear + '-12-31';
                    $('#start_date').val(startDate);
                    $('#end_date').val(endDate);

                    // Update the chart and summary
                    updateChartAndSummary(startDate, endDate);
                }
            });
        });
    </script>
</body>
</html>
