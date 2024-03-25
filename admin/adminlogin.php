<?php
include_once 'header.php'; // Include the header

// Ensure 'Ad_name' session variable is set
if (!isset($_SESSION['Ad_name'])) {
    // If 'Ad_name' is not set, assign a default value of "Admin"
    $_SESSION['Ad_name'] = "Admin";
}
// Check if the user is logged in
if (isset($_SESSION['Ad_name']) && $_SESSION['Ad_name'] !== "Admin") {
    // If the user is logged in, redirect to admin_account.php
    header("Location: admin_account.php");
    exit; // Ensure no further output is sent
}

class LoginForm {
    public function renderForm() {
        echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';
        echo '<div id="adminlogin-content">
        <div id="adminlogin-form-container">
            <h1>Login</h1>
            <form id="adminlogin-form" method="post" action="">
                <div class="admininput-icon-container">
                    <input type="email" id="email" name="email" required placeholder="Please enter your email">
                    <i class="fas fa-envelope admin-input-icon"></i>
                </div>
                <div class="admininput-icon-container">
                    <input type="password" id="password" name="password" required placeholder="Please enter your password">
                    <i class="fas fa-lock admin-input-icon"></i>
                </div>
                <div>
                    <label for="remember">
                        <input type="checkbox" id="remember" name="remember" value="yes"> Remember me
                    </label>
                </div>
                <div>
                    <input type="submit" id="submit" name="submit" value="Login">
                </div>
            </form>
            <p>Don\'t have an account? <a href="adminregister.php">Register now</a></p>
            <p>Forgot your password? <a href="newadminpassword.php">Change it here</a></p>
        </div>
    </div>';
    }

    
    public function processLogin() {
        global $conn;
    
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $stmt = $conn->prepare("SELECT Ad_password, Ad_name, Ad_email FROM `admin` WHERE Ad_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['Ad_password'];
            $AdName = $row['Ad_name']; // Fetch the admin's name
            $AdEmail = $row['Ad_email'];
    
            if (password_verify($password, $hashedPassword)) {
                // Password is correct, set session variable
                $_SESSION['Ad_name'] = $AdName; // Set session variable to the admin's name
                $_SESSION['Ad_email'] = $AdEmail;

                // Redirect to admin_account.php
                header("Location: admin_account.php");
                exit; // Ensure no further output is sent
            } else {
                echo '<script>alert("Incorrect password.");</script>';
            }
        } else {
            echo '<script>alert("Email not found.");</script>';
        }
    
        $stmt->close();
    }
}

// Check if the form has been submitted and process the login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $loginForm = new LoginForm();
    $loginForm->processLogin();
}

// Render the form if the user is not logged in
$loginForm = new LoginForm();
$loginForm->renderForm();

?>
