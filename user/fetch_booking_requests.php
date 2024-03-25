<?php

class BookingRequests{
    private $conn; 

    public function __construct($conn){
        $this -> conn = $conn;
    }

    public function fetchBookingRequests(){
        // Check if the user is logged in
        if (!isset($_SESSION['cus_email'])) {
            // If the user is not logged in, redirect to the login page or display an error message
            echo 'not logged in';
            exit;
        }
    
        $email = $_SESSION['cus_email']; // Get the email from the session
    
        // Prepare the SQL query to fetch booking information along with the payment status
        $sql = "SELECT b.*, p.completed, p.receipt_no FROM booking b LEFT JOIN payment p ON b.booking_no = p.receipt_no WHERE b.cus_email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Initialize an array to hold the booking information
        $bookings = array();
    
        // Fetch the booking information and store it in the array
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
    
        // Close the statement
        $stmt->close();
    
        // Return the booking information
        return $bookings;
    }    
}

