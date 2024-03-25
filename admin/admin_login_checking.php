<?php
class AdLogin_checking {
    private $admin_name;
    private $admin_email;

    public function __construct() {
        if (isset($_SESSION['Ad_name'])) {
            $this->admin_name = $_SESSION['Ad_name'];
        }
        if (isset($_SESSION['Ad_email'])) {
            $this->admin_email = $_SESSION['Ad_email'];
        }
    }

    function isLoggedIn() {
        if (isset($this->admin_name)) {
            return true; // User is logged in
        }
        return false; // User is not logged in
    }

    function redirectLogin(){
        if (!isset($this->admin_email)) {
            // If the user is not logged in, redirect to the login page or display an error message
            header('Location: ../admin/adminlogin.php'); 
            exit;
        }
    }
}
