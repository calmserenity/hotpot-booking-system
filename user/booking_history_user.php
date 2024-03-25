<?php

include_once ('../config/constant.php'); 
include_once('../user/fetch_booking_requests.php');
include_once ('../user/header.php');


if (!isset($_SESSION['cus_email'])) {
    // If the user is not logged in, redirect to the login page or display an error message
    echo 'not logged in';
    exit;
}

$bookingRequestsObj = new BookingRequests($conn);
$bookingRequests = $bookingRequestsObj->fetchBookingRequests();

?>
 
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div class="history-container">
    <h1>Booking History</h1>
        <table class="grey-table">
        <title>Booking History</title>
            <tr>
                <th>Booking Ref</th>
                <th>Receipt No</th>
                <th>Customer Email</th>
                <th>Package Name</th>
                <th>Pax</th>
                <th>Date/Time</th>
                <th>Completed</th> <!-- New column header for the completed status -->
                <th>Cancel</th>
            </tr>
            <?php foreach ($bookingRequests as $request): ?>
            <tr>
                <td><?php echo $request['booking_no']; ?></td>
                <td><?php echo $request['receipt_no']; ?></td> <!-- Assuming receipt_no is the correct column name -->
                <td><?php echo $request['cus_email']; ?></td>
                <td><?php echo $request['package_name']; ?></td>
                <td><?php echo $request['people_no']; ?></td>
                <td><?php echo $request['date_time']; ?></td>
                <td><?php echo $request['completed']; ?></td> <!-- Display the completed status -->
                <td><a href="#" class="cancel-link" onclick="return confirmCancel(this, '<?php echo $request['booking_no']; ?>');">Cancel</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>


<script>
function confirmCancel(link, bookingNo) {
    if (confirm("Are you sure you want to cancel this booking?")) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_booking.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status === 200) {
                alert('Booking cancelled successfully.');
                link.parentNode.parentNode.remove();
            } else {
                alert('An error occurred. Please try again.');
            }
        };
        xhr.send('booking_no=' + bookingNo);
        
        return false;
    } else {
        return false;
    }
}
</script>
</html>

<?php
include_once ('footer.php');
?>
