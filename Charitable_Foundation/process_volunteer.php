<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Security Check: Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Security violation: Invalid CSRF token.");
    }

    $name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $interests = filter_input(INPUT_POST, 'interests', FILTER_SANITIZE_STRING);

    if ($name && $email) {
        $stmt = $pdo->prepare("INSERT INTO volunteers (full_name, email, interests) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $interests]);
        
        echo "<script>alert('Thank you for volunteering!'); window.location.href='index.php';</script>";
    } else {
        echo "Invalid input data.";
    }
}
?>