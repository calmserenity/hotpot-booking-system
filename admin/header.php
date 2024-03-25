<?php 
include_once ('../config/constant.php'); 
include_once ('../admin/admin_login_checking.php'); 


$checkLogin= new AdLogin_checking(); 

// Placeholder for your actual authentication logic
function authenticateUser($email, $password) {
    global $conn; // Assuming $conn is your database connection

    // Prepare a SELECT statement to fetch the user's record
    $stmt = $conn->prepare("SELECT Ad_password, Ad_name, Ad_email FROM `admin` WHERE Ad_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user's hashed password and name
        $row = $result->fetch_assoc();
        $hashedPassword = $row['Ad_password'];
        $AdName = $row['Ad_name']; // Fetch the customer's name

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, update the session variable with the customer's name and return true
            $_SESSION['Ad_name'] = $AdName; // Update the session variable with the customer's name
            return true;
        }
    }

    // If the code reaches this point, the email was not found or the password was incorrect
    return false;
}



function isLoggedIn() {
    // Check if the 'cus_name' session variable is set to "Guest"
    return $_SESSION['Ad_name'] !== "Guest"; // Return true if the user is logged in, false otherwise
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="header-column">
        <div class="col col1">
            <img src="../images/logo.png" width=50 height=50>
        </div>      
        <div class="col col2">
            <a href="admin_display.php">MANAGEMENT</a>
        </div>
        <div class="col col3">
            <div class="col3a"><?php
                if ($checkLogin->isLoggedIn()) {
                    echo '<h6>Welcome ' . $_SESSION['Ad_name'] . '</h6>';
                }
                ?>
            </div>
            <?php
                if ($checkLogin->isLoggedIn()) { 
                    // If user is logged in, redirect to account page
                    echo '<img class="acc-icon" src="../images/icon.png" onclick="window.location.href=\'admin_account.php\'">';
                } else {
                    // If user is not logged in, redirect to login page
                    echo '<img class="acc-icon" src="../images/icon.png" onclick="window.location.href=\'adminlogin.php\'">';
                }
            ?>
        </div>
    </div>
</body>
</html>
