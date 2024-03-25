<?php
class Login_checking {
    private $customer_email;

    public function __construct() {
        if (isset($_SESSION['cus_email'])) {
            $this->customer_email= $_SESSION['cus_email'];
        }
    }

    function isLoggedIn() {
        if (isset($this->customer_email)) {
            return true; // User is logged in
        }
        return false; // User is not logged in
    }
}
