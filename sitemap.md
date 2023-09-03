# Expense Tracker Web Application Sitemap

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

