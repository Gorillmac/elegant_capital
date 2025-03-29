<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Loan - Elegant Capital Holdings</title>
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
        <h2>Request a Loan</h2>
        <form action="process_loan.php" method="POST">
            <label for="loan_amount">Loan Amount:</label>
            <input type="number" id="loan_amount" name="loan_amount" required>

            <label for="return_date">Return Date:</label>
            <input type="date" id="return_date" name="return_date" required>

            <button type="submit">Submit Loan Request</button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <a href="check_loan_status.php">
                <button style="background: green; color: white; padding: 10px 15px; border: none; cursor: pointer; border-radius: 5px;">
                    Check Loan Status
                </button>
            </a>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="logout.php">
                <button style="background: red; color: white; padding: 10px 15px; border: none; cursor: pointer; border-radius: 5px;">
                    Logout
                </button>
            </a>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Elegant Capital Holdings. All rights reserved.</p>
    </footer>
</body>
</html>


