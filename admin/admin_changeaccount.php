<?php 
include_once 'header.php'; // Include the header


$AdEmail = $_SESSION['Ad_email'];

// Function to fetch all admin information from the database based on Ad_name
function fetchAdminInfo($AdEmail) {
    global $conn; // Assuming $conn is your database connection

    // Prepare an SQL statement to fetch all admin information
    $stmt = $conn->prepare("SELECT * FROM admin WHERE Ad_email = ?");
    $stmt->bind_param("s", $AdEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

// Function to update admin information in the database
function updateAdminInfo($email, $name, $password) {
    global $conn; // Assuming $conn is your database connection

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL statement to update the admin information
    $stmt = $conn->prepare("UPDATE `admin` SET Ad_name = ?, Ad_password = ? WHERE Ad_email = ?");
    $stmt->bind_param("sss", $name, $hashedPassword, $email);
    $stmt->execute();

    return true; // Return true to indicate success
}

// Fetch admin information based on Ad_name
$adminInfo = fetchAdminInfo($AdEmail);

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Update the session variables with the new values
    $_SESSION['Ad_name'] = $_POST['name'];
    $_SESSION['Ad_password'] = $_POST['password'];

    // Call the function to update the database
    if (updateAdminInfo($adminInfo['Ad_email'], $_SESSION['Ad_name'], $_SESSION['Ad_password'])) {
        // Redirect to the admin account page or another page after updating
        header("Location: admin_account.php");
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
</head>
<body>
    <div id="adminchangeaccount-content">
        <div id="adminchangeaccount-info-container">
            <h1>Update Account Information</h1>
            <div class="adminchangeinfo-container">
                <form action="" method="POST">
                    <div class="adminchangeinfo-line">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $adminInfo['Ad_name']; ?>">
                    </div>
                    <div class="adminchangeinfo-line">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $adminInfo['Ad_email']; ?>" readonly>
                    </div>
                    <div class="adminchangeinfo-line">
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
