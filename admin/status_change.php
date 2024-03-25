<?php
include_once '../config/constant.php';

if (isset($_POST['booking_id'])) {
    $bookingId = mysqli_real_escape_string($conn, $_POST['booking_id']);

    // Fetch the current completed status for the booking
    $sql = "SELECT completed FROM payment WHERE receipt_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $completed = $row['completed'];
    $newStatus = $completed; 

    // Toggle the completed status
    $newStatus = $completed == 'Yes' ? 'No' : 'Yes';

    // Update the completed status in the database
    $sql = "UPDATE payment SET completed = ? WHERE receipt_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newStatus, $bookingId);
    $stmt->execute();

    header('Location: ' . $_SERVER['HTTP_REFERER']); // Redirect back to the previous page
}
?>