<?php include 'navbar.php'; ?>
<?php
session_start();
require 'db_connection.php';

<?php
session_start();
require 'db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html"); // Redirect to login if not logged in
    exit();
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Fetch the latest loan request for the user
$sql = "SELECT amount, return_date, status, request_date FROM loans WHERE user_id = ? ORDER BY request_date DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Loan Status</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 20px; }
        .container { max-width: 500px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; }
        .status-box { padding: 10px; margin-top: 10px; border-radius: 5px; font-weight: bold; }
        .approved { background-color: #d4edda; color: #155724; }
        .pending { background-color: #fff3cd; color: #856404; }
        .rejected { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Loan Status</h2>
        <?php if ($result->num_rows > 0) { 
            $loan = $result->fetch_assoc();
            $status_class = strtolower($loan['status']); ?>
            
            <p><strong>Amount:</strong> R<?= $loan['amount']; ?></p>
            <p><strong>Return Date:</strong> <?= $loan['return_date']; ?></p>
            <p><strong>Request Date:</strong> <?= $loan['request_date']; ?></p>
            <div class="status-box <?= $status_class; ?>">
                <strong>Status: <?= ucfirst($loan['status']); ?></strong>
            </div>

            <?php if ($loan['status'] == 'rejected') { ?>
                <p style="color: red;">Your loan request was rejected. You may apply again.</p>
                <a href="request_loan.php"><button>Request New Loan</button></a>
            <?php } elseif ($loan['status'] == 'approved') { ?>
                <p style="color: green;">Your loan has been approved!</p>
            <?php } else { ?>
                <p>Your loan is currently being processed. Please wait for an update.</p>
            <?php } ?>

        <?php } else { ?>
            <p>You currently have no loan requests.</p>
            <a href="request_loan.php"><button>Request a Loan</button></a>
        <?php } ?>

        <?php $stmt->close(); $conn->close(); ?>
    </div>
</body>
</html>
