<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker - Graph</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- Include Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- Include Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
    <div class="container">
        <h1 class="mt-5 text-center">Expense Tracker - Graph</h1>
        <!-- Button to navigate to graph.php -->
        <a href="./" class="btn btn-secondary ml-1"><i class="fa-solid fa-left-long"></i> Back to overview </a>

        <!-- Date Range Selector Form -->
        <form class="form-inline mt-3">
            <div class="form-group">
                <label for="startDate">Start Date:</label>
                <input type="text" class="form-control datepicker" id="startDate" name="start_date">
            </div>
            <div class="form-group ml-3">
                <label for="endDate">End Date:</label>
                <input type="text" class="form-control datepicker" id="endDate" name="end_date">
            </div>
            <button type="button" class="btn btn-primary ml-3" onclick="updateGraph()">Update Graph</button>
            <button type="button" class="btn btn-secondary ml-3" onclick="prefillDates()">Prefill One Week</button>
            <button type="button" class="btn btn-secondary ml-3" onclick="prefillDatesOneYearAgo()">Prefill One Year Ago</button>
        </form>

        <div>
            <canvas id="expenseChart"></canvas>
        </div>

        <!-- Total Income and Expense -->
        <div class="mt-4">
            <h2>Total Income: €<span id="totalIncome">0.00</span></h2>
            <h2>Total Expense: €<span id="totalExpense">0.00</span></h2>
        </div>
    </div>

    <!-- JavaScript code for the graph -->
    <script>
        // Initialize datepickers
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });

        var expenseChart;

        // Function to update the graph based on the selected date range
        function updateGraph() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            // Make an AJAX request to fetch data within the selected date range
            $.ajax({
                type: 'GET',
                url: 'get_data.php',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                dataType: 'json',
                success: function(data) {
                    // Update the chart with the new data
                    expenseChart.data.labels = data.labels;
                    expenseChart.data.datasets[0].data = data.incomeData;
                    expenseChart.data.datasets[1].data = data.expenseData;
                    expenseChart.update();

                    // Update the total income and expense
                    $('#totalIncome').text(data.totalIncome.toFixed(2));
                    $('#totalExpense').text(data.totalExpense.toFixed(2));
                }
            });
        }

        // Function to format a date as yyyy-mm-dd
        function formatDate(date) {
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            return year + '-' + month + '-' + day;
        }

        // Function to prefill date fields with today and 7 days ago
        function prefillDates() {
            // Get today's date
            var today = new Date();

            // Set the end date as today
            var endDate = formatDate(today);

            // Calculate the start date as 7 days ago
            var startDate = new Date(today);
            startDate.setDate(today.getDate() - 7);
            startDate = formatDate(startDate);

            // Set the values in the date fields
            $('#startDate').val(startDate);
            $('#endDate').val(endDate);
        }

        // Function to prefill date fields with one year ago and today
        function prefillDatesOneYearAgo() {
            // Get today's date
            var today = new Date();

            // Set the end date as today
            var endDate = formatDate(today);

            // Calculate the start date as one year ago
            var startDate = new Date(today);
            startDate.setFullYear(today.getFullYear() - 1);
            startDate = formatDate(startDate);

            // Set the values in the date fields
            $('#startDate').val(startDate);
            $('#endDate').val(endDate);
        }

        // Create a canvas element for the chart
        var ctx = document.getElementById("expenseChart").getContext("2d");

        // Initial data for the chart (you can customize this)
        var initialData = {
            labels: [],
            datasets: [{
                label: 'Income',
                data: [],
                backgroundColor: 'rgba(0, 123, 255, 0.6)'
            }, {
                label: 'Expense',
                data: [],
                backgroundColor: 'rgba(255, 0, 0, 0.6)'
            }]
        };

        // Create the bar chart
        expenseChart = new Chart(ctx, {
            type: 'bar',
            data: initialData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>
