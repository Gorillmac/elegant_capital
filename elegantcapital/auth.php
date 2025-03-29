<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In / Sign Up | Elegant Capital Holdings</title>
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
                <li><a href="about.html">About Us</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
  <!-- AUTH SELECTION SECTION -->
  <div class="auth-container">
    <div class="auth-box">
      <h2>Welcome to Elegant Capital Holdings</h2>
      <p>Choose an option to continue:</p>
      <button onclick="window.location.href='signin.php'">Sign In</button>
      <button onclick="window.location.href='signup.php'">Sign Up</button>
    </div>

    <!-- BENEFITS BOX -->
    <div class="benefits-box">
      <h3>Why Create an Account?</h3>
      <ul>
        <li>Instant Loan Approvals</li>
        <li>No Background Checks</li>
        <li>Lowest Interest Rates</li>
        <li>Easy Loan Management</li>
      </ul>
    </div>
  </div>
  <footer>
    <p>&copy; 2025 Elegant Capital Holdings. All rights reserved.</p>
  </footer>
</body>
</html>


