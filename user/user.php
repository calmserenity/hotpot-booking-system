<?php
class User {
    private $conn;
    private $cusEmail;
    private $userInfo;

    public function __construct($cusEmail) {
        global $conn;
        $this->conn = $conn;
        $this->cusEmail= $cusEmail;
        $this->fetchUserInfo();
    }

    private function fetchUserInfo() {
        $stmt = $this->conn->prepare("SELECT * FROM customer WHERE cus_email = ?");
        $stmt->bind_param("s", $this->cusEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $this->userInfo = $result->fetch_assoc();
        } else {
            // Redirect to the login page without setting a session variable
            header('Location: userlogin.php');
            exit();
        }
    }

    public function getUserInfo() {
        return $this->userInfo;
    }

    // Method to update customer information in the database
    public function updateCustomerInfo($name, $email, $phoneNo, $password) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an SQL statement to update the customer information
        $stmt = $this->conn->prepare("UPDATE customer SET cus_email = ?, cus_phone_no = ?, cus_password = ?, cus_name = ? WHERE cus_email = ?");
        $stmt->bind_param("sssss", $email, $phoneNo, $hashedPassword, $name, $email);
        $stmt->execute();

        return true; // Return true to indicate success
    }
}
