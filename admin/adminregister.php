<?php
include 'header.php'; // Include the header



class AdminSignupForm {
    public function renderForm() {
        echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';
        echo '<script>
                function validatePassword() {
                    var password = document.getElementById("admin_password").value;
                    var confirmPassword = document.getElementById("admin_confirm_password").value;
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
        echo '<div id="admin-center-content">
                <div id="admin-signup-form-container">
                    <h1>Admin Register</h1>
                    <form id="admin-signup-form" method="post" action="" onsubmit="return validatePassword()">
                    <div class="admin-input-icon-container">
                    <input type="text" id="admin_name" name="name" required placeholder="Please enter your name">
                    <i class="fas fa-user admin-input-icon"></i>
                 </div>

                 <div class="admin-input-icon-container">
                 <input type="email" id="admin_email" name="email" required placeholder="Please enter your email">
                  <i class="fas fa-envelope admin-input-icon"></i>
            </div>

                <div class="admin-input-icon-container">
                    <input type="password" id="admin_password" name="password" required placeholder="Please enter your password">
                    <i class="fas fa-lock admin-input-icon"></i>
                </div>

                <div class="admin-password-requirements">
                    <span style="color: red;">!</span> Password must be 8 letters long with at least 3 digit and 1 symbol <span style="color: red;">!</span>
                </div>

                <div class="admin-input-icon-container">
                     <input type="password" id="admin_confirm_password" name="confirm_password" required placeholder="Please enter your confirm password">
                     <i class="fas fa-lock admin-input-icon"></i>
                </div>

                        <div>
                            <label for="admin_agree">
                                <input type="checkbox" name="agree" id="admin_agree" value="yes" required> I agree to the terms & conditions
                            </label>
                        </div>
                        <div>
                            <input type="submit" id="admin_submit" name="submit" value="Register">
                        </div>
                    </form>
                    <p>Already have an account? <a href="adminlogin.php">Login</a></p>
                </div>
            </div>';
    }



// Assuming $conn is your database connection

public function processRegistration() {
        global $conn;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            try {
                // Corrected SQL query and bind_param call
                $stmt = $conn->prepare("INSERT INTO admin (Ad_email, Ad_name, Ad_password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $email, $name, $hashedPassword);

                // Set parameters and execute
                $email = $_POST['email'];
                $name = $_POST['name'];
                $password = $_POST['password']; // The plain text password

                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmt->execute();

                // Redirect to adminlogin.php after successful registration
                echo '<script>
                        alert("Registration successful.");
                        window.location.href = "adminlogin.php"; // Redirect to adminlogin.php
                     </script>';
            } catch (mysqli_sql_exception $e) {
                // Handle the exception
                if ($e->getCode() == 1062) { // 1062 is the error code for duplicate entry
                    // Display a JavaScript alert for duplicate email
                    echo '<script>
                            alert("The email address is already in use. Please use a different email address.");
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

$adminSignupForm = new AdminSignupForm();
$adminSignupForm->processRegistration(); // Call the processRegistration method to handle form submission
$adminSignupForm->renderForm();
    
?>