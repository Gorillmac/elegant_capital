<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Request Success - Elegant Capital Holdings</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to CSS -->
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

    <!-- Loan Success Message -->
    <div class="content-box">
        <h2>Account Created Successfully</h2>
        
       <p>You have been successfully signed up! Please <a href="signin.php">Sign In</a> to continue.</p>

        <!-- Button to go back to home -->
        <a href="index.php" class="btn">Return to Home</a>
    </div>

    <script>
        // Simulating whether the user already has a loan (this will be dynamic with PHP later)
        let hasLoan = false; // Change to true to test the "already have a loan" message

        document.getElementById("loanMessage").innerText = hasLoan 
            ? "You already have a loan." 
            : "Your loan request has been submitted successfully!";
    </script>
 <footer>
    <p>&copy; 2025 Elegant Capital Holdings. All rights reserved.</p>
  </footer>
</body>
</html>


