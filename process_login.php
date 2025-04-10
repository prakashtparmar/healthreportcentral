<?php
session_start();
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username_or_email) || empty($password)) {
        header("Location: login.php?error=Please enter both username/email and password.");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, start a new session
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            header("Location: index.php"); // Redirect to homepage
            exit();
        } else {
            // Incorrect password
            header("Location: login.php?error=Incorrect password.");
            exit();
        }
    } else {
        // User not found
        header("Location: login.php?error=Invalid username or email.");
        exit();
    }
    $stmt->close();
    $conn->close();
} else {
    // If accessed directly without submitting the form
    header("Location: login.php");
    exit();
}
?>