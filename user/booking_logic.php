<?php
include_once ('../config/constant.php'); 
include_once ('../user/booking.php'); 

// Fetch package names, price, and pax from the database
$query = "SELECT package_name, price, pax FROM menu ORDER BY package_name ASC";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Error fetching package names: " . mysqli_error($conn));
}

// Manually fetch each row from the result set and add it to the $packages array
$packages = array();
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $packages[] = $row;
}

// Pass the packages array to JavaScript
echo "<script>var packages = " . json_encode($packages) . ";</script>";

// Booking form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Use the email from the session instead of the form input
    $email = $_SESSION['cus_email'];

    // Calculate subtotal
    $selectedPackageName = $_POST['package'];
    $selectedPackage = null;
    foreach ($packages as $package) {
        if ($package['package_name'] === $selectedPackageName) {
            $selectedPackage = $package;
            break;
        }
    }

    // Check if entered pax exceeds the allowed amount
    $enteredPax = $_POST['pax'];
    if ($enteredPax > $selectedPackage['pax']) {
        $_SESSION['error'] = "Entered pax exceeds the allowed amount.";
        exit; // Stop the booking process
    }

    // Calculate the subtotal based on the selected package's price and the number of people (pax)
    $subtotal = $selectedPackage['price'];

    // Store submitted data in the session
    $_SESSION['booking_data'] = array(
        'email' => $email,
        'name' => $_POST['name'],
        'pax' => $_POST['pax'],
        'date' => $_POST['date'],
        'time' => $_POST['time'],
        'package' => $_POST['package'],
        'pay_type' => $_POST['pay_type'],
        'subtotal' => $subtotal // Add subtotal to the session data
    );

    // Instantiate the Booking class with the necessary parameters including the subtotal
    $booking = new Booking($conn, $email, $_POST['name'], $_POST['pax'], $_POST['date'], $_POST['time'], $_POST['package'], $_POST['pay_type'], $subtotal);

    // Save the booking to the database
    if ($booking->save()) {
        echo "Booking saved successfully.";
    } else {
        echo "Error saving booking.";
    }

    // Redirect based on payment type
    switch ($_POST['pay_type']) {
        case 'ewallet':
            header("Location: payment-ewallet.php");
            exit;
        case 'card':
            header("Location: payment.php");
            exit;
        case 'physical':
            header("Location: index.php");
            exit;
        default:
            throw new Exception("Invalid payment type selected.");
    }
}
?>
