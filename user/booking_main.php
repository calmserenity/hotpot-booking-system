<?php
// Start output buffering to prevent headers already sent error
ob_start();

// Include necessary files
include_once ('../config/constant.php'); 
include_once ('../user/header.php');
include_once('../user/booking_logic.php');

// Set the session email for testing purposes
if (!isset($_SESSION['cus_email'])) {
    // If the user is not logged in, redirect to the login page or display an error message
    echo 'not logged in';
    exit;
}

?>
<!-- Include the JavaScript file -->
<script src="../user/booking_script.js"></script>

<!DOCTYPE html>
<html>
<head>   
    <title>Booking Form</title>
</head>
<body>
 
<div class="mirror_container">
    <div class="form-section">
    <h1>Booking Information</h1>
        <form method="POST" action="">
            <input type="text" name="name" id="nameInput" placeholder="Name" required><br>

            <!-- Dynamic package select -->
            <select name="package" id="packageInput">
            <?php
            // Loop through the $packages array and generate the options
            foreach ($packages as $package) {
                echo "<option value=\"" . $package['package_name'] . "\">" . $package['package_name'] . "</option>";
            }
            ?>
            </select><br>

            <input type="number" name="pax" id="paxInput" placeholder="PAX" required><br>  
            <input type="date" name="date" id="dateInput" placeholder="Date" required><br>
            <input type="time" name="time" id="timeInput" placeholder="Time" required><br>

            <!-- Payment type select -->
            <select name="pay_type" id="payTypeInput">
                <option value="ewallet">E-Wallet</option>
                <option value="card">Credit/Debit Card</option>
                <option value="physical">Physical</option>
            </select><br>

            <div class="button-container">
                 <input type="submit" value="Submit">
            </div>

        </form>
    </div>
    <div class="display-section">

        <!-- Display areas for the input values -->
        <h1>Confirmation</h1>

        <p>Name: <span id="nameDisplay"></span></p>
        <p>Package: <span id="packageDisplay"></span></p>
        <p>PAX: <span id="paxDisplay"></span></p>
        <p>Date: <span id="dateDisplay"></span></p>
        <p>Time: <span id="timeDisplay"></span></p>
        <p>Payment Type: <span id="payTypeDisplay"></span></p>
        <p>Subtotal: <span id="subtotalDisplay"></span></p>

    </div>
    <div class="vertical-line"></div> 
</div>


<?php if (isset($_SESSION['error'])): ?>
    <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>
<?php
include ('../user/footer.php');
?>
</body>
</html>
