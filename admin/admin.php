<?php
class Admin {
    private $conn;
    private $AdName;
    private $adminInfo;

    public function __construct($AdName) {
        global $conn;
        $this->conn = $conn;
        $this->AdName = $AdName;
        $this->fetchAdminInfo();
    }

    private function fetchAdminInfo() {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE Ad_name = ?");
        $stmt->bind_param("s", $this->AdName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $this->adminInfo = $result->fetch_assoc();
        } else {
            $_SESSION['Ad_name'] = "Admin data not found. Please log in again.";
            header('Location: adminlogin.php');
            exit();
        }
    }

    public function getAdminInfo() {
        return $this->adminInfo;
    }
    
    
}
