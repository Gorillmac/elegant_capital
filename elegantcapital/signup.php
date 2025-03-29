<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "elegantcapital");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Check if email already exists
    $check_sql = "SELECT * FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        $error_message = "Error: This email is already registered. Please use a different email.";
    } else {
        // Insert data into database
        $sql = "INSERT INTO users (email, full_name, phone, physical_address, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $email, $full_name, $phone, $address, $password);

        if ($stmt->execute()) {
            // Redirect to success page
            header("Location: success.php");
            exit();
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Elegant Capital Holdings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Navigation Bar -->
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

    <!-- Sign Up Section -->
    <div class="auth-container">
        <div class="auth-box">
            <h2>Create an Account</h2>

            <!-- Display error message if email is already registered -->
            <?php if (!empty($error_message)): ?>
                <p style="color: red; text-align: center;"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form action="signup.php" method="POST">
                <div class="input-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>

                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="input-group">
                    <label for="address">Physical Address</label>
                    <input type="text" id="address" name="address" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button type="submit" class="signup-btn">Sign Up</button>
                    <a href="index.php"><button type="button" class="cancel-btn">Cancel</button></a>
                </div>
            </form>

            <p>Already have an account?
                <a href="signin.php"><button class="signin-btn">Sign In</button></a>
            </p>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Elegant Capital Holdings. All rights reserved.</p>
    </footer>

</body>
</html>
