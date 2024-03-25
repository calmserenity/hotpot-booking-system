<?php
include ('../config/constant.php'); 


if (isset($_POST['booking_no'])) {
    $bookingNo = $_POST['booking_no'];

    $stmt = $conn->prepare("DELETE FROM booking WHERE booking_no = ?");
    $stmt->bind_param("s", $bookingNo);
    $stmt->execute();


    if ($stmt->affected_rows > 0) {
        echo "Booking deleted successfully.";
    } else {
        echo "No booking found with the provided ID.";
    }


    $stmt->close();
    $conn->close();
} else {
    echo "No booking ID provided.";
}
?>