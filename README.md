Elegant Capital Holdings Website
Project Description
This project is the official website for Elegant Capital Holdings, a financial company that provides instant personal loans with no background checks. The website allows users to apply for loans, check loan status, and manage their accounts.

Key features:

Sign Up and Sign In: Allows users to create an account and sign in to view their loan status.

Loan Application: Users can apply for personal loans by providing details such as loan amount and return date.

Loan Status: Admin can update the status of a loan request, and users can check the status of their loans.

Admin Dashboard: Admin can manage loan requests and view user details.

Technologies Used
PHP: Server-side scripting for handling user requests, login authentication, and loan status updates.

MySQL: Database for storing user details, loan requests, and loan status.

HTML/CSS: .

Requirements to Run the Project
XAMPP or LAMP stack (Local Server setup):

Ensure you have a local web server like XAMPP or LAMP installed and running.

Database Setup:

You’ll need to create a MySQL database to store user details, loan requests, and loan status. Here is SQL setup:

sql
CREATE DATABASE elegantcapital;
USE elegantcapital;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE loans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    loan_amount DECIMAL(10,2) NOT NULL,
    return_date DATE NOT NULL,
    status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    requested_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

How to Run the Project
 download the project files to your local machine.

Set up the XAMPP or LAMP stack and start Apache and MySQL services.

Create a new database using the provided SQL structure in the "Requirements" section.

Upload the project files to the htdocs (XAMPP) or equivalent directory on your local server.

Open your browser and visit localhost/elegantcapital to view the website.
