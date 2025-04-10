<?php
require 'database.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch all data from the EmployeeHealthRecord table
$sql = "SELECT * FROM EmployeeHealthRecord";
$result = $conn->query($sql);

if ($result === false) {
    die("Error fetching data: " . $conn->error);
}

$employeeData = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Health Records Report</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 0.9em;
        }
        th {
            background-color: #f2f2f2;
        }
        .pdf-button-container {
            text-align: center;
        }
        .pdf-button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .pdf-button:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>
    <h1>Employee Health Records Report</h1>

    <?php if (count($employeeData) > 0): ?>
        <table>
            <thead>
                <tr>
                    <?php foreach (array_keys($employeeData[0]) as $column): ?>
                        <th><?php echo htmlspecialchars(str_replace('_', ' ', $column)); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employeeData as $row): ?>
                    <tr>
                        <?php foreach ($row as $value): ?>
                            <td><?php echo htmlspecialchars($value); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="pdf-button-container">
            <form method="POST" action="generate_all_pdf.php" target="_blank">
                <input type="hidden" name="all_employee_data" value="<?php echo htmlspecialchars(json_encode($employeeData)); ?>">
                <button type="submit" class="pdf-button" name="generate_all_pdf">Export All to PDF</button>
            </form>
        </div>

    <?php else: ?>
        <p>No employee health records found.</p>
    <?php endif; ?>

</body>
</html>
