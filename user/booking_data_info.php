<?php
include_once("../config/constant.php");
class booking_info_display{
    public function displayBookingInfo($bookingData) {
        if (isset($_SESSION['booking_data'])) {
            echo "<div class='booking-info'>";
            echo "<h2>Booking Information:</h2>";
            echo "<h5>Name: " . $bookingData['name'] . "</h5>";
            echo "<h5>Email: " . $bookingData['email'] . "</h5>";
            echo "<h5>PAX: " . $bookingData['pax'] . "</h5>";
            echo "<h5>Date: " . $bookingData['date'] . "</h5>";
            echo "<h5>Time: " . $bookingData['time'] . "</h5>";
            echo "<h5>Package: " . $bookingData['package'] . "</h5>";
            echo "<h5>Payment Type: " . $bookingData['pay_type'] . "</h5>";
            echo "<h5>Subtotal: " . $bookingData['subtotal'] . "</h5>";
            echo "</div>";
        } else {
            echo "<div class='booking-info'>";
            echo "<h2>No booking information found.</h2>";
            echo "</div>";
        }
    }
}