<?php
include_once 'header.php'; // Include the header
include 'admin.php';

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
        
    $_SESSION['Ad_name'] = "Admin";

    // Redirect to the login page
    header("Location: adminlogin.php");
    exit; // Ensure no further output is sent

    }

}


$Admin = new Admin($_SESSION['Ad_name']);
$AdminInfo = $Admin->getAdminInfo();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account - Hotpot</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div id="adminaccount-content">
    <div id="adminaccount-info-container">
        <h1>Account Information</h1>
        <div class="admininfo-container">
            <div class="admininfo-label">
                <h5>Full Name: </h5>
                <h5>Email: </h5>
                <h5>Password: </h5>
            </div>
            <div class="admininfo-value">
                <h5> <?php echo $AdminInfo['Ad_name']; ?></h5>
                <h5><?php echo $AdminInfo['Ad_email']; ?></h5>
                <h5> </h5> <!-- Password is intentionally left blank -->
            </div>
        </div>
        <div class="adminaccount-buttons">
            <button type="button" onclick="location.href='admin_changeaccount.php?id=' + encodeURIComponent('<?php echo $AdminInfo['Ad_email']; ?>')">Change</button>
            <form method="POST">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
