<?php
include_once 'header.php'; // Include the header


// Function to update the password in the database for admin
function updateAdminPassword($hashedPassword, $email) {
    global $conn; // Assuming $conn is your database connection

    $sql = "UPDATE admin SET Ad_password = ? WHERE Ad_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashedPassword, $email);

    return $stmt->execute();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Password validation
    if (!preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/', $newPassword)) {
        echo '<script>alert("Password must be at least 8 characters long, contain at least one digit, and at least one symbol."); window.location.href="newadminpassword.php";</script>';
        exit;
    }

    if ($newPassword != $confirmPassword) {
        echo '<script>alert("Passwords do not match. Please re-enter your new password."); window.location.href="newadminpassword.php";</script>';
        exit;
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
    // Update the admin's password in the database
    if (updateAdminPassword($hashedPassword, $email)) {
        echo '<script>alert("Password updated successfully. You can now log in with your new password."); window.location.href="adminlogin.php";</script>';
    } else {
        echo "<p>Failed to update password.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Admin Password</title>
</head>
<body>
    <div class="adminrecover_wrap">
        <div class="adminpassword-recovery-form-container">
            <h2>Set New Admin Password</h2>
            <form method="post" action="newadminpassword.php">
                <input type="email" id="email" name="email" placeholder="Admin Email" required>
                <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>