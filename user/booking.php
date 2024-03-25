<?php
include_once("../config/constant.php");

class Booking {
    private $conn; // Database connection
    private $email;
    private $name;
    private $pax;
    private $date;
    private $time;
    private $package;
    private $pay_type;
    private $receipt_no; // Added receipt_no property

    private $pay_total;

    public function __construct($conn, $email, $name, $pax, $date, $time, $package, $pay_type, $pay_total) {
        $this->conn = $conn;
        $this->email = $email;
        $this->name = $name;
        $this->pax = $pax;
        $this->date = $date;
        $this->time = $time;
        $this->package = $package;
        $this->pay_type = $pay_type;
        $this -> pay_total= $pay_total;
    }


    public function save() {
        // Combine date and time into a single string
        $datetime = $this->date . ' ' . $this->time;
    
        // Attempt to create a DateTime object from the input
        $dateTimeObj = DateTime::createFromFormat('Y-m-d H:i', $datetime);
    
        // Check if the DateTime object was successfully created
        if ($dateTimeObj === false) {
            // Handle the error, e.g., by logging it or setting an error message
            return false;
        }
    
        // Format the DateTime object into a MySQL-compatible string
        $formattedDatetime = $dateTimeObj->format('Y-m-d H:i:s');
    
        // Prepare the SQL statement for the booking table
        $stmt = $this->conn->prepare("INSERT INTO booking (cus_name, package_name, cus_email, people_no, date_time) VALUES ( ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $this->name, $this->package, $this->email, $this->pax, $formattedDatetime);
        
        // After successfully inserting into the booking table, insert into the payment table
        if ($stmt->execute()) {
            // Get the last inserted receipt_no
            $lastInsertedReceiptNo = $this->conn->insert_id;

            // Prepare the SQL statement for the payment table
            $stmtPayment = $this->conn->prepare("INSERT INTO payment (receipt_no, pay_type, pay_total, completed) VALUES (?, ?, ?, 'No')");

            // Bind the parameters including the payment total
            $stmtPayment->bind_param("iss", $lastInsertedReceiptNo, $this->pay_type, $this->pay_total);

            // Execute the statement for the payment table
            return $stmtPayment->execute();
        }

        return false;
    }
}
?>
