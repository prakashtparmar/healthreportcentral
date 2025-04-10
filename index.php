<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

// Assuming you have a database connection established elsewhere
// and a function to fetch user data by ID (e.g., getUserById($userId))

// Replace this with your actual database retrieval logic
$userId = $_SESSION['user_id'];
// $userData = getUserById($userId);
// If your user table has 'username', 'email', etc., you can access them like this:
// $username = htmlspecialchars($userData['username']);
// $email = htmlspecialchars($userData['email']);

// For now, we'll just use the username from the session
$username = htmlspecialchars($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-info {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 6px;
        }

        .profile-info h3 {
            margin-top: 0;
            color: #333;
        }

        .profile-info p {
            margin-bottom: 10px;
            color: #555;
        }

        .dashboard-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }

        .dashboard-buttons a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .dashboard-buttons a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $username; ?>!</h2>
        <div class="profile-info">
            <h3>Your Profile</h3>
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p>This is your protected homepage.</p>
        </div>

        <div class="dashboard-buttons">
            <a href="employeehealthrecord.php">Add New Employee Health Record</a>
            <a href="report_print_pdf.php">Export Health Record in PDF</a>
            <a href="form33.php">Form32</a>
        </div>

        <p style="margin-top: 20px;"><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>