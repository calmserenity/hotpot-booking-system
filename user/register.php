<?php
include_once 'header.php'; // Include the header

class SignupForm {
    public function renderForm() {
        echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';
        echo '<script>
                function validatePassword() {
                    var password = document.getElementById("password").value;
                    var confirmPassword = document.getElementById("confirm_password").value;
                    var passwordRequirements = /^(?=.*[0-9])(?=.*[!@#\$%\^&\*])[a-zA-Z0-9!@#\$%\^&\*]{8,}$/;
                    
                    if (!passwordRequirements.test(password)) {
                        alert("Password must be 8 letters long with at least 3 digits and 1 symbol.");
                        return false;
                    }
                    
                    if (password !== confirmPassword) {
                        alert("Passwords do not match.");
                        return false;
                    }
                    
                    return true;
                }
              </script>';
        echo '<div class="register-center-content">
        <div id="signup-form-container">
            <h1>Register</h1>
            <form id="signup-form" method="post" action="" onsubmit="return validatePassword()">
                <div class="input-icon-container">
                    <input type="text" id="name" name="name" required placeholder="Please enter your name">
                    <i class="fas fa-user input-icon"></i>
                </div>
                <div class="input-icon-container">
                    <input type="email" id="email" name="email" required placeholder="Please enter your email">
                    <i class="fas fa-envelope input-icon"></i>
                </div>
    
    
                <div class="input-icon-container">
                    <input type="password" id="password" name="password" required placeholder="Please enter your password">
                    <i class="fas fa-lock input-icon"></i>
                </div>
    
                <div class="password-requirements">
                    <span style="color: red;">!</span> Password must be 8 letters long with at least 3 digit and 1 symbol <span style="color: red;">!</span>
                </div>
    
                <div class="input-icon-container">
                    <input type="password" id="confirm_password" name="confirm_password" required placeholder="Please enter your confirm password">
                    <i class="fas fa-lock input-icon"></i>
                </div>
    
                <div class="input-icon-container">
                    <input type="tel" id="phone" name="phone" required placeholder="Please enter your phone number">
                    <i class="fas fa-phone input-icon"></i>
                </div>
                <div>
                    <label for="agree">
                        <input type="checkbox" name="agree" id="agree" value="yes" required> I agree to the terms & conditions
                    </label>
                </div>
                <div>
                    <input type="submit" id="submit" name="submit" value="Register">
                </div>
            </form>
            <p>Already have an account? <a href="userlogin.php">Login</a></p>
        </div>
    </div>';
    }

    public function processRegistration() {
        global $conn;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            try {
                // Prepare and bind for the customer table
                $stmt = $conn->prepare("INSERT INTO customer (cus_email, cus_phone_no, cus_password, cus_name) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $email, $phone, $hashedPassword, $name);

                // Set parameters and execute
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $password = $_POST['password']; // The plain text password
                $name = $_POST['name'];

                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmt->execute();

                // Redirect to userlogin.php after successful registration
                echo '<script>
                        alert("Registration successful.");
                        window.location.href = "userlogin.php"; // Redirect to userlogin.php
                     </script>';
            } catch (mysqli_sql_exception $e) {
                // Handle the exception
                if ($e->getCode() == 1062) { // 1062 is the error code for duplicate entry
                    // Display a JavaScript alert for duplicate email or phone number
                    echo '<script>
                            alert("The email address or phone number is already in use. Please use a different email address or phone number.");
                         </script>';
                } else {
                    // For other errors, you might want to log the error or display a generic error message
                    echo '<script>
                            alert("An error occurred: ' . $e->getMessage() . '");
                         </script>';
                }
            }
        }
    }
}

// Assuming $conn is your database connection

$signupForm = new SignupForm();
$signupForm->processRegistration(); // Call the processRegistration method to handle form submission
$signupForm->renderForm();

include 'footer.php'; // Include the footer
?>