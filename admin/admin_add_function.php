<?php 
include_once("../config/constant.php"); 

class Admin_Add{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function add_package_info($package_name, $food, $pax, $room, $price){
        $sql = "INSERT INTO `menu` (package_name, food, pax, room, price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssisi", $package_name, $food, $pax, $room, $price);
        if($stmt->execute()){
            echo "Data inserted successfully";
        } else {
            die("Error: " . $stmt->error);
        }
    }
}
?>