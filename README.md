# Expense Tracker Web Application
Expense Tracker is an simple webapp to track income en expenses

The Expense Tracker is a web application that allows users to track their expenses and income. Users can add, view, and manage their financial transactions, which are stored in a CSV file. The application also includes features like dark mode, sorting, and category selection.

## Features

### Adding Expenses and Income

- Users can input the following details for each transaction:
  - Date: The date of the transaction.
  - Income (€): The amount of income for the transaction.
  - Expense (€): The amount of the expense for the transaction.
  - Category: The category of the transaction (optional).
  - Note: A note or description for the transaction (optional).

- Users can add transactions by entering the details in the input form and clicking the "Add Expense" button.

### Expense History

- The application displays a table that shows the transaction history.
- Users can view the history of transactions, including the date, income, expense, category (if provided), and note (if provided).
- Transactions are loaded from a CSV file and displayed in the table.

### Sorting Transactions

- Users can sort the transactions in the table by clicking on the column headers (Date, Income, Expense).
- Sorting is supported for ascending and descending order.

### Selecting Transactions

- Users can select individual transactions by clicking the checkbox next to each transaction.
- A "Select All" checkbox allows users to select or deselect all transactions.

### Removing Selected Transactions

- Users can remove selected transactions by clicking the "Remove Selected" button.
- A confirmation dialog appears to confirm the removal.

### Dark Mode

- Users can toggle dark mode on or off by clicking the "Toggle Dark Mode" button.
- Dark mode changes the color scheme of the application for a different visual experience.

### Category Selection

- Users can select a category for each transaction from a dropdown list.
- Categories are populated from a JSON file.
- The selected category is stored along with the transaction.

### Exporting CSV Data

- Users can export the CSV data by clicking the "Export CSV" button.
- The CSV file is provided as a download to the user.

### Navigation to Graphs

- Users can navigate to a separate page, "Graphs," by clicking the "Go to Graphs" button.
- The Graphs page provides visual representations of financial data.

## Usage

1. **Adding Transactions:**
   - Fill in the transaction details (Date, Income, Expense, Category, and Note).
   - Click the "Add Expense" button to add the transaction.
   - Transactions will appear in the expense history table.

2. **Sorting Transactions:**
   - Click on the column headers (Date, Income, Expense) to sort transactions.

3. **Selecting Transactions:**
   - Click the checkboxes to select individual transactions.
   - Use the "Select All" checkbox to select or deselect all transactions.

4. **Removing Transactions:**
   - Click the "Remove Selected" button to remove selected transactions.

5. **Dark Mode:**
   - Click the "Toggle Dark Mode" button to switch between dark and light modes.

6. **Category Selection:**
   - Choose a category from the dropdown list when adding a transaction.

7. **Exporting CSV Data:**
   - Click the "Export CSV" button to download the CSV file.

8. **Navigation to Graphs:**
   - Click the "Go to Graphs" button to access the Graphs page for data visualization.

## Note

This web application is a basic expense tracker with essential features. It can be further customized and enhanced based on specific requirements and user needs.

Happy expense tracking!

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

# Sitemap

## Home Page
- `index.php`
  - Overview of the Expense Tracker application
  - Input form to add transactions
  - Expense history table
    - Sortable columns (Date, Income, Expense)
    - Checkbox for selecting transactions
    - "Remove Selected" button
    - Total income and total expense display
  - Dark mode toggle button
  - Category selection dropdown
  - "Export CSV" button
  - "Go to Graphs" button (optional)
  
## Processing Pages
- `process.php`
  - Handles the submission of transaction data
  - Appends data to the `expenses.csv` file
  - Redirects back to `index.php`

- `delete.php`
  - Manages the removal of selected transactions
  - Modifies the `expenses.csv` file
  - Redirects back to `index.php`

## Data Files
- `expenses.csv`
  - CSV file containing transaction data (Date, Income, Expense, Category, Note)

- `categories.json`
  - JSON file containing transaction categories for the dropdown

## Styling
- `style.css`
  - CSS file for styling the web application, including dark mode styles

## Optional Graphs Page
- `graphs.php` (Optional)
  - Separate page for data visualization
  - Charts and graphs representing financial data
  - Navigation back to `index.php`




