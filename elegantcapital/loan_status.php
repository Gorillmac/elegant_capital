<?php
session_start();
$conn = new mysqli("localhost", "root", "", "elegantcapital");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user is logged in
if (!isset($_SESSION["user_id"])) {
    die("Error: You must be signed in to view your loan status.");
}

$user_id = $_SESSION["user_id"];

// Fetch the latest loan request
$stmt = $conn->prepare("SELECT loan_amount, return_date, status FROM loans WHERE user_id = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$loan = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Status | Elegant Capital Holdings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
      <header>
        <div class="logo">
            <a href="index.php" style="text-decoration: none; color: red;">
                <h1>Loan Status</h1>
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

    <div class="container">
        <?php if ($loan): ?>
            <p><strong>Loan Amount:</strong> R<?php echo htmlspecialchars($loan['loan_amount']); ?></p>
            <p><strong>Return Date:</strong> <?php echo htmlspecialchars($loan['return_date']); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($loan['status']); ?></p>
        <?php else: ?>
            <p>You have not requested a loan yet.</p>
        <?php endif; ?>
        <a href="index.php">Return to Home</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
