<?php
include('../includes/db_connection.php'); // Include the DB connection

if (isset($_POST['loan_id']) && isset($_POST['status'])) {
    $loan_id = intval($_POST['loan_id']); // Ensure loan_id is an integer
    $status = $_POST['status'];

    // Update the status where the correct column name is used (replace `loan_id` with `id` if needed)
    $sql = "UPDATE loans SET status = ? WHERE id = ?"; // Update `id` to match your actual column name

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $status, $loan_id);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: admin_dashboard.php?success=updated"); // Redirect after updating
            exit();
        } else {
            die("Error updating record: " . mysqli_error($conn));
        }
    } else {
        die("Query preparation failed: " . mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);
}
?>

