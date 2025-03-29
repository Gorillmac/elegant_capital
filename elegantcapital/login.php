<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "elegantcapital");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Check if user exists
$sql = "SELECT id, full_name, password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User found, verify password
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        // Set session and redirect to loan request page
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        header("Location: loan_request.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password. Please try again.'); window.location.href='signin.php';</script>";
    }
} else {
    echo "<script>alert('No account found with this email. Please sign up.'); window.location.href='signup.php';</script>";
}

// Close connection
$stmt->close();
$conn->close();
?>
