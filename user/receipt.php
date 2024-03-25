<?php
include_once("../config/constant.php");
include_once("header.php");

if (!isset($_SESSION['booking_data'])) {
    // If the user is not logged in, redirect to the login page or display an error message
    echo 'No data';
    exit;
}
else{
    $bookingData = $_SESSION['booking_data'];
}

if (isset($_SESSION['booking_data'])) {
    echo "<div class='receipt'>";
    echo "<div class='receipt-inner'>";
    echo "<h2>RECEIPT:</h2>";
    echo "<table class='booking-info-table'>";
    echo "<tr><th>Name:</th><td>" . $bookingData['name'] . "</td></tr>";
    echo "<tr><th>Email:</th><td>" . $bookingData['email'] . "</td></tr>";
    echo "<tr><th>PAX:</th><td>" . $bookingData['pax'] . "</td></tr>";
    echo "<tr><th>Date:</th><td>" . $bookingData['date'] . "</td></tr>";
    echo "<tr><th>Time:</th><td>" . $bookingData['time'] . "</td></tr>";
    echo "<tr><th>Package:</th><td>" . $bookingData['package'] . "</td></tr>";
    echo "<tr><th>Payment Type:</th><td>" . $bookingData['pay_type'] . "</td></tr>";
    echo "<tr><th>Subtotal:</th><td>" . $bookingData['subtotal'] . "</td></tr>";
    echo "</table>";
    echo "<button class='receipt-button' onclick=\"window.location.href='../user/index.php'\">Done</button>";
    echo "</div>";
    echo "</div>";
} else {
    echo "<div class='booking-info'>";
    echo "<h2>No booking information found.</h2>";
    echo "</div>";
}   
?>


