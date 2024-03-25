<?php
include_once("../user/header.php"); 
include_once("../config/constant.php");
include_once("../user/booking_data_info.php");
$bookingData = $_SESSION['booking_data'];
$booking_info_display= new booking_info_display();

class Payment{
    public function paymentForm(){?>
        <script> 
            function validateCard(){
                var cardno= document.getElementById("cardno").value;
                var cardRequirements = /^\d{16}$/;
                
                if (!cardRequirements.test(cardno)){
                    alert("Card Number must be 16 digits.")
                    return false; 
                }
                return true; 
            }
        </script> 
        <h2>Card</h2> 
        <form id="payment-form" method="POST" action="" onsubmit="return validateCard()">
            <input type="text" name="cardno" id="cardno" placeholder="Card Number" required> 
            <input type="date" name="expdate" id="expdate" placeholder="Card Expiry Date" required>
            <input type="number" name="securitycode" id="securitycode" placeholder="Security Code" required>
            <input type="text" name="cardholdername" id="cardholdername" placeholder="Cardholder Name" required>
            <input type="submit" name="submit" id="submit" value="PAY"> 
        </form> 
    <?php
    }

    public function redirectPage(){
        if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
            header("Location: receipt.php");
            exit(); 
        }
    }
}
?>

<div class="payment-container">
    <div class="payment-inner-container"> 
        <?php
            $Payment = new Payment();
            $Payment->redirectPage();
            $Payment->paymentForm();
        ?>
    </div>
    <div class="booking-info-class">
        <div class="booking-info">
            <?php $booking_info_display->displayBookingInfo($bookingData);?>
        </div>
    </div>
</div>

<?php include_once("footer.php")?>