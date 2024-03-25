<?php

include_once 'header.php'; // Include the header

// Ensure 'cus_name' session variable is set
if (!isset($_SESSION['cus_name'])) {
    // If 'cus_name' is not set, assign a default value of "Guest"
    $_SESSION['cus_name'] = "Guest";
}

// Check if the user is logged in
if (isset($_SESSION['cus_name']) && $_SESSION['cus_name'] !== "Guest") {
    // If the user is logged in, redirect to index.php
    header("Location: index.php");
    exit; // Ensure no further output is sent
}

class LoginForm {
    public function renderForm() {
        echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';
        echo '<div id="login-content">
                <div id="login-form-container">
                    <h1>Login</h1>
                    <form id="login-form" method="post" action="">
                        <div class="input-icon-container">
                            <input type="email" id="email" name="email" required placeholder="Please enter your email">
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        <div class="input-icon-container">
                            <input type="password" id="password" name="password" required placeholder="Please enter your password">
                            <i class="fas fa-lock input-icon"></i>
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
                    <p>Don\'t have an account? <a href="register.php">Register now</a></p>
                    <p>Forgot your password? <a href="newpassword.php">Change it here</a></p>
                </div>
            </div>';
    }

    public function processLogin() {
        global $conn;

        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT cus_password, cus_name, cus_email FROM customer WHERE cus_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['cus_password'];
            $cusName = $row['cus_name']; // Fetch the customer's name
            $cusEmail = $row['cus_email'];

            if (password_verify($password, $hashedPassword)) {
                // Password is correct, set session variable
                $_SESSION['cus_name'] = $cusName; // Set session variable to the customer's name
                $_SESSION['cus_email'] = $cusEmail;

                // Regenerate session ID
                session_regenerate_id();

                // Redirect to the desired page
                header("Location: index.php");
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


include 'footer.php'; // Include the footer
?>
