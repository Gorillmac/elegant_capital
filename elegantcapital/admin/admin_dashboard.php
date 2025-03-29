<?php
include('../includes/db_connection.php'); // Include the DB connection

// Start session to verify admin login
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all loan requests from the correct table
$sql = "SELECT * FROM loans";
$result = mysqli_query($conn, $sql);

// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if the loan status update has occurred (via POST request from form submission)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loan_id']) && isset($_POST['status'])) {
    $loan_id = $_POST['loan_id']; // Loan ID to update
    $new_status = $_POST['status']; // New loan status (approved/rejected/pending)

    // Update loan status in the database
    $update_sql = "UPDATE loans SET status='$new_status' WHERE id='$loan_id'";
    if (mysqli_query($conn, $update_sql)) {
        
        // Fetch user email after loan status update
        $user_id = $_POST['user_id']; // Assuming user_id is passed in the form
        $user_sql = "SELECT email FROM users WHERE id='$user_id'";
        $user_result = mysqli_query($conn, $user_sql);
        
        if ($user_result && mysqli_num_rows($user_result) > 0) {
            $user = mysqli_fetch_assoc($user_result);
            $user_email = $user['email'];
            
            // Send the email notification to the user
            $subject = "Loan Status Update - Elegant Capital Holdings";
            $message = "Dear User,\n\nYour loan status has been updated to: $new_status.\n\nThank you for choosing Elegant Capital Holdings.";
            $headers = "From: no-reply@elegantcapitalholding.co.za";

            if (mail($user_email, $subject, $message, $headers)) {
                echo "Email sent successfully to the user!";
            } else {
                echo "Error: Email sending failed.";
            }
        }
    } else {
        echo "Error updating loan status: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Elegant Capital Holdings</title>
    <link rel="stylesheet" href="../styles.css"> <!-- Ensure path is correct -->
</head>
<body>
    <header>
        <div class="logo">
            <a href="../index.php" style="text-decoration: none; color: red;">
                <h1>Elegant Capital Holdings</h1>
            </a>
        </div>
        <nav class="nav-menu">
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="admin_logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="content-box">
        <h2>Loan Requests</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Loan ID</th>
                <th>User ID</th>
                <th>Amount</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Update Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                <td><?php echo htmlspecialchars($row['loan_amount']); ?></td>
                <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td>
                    <form action="admin_dashboard.php" method="POST">
                        <input type="hidden" name="loan_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>"> <!-- User ID for email -->
                        <select name="status">
                            <option value="pending" <?php echo ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="approved" <?php echo ($row['status'] == 'approved') ? 'selected' : ''; ?>>Approved</option>
                            <option value="rejected" <?php echo ($row['status'] == 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                        <button type="submit">Update Status</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php else: ?>
            <p>No loan requests found.</p>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; 2025 Elegant Capital Holdings. All rights reserved.</p>
    </footer>
</body>
</html>

<?php mysqli_close($conn); ?>






