<?php
session_start();
$conn = new mysqli("localhost", "root", "", "elegantcapital");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user is logged in
if (!isset($_SESSION["user_id"])) {
    die("Error: You must be signed in to request a loan.");
}

$user_id = $_SESSION["user_id"];
$loan_amount = $_POST["loan_amount"] ?? null;
$return_date = $_POST["return_date"] ?? null;

if (!$loan_amount || !$return_date) {
    die("Error: Loan amount and return date are required.");
}

// Check if the user already has a pending loan (Remove this if you allow multiple loans)
$stmt = $conn->prepare("SELECT * FROM loans WHERE user_id = ? AND status = 'pending'");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Error: You already have a pending loan request.");
}

// Insert new loan request
$stmt = $conn->prepare("INSERT INTO loans (user_id, loan_amount, return_date, status) VALUES (?, ?, ?, 'pending')");
$stmt->bind_param("iis", $user_id, $loan_amount, $return_date);

if ($stmt->execute()) {
    header("Location: loan_status.php");
    exit();
} else {
    die("Error: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>

