<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Elegant Capital Holdings</title>
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

    <!-- Sign In Section -->
    <div class="auth-container">
        <div class="auth-box">
            <h2>Sign In</h2>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button type="submit" class="signin-btn">Sign In</button>
                    <a href="index.php"><button type="button" class="cancel-btn">Cancel</button></a>
                </div>
            </form>

            <p>Don't have an account? 
                <a href="signup.php"><button class="signup-btn">Sign Up</button></a>
            </p>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Elegant Capital Holdings. All rights reserved.</p>
    </footer>

</body>
</html>
