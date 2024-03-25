<?php 
include_once 'header.php'; // Include the header
include_once 'User.php'; // Include the User class file

// Assuming the session variable for customer name is set in the header or elsewhere
$cusEmail = $_SESSION['cus_email'];

// Instantiate the User class with the customer's email
$user = new User($cusEmail);

// Fetch customer information using the User class
$customerInfo = $user->getUserInfo();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Update the session variables with the new values
    $_SESSION['cus_name'] = $_POST['name'];
    $_SESSION['cus_email'] = $_POST['email'];
    $_SESSION['cus_phone_no'] = $_POST['phone_number'];
    $_SESSION['cus_password'] = $_POST['password'];

    // Call the updateCustomerInfo method of the User class
    if ($user->updateCustomerInfo($_SESSION['cus_name'], $_SESSION['cus_email'], $_SESSION['cus_phone_no'], $_SESSION['cus_password'])) {
        // Redirect to the account page or another page after updating
        header("Location: account.php");
        exit();
    } else {
        // Handle the error, e.g., show a message to the user
        echo "Failed to update your information. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Account Information - Hotpot</title>
    <link rel="stylesheet" href="../user/user.css">
</head>
<body>
    <div id="changeaccount-content">
        <div id="changeaccount-info-container">
            <h1>Update Account Information</h1>
            <div class="changeinfo-container">
                <form action="" method="POST">
                    <div class="changeinfo-line">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $customerInfo['cus_name']; ?>">
                    </div>
                    <div class="changeinfo-line">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $customerInfo['cus_email']; ?>" readonly>
                    </div>
                    <div class="changeinfo-line">
                        <label for="phone_number">Phone Number:</label>
                        <input type="text" id="phone_number" name="phone_number" value="<?php echo $customerInfo['cus_phone_no']; ?>">
                    </div>
                    <div class="changeinfo-line">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" name="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php include_once 'footer.php';?>