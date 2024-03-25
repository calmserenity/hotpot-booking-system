<?php
include_once ("../config/constant.php");
class Admin_Delete{
    private $conn; 
    public function __construct($conn){
        $this->conn = $conn;
    }

    public function deletePackage($package_id){
        $sql = "DELETE from menu WHERE package_id=$package_id"; 
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            header('Location: admin_display.php');
        } else {
            die(mysqli_error($this->conn));
        }
    }

    public function deleteBooking($booking_no){
        $sql = "DELETE FROM booking WHERE booking_no = $booking_no";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            header('Location: admin_display.php');
        } else {
            die(mysqli_error($this->conn));
        }
    }
}

$adminDelete = new Admin_Delete($conn);

if (isset($_GET['deleteid'])) {
    $deleteId = $_GET['deleteid'];
    $adminDelete->deletePackage($deleteId);
}


if (isset($_GET['deleteno'])) {
    $deleteno = $_GET['deleteno'];
    $adminDelete->deleteBooking($deleteno);
}
