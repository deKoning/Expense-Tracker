# Technical Explanation: Expense Tracker Web Application

## Overview

The Expense Tracker web application is built using HTML, PHP, JavaScript, and CSS. It allows users to track their financial transactions, including expenses and income, and provides features like sorting, category selection, and dark mode. Transactions are stored in a CSV (Comma-Separated Values) file, and categories are loaded from a JSON file.

## Components

### 1. `index.php`

- **Frontend Interface**: The main entry point of the application.
- **HTML Structure**: Contains the user interface elements, including input forms, buttons, tables, and the option to toggle dark mode.
- **JavaScript Functions**: Handles user interactions, such as adding transactions, sorting, selecting, and removing transactions.
- **Communication with Server**: Uses AJAX (Asynchronous JavaScript and XML) to communicate with the server-side script (`process.php` and `delete.php`) to add and remove transactions.

### 2. `process.php`

- **Server-Side Logic**: Handles the processing of data submitted by users when adding transactions.
- **Receives Data**: Receives data via POST requests, including date, income, expense, category, and note.
- **CSV File Management**: Opens the `expenses.csv` file and appends the new transaction data to it.
- **Redirects to `index.php`**: After processing, redirects the user back to the main interface.

### 3. `delete.php`

- **Server-Side Logic**: Manages the removal of selected transactions.
- **Receives Data**: Receives data via GET requests with the row identifier to delete.
- **CSV File Management**: Reads the CSV file into an array, removes the selected row, and overwrites the CSV file with the updated data.
- **Redirects to `index.php`**: After processing, redirects the user back to the main interface.

### 4. `style.css`

- **Styling**: Defines the visual styling and layout of the web application, including dark mode styles.

### 5. `expenses.csv`

- **Data Storage**: A CSV file that stores all transaction data. Each row represents a transaction, and columns include date, income, expense, category, and note.

### 6. `categories.json`

- **Category Data**: A JSON file that contains a list of categories for transactions. The categories are populated in the category dropdown.

### 7. `graphs.php` (Optional)

- **Separate Page**: A separate page for displaying graphical representations of financial data.
- **Data Visualization**: Uses JavaScript libraries like Chart.js or D3.js to create charts and graphs based on data from the CSV file.
- **Navigation**: Linked from the main interface to provide users with visual insights into their finances.

## Functionality

1. **Adding Transactions**:
   - Users input transaction details in the form.
   - JavaScript (AJAX) sends data to `process.php` for storage in the CSV file.
   
2. **Removing Transactions**:
   - Users select transactions in the table and click "Remove Selected."
   - JavaScript sends data to `delete.php` for removal from the CSV file.

3. **Dark Mode**:
   - Users can toggle dark mode on or off for a different visual theme.

4. **Category Selection**:
   - Users can select a category for each transaction from a dropdown populated with data from `categories.json`.

5. **Sorting Transactions**:
   - Users can sort transactions in ascending or descending order by clicking column headers (Date, Income, Expense).

6. **Exporting CSV Data**:
   - Users can export the CSV data by clicking the "Export CSV" button.

7. **Navigation to Graphs** (Optional):
   - Users can navigate to the `graphs.php` page for data visualization.

## Note

The Expense Tracker web application is designed to provide a simple yet effective way for users to manage their financial transactions. It can be extended and customized to meet specific requirements and user preferences.

