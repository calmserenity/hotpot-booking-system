<?php
include_once 'header.php'; // Include the header
include 'user.php';

// Check for logout request and process it
if (isset($_POST['logout'])) {
    // Destroy the session
    session_unset();
    session_destroy(); // Clear all session variables

    // Optionally, unset the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
        // Reset 'cus_name' to "Guest"
    $_SESSION['cus_name'] = "Guest";

    // Redirect to the login page
    header("Location: userlogin.php");
    exit; // Ensure no further output is sent

    }

}

// Use the cus_email from the session variable to instantiate the User class
$user = new User($_SESSION['cus_email']);
$userInfo = $user->getUserInfo();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account - Hotpot</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div id="account-content">
    <div id="account-info-container">
        <h1>Account Information</h1>
        <div class="info-container">
            <div class="info-label">
                <h5>Full Name: </h5>
                <h5>Email: </h5>
                <h5>Phone Number: </h5>
                <h5>Password: </h5>
            </div>
            <div class="info-value">
                <h5> <?php echo $userInfo['cus_name']; ?></h5>
                <h5><?php echo $userInfo['cus_email']; ?></h5>
                <h5> <?php echo $userInfo['cus_phone_no']; ?></h5>
                <h5> </h5> <!-- Password is intentionally left blank -->
            </div>
        </div>
        <div class="account-buttons">
            <button type="button" onclick="location.href='changeaccount.php?id=' + encodeURIComponent('<?php echo $userInfo['cus_email']; ?>')">Change</button>
            <form method="POST">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>
    </div>
</div>
</body>
<?php include 'footer.php'; ?>
</html>
