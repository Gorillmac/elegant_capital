<?php
// Start session
session_start();
include('../includes/db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to fetch user based on email
    $sql = "SELECT * FROM users WHERE email = '$email' AND is_admin = 1";
    $result = mysqli_query($conn, $sql);

    // Check if the user exists and verify password
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variable for admin login
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id']; // Storing user ID in session

            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $login_error = "Invalid email or password.";
        }
    } else {
        $login_error = "Invalid email or you are not an admin.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Elegant Capital Holdings</title>
    <link rel="stylesheet" href="../styles.css"> <!-- Ensure the path is correct -->
</head>
<body>
    <header>
        <div class="logo">
            <a href="../index.php" style="text-decoration: none; color: red;">
                <h1>Elegant Capital Holdings</h1>
            </a>
        </div>
    </header>

    <section class="content-box">
        <h2>Admin Login</h2>

        <!-- Show error message if login fails -->
        <?php if (isset($login_error)) { echo "<p style='color: red;'>$login_error</p>"; } ?>

        <form method="POST" action="admin_login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 Elegant Capital Holdings. All rights reserved.</p>
    </footer>
</body>
</html>
