<?php
session_start();
include('includes/db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Initialize variables
$status_message = '';
$loan_status = '';
$loan_amount = '';
$return_date = '';

// Handle form submission to check loan status
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Use a prepared statement to prevent SQL injection
    $sql = "SELECT loan_amount, return_date, status 
            FROM loans 
            WHERE user_id = (SELECT id FROM users WHERE email = ?) 
            ORDER BY requested_at DESC LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch loan details
            $loan_details = mysqli_fetch_assoc($result);
            $loan_amount = $loan_details['loan_amount'];
            $return_date = $loan_details['return_date'];
            $loan_status = $loan_details['status'];
        } else {
            $status_message = "No loan request found for the given email.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $status_message = "Error preparing the query: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Loan Status - Elegant Capital Holdings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php" style="text-decoration: none; color: red;">
                <h1>Elegant Capital Holdings</h1>
            </a>
        </div>
        <nav class="nav-menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="content-box">
        <h2>Check Loan Status</h2>
        <form action="check_loan_status.php" method="POST">
            <label for="email">Enter your email address:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Check Status</button>
        </form>

        <?php if ($loan_status): ?>
            <div class="loan-status">
                <h3>Loan Status</h3>
                <p><strong>Loan Amount:</strong> <?php echo htmlspecialchars($loan_amount); ?></p>
                <p><strong>Return Date:</strong> <?php echo htmlspecialchars($return_date); ?></p>
                <p><strong>Status:</strong> <?php echo ucfirst(htmlspecialchars($loan_status)); ?></p>
            </div>
        <?php elseif ($status_message): ?>
            <p class="error"><?php echo htmlspecialchars($status_message); ?></p>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; 2025 Elegant Capital Holdings. All rights reserved.</p>
    </footer>
</body>
</html>
