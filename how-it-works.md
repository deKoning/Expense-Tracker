# Expense Tracker Web Application

## Overview

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
