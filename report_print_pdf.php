<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Health Record Search</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        h1, h2 {
            text-align: center;
        }
        #search-form {
            margin-bottom: 20px;
            text-align: center;
        }
        #search-form input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #search-form button {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        #search-form button:hover {
            background-color: #0056b3;
        }
        #record-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        #record-table th, #record-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        #record-table th {
            background-color: #f2f2f2;
        }
        #pdf-button-container {
            text-align: center;
            margin-top: 20px;
        }
        #pdf-button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        #pdf-button:hover {
            background-color: #1e7e34;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Employee Health Record System</h1>
    <div id="search-form">
        <h2>Search Employee Record</h2>
        <form method="POST">
            <input type="text" name="EmployeeNo" placeholder="Enter Employee Number" required>
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <?php
    require 'database.php'; 

    if (isset($_POST['search'])) {
        $employee_no = $_POST['EmployeeNo'];
        $sql = "SELECT * FROM employeehealthrecord WHERE EmployeeNo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $employee_no);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<h2>Employee Health Record</h2>';
            echo '<table id="record-table">';
            foreach ($row as $key => $value) {
                echo '<tr><th>' . htmlspecialchars(str_replace('_', ' ', $key)) . '</th><td>' . htmlspecialchars($value) . '</td></tr>';
            }
            echo '</table>';
            echo '<div id="pdf-button-container">';
            echo '<form method="POST" action="process_pdf_generatecopy.php" target="_blank">';
            echo '<input type="hidden" name="employee_data" value="' . htmlspecialchars(json_encode($row)) . '">';
            echo '<button type="submit" name="generate_pdf" id="pdf-button">Print Employee Health Record</button>';
            echo '</form>';
            echo '</div>';


            echo '<div id="pdf-button-container">';
            echo '<form method="POST" action="form32.php" target="_blank">';
            echo '<input type="hidden" name="employee_data" value="' . htmlspecialchars(json_encode($row)) . '">';
            echo '<button type="submit" name="generate_pdf" id="pdf-button">Print Form 32</button>';
            echo '</form>';
            echo '</div>';

            echo '<div id="pdf-button-container">';
            echo '<form method="POST" action="form33.php" target="_blank">';
            echo '<input type="hidden" name="employee_data" value="' . htmlspecialchars(json_encode($row)) . '">';
            echo '<button type="submit" name="generate_pdf" id="pdf-button">Print Form 33</button>';
            echo '</form>';
            echo '</div>';

        } else {
            echo '<p class="error-message">No record found for Employee Number: ' . htmlspecialchars($employee_no) . '</p>';
        }
        $stmt->close();
    }

    $conn->close();
    ?>

    <script>
        // You can add JavaScript for more interactive features if needed
    </script>
</body>
</html>