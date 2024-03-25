<?php 
include_once ('../config/constant.php'); 
include_once ('../user/login_checking.php'); 


$checkLogin= new Login_checking(); 

// Placeholder for your actual authentication logic
function authenticateUser($email, $password) {
    global $conn; // Assuming $conn is your database connection

    // Prepare a SELECT statement to fetch the user's record
    $stmt = $conn->prepare("SELECT cus_password, cus_name FROM customer WHERE cus_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user's hashed password and name
        $row = $result->fetch_assoc();
        $hashedPassword = $row['cus_password'];
        $cusName = $row['cus_name']; // Fetch the customer's name

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, update the session variable with the customer's name and return true
            $_SESSION['cus_name'] = $cusName; // Update the session variable with the customer's name
            return true;
        }
    }

    // If the code reaches this point, the email was not found or the password was incorrect
    return false;
}



function isLoggedIn() {
    // Check if the 'cus_name' session variable is set to "Guest"
    return $_SESSION['cus_name'] !== "Guest"; // Return true if the user is logged in, false otherwise
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
            <a href="index.php">HOME</a>
            <a href="index.php#menu">MENU</a>
            <a href="booking_history_user.php">HISTORY</a> 
        </div>
        <div class="col col3">
            <div class="col3a"><?php
                if ($checkLogin->isLoggedIn()) {
                    echo '<h6>Welcome ' . $_SESSION['cus_name'] . '</h6>';
                }
                ?>
            </div>
            <div class="col3a"> 
                <?php
                    if ($checkLogin->isLoggedIn()) { 
                        // If user is logged in, redirect to account page
                        echo '<img class="acc-icon" src="../images/icon.png" onclick="window.location.href=\'account.php\'">';
                    } else {
                        // If user is not logged in, redirect to login page
                        echo '<img class="acc-icon" src="../images/icon.png" onclick="window.location.href=\'userlogin.php\'">';
                    }
                ?>
            </div> 
        </div>
    </div>
</body>
</html>
