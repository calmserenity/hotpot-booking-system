<?php
include_once 'header.php'; // Include the header

// Assuming $conn is your database connection

// Function to update the password in the database
function updatePassword($hashedPassword, $email)
{
    global $conn; // Assuming $conn is your database connection

    // Corrected SQL query to use 'cus_password' instead of 'password'
    $sql = "UPDATE customer SET cus_password = ? WHERE cus_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashedPassword, $email);

    return $stmt->execute();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get the new password, confirm password, and email from the form
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Check if passwords match
    if ($newPassword == $confirmPassword) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the customer's password in the database
        if (updatePassword($hashedPassword, $email)) {
            // Use JavaScript to show an alert and redirect the user
            echo '<script>alert("Password updated successfully. You can now log in with your new password."); window.location.href="userlogin.php";</script>';
        } else {
            echo "<p>Failed to update password.</p>";
        }
    } else {
        // Passwords do not match, show JavaScript alert and prevent form submission
        echo '<script>alert("Passwords do not match. Please re-enter your new password.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <link rel="stylesheet" href="newpassword.css"> <!-- Include the CSS file -->
</head>
<body>
    <div class="recover_wrap">
        <div class="password-recovery-form-container">
            <h2>Set New Password</h2>
            <form method="post" action="newpassword.php">
                <input type="email" id="email" name="email" placeholder="Your Email" required>
                <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
    <?php include_once 'footer.php'; // Include the footer at the bottom of the body ?>
</body>
</html>
