<?php
include ('../user/header.php');
include_once ('../user/login_checking.php');

$checkLogin= new Login_checking(); 

$query="SELECT * from menu"; 
$result = mysqli_query($conn, $query); 

// Check if the query was successful
if ($result === false) {
    die("Error executing query: " . mysqli_error($conn));
}
?>

<div class="banner">
    <img src="../images/banner.gif">
</div>

<section id="menu">
    <div class="menu-large-container">
    <?php
    // Initialize a counter for the menu items
    $menuCounter = 1;

    // Fetch the data from the result and output it
    while ($row = mysqli_fetch_assoc($result)) {
        $price = $row["price"]; 
        $pax = $row["pax"];
        $food= $row["food"];
        $room= $row["room"]; 
        $name = $row["package_name"];
        // Use the counter to generate the image URL
        $imageUrl = "../images/menu" . $menuCounter . ".png";
        ?>
        <div class="menu-row1">
            <div class="menu">
                <?php
                if ($checkLogin -> isLoggedIn()){?>
                <a href="../user/booking_main.php">
                    <img src="<?php echo $imageUrl; ?>">
                    <h2><?php echo $name; ?></h2>
                    <h3><?php echo $price; ?></h3>
                    <div class="info-overlay">
                        <h3 class="desc-text"><?php echo $name?></h3>
                        <h4 class="desc-text">PAX: UP TO <?php echo $pax?> PEOPLE </h4>
                        <h4 class="desc-text">ROOM: <?php echo $room?> </h4>
                        <h4 class="desc-text">FOOD: <?php echo $food?></h4>
                    </div>
                </a><?php 
                }
                else {?> 
                <a href="../user/userlogin.php">
                    <img src="<?php echo $imageUrl; ?>">
                    <h2><?php echo $name; ?></h2>
                    <h3><?php echo $price; ?></h3>
                    <div class="info-overlay">
                        <h3 class="desc-text"><?php echo $name?></h3>
                        <h4 class="desc-text">PAX: UP TO <?php echo $pax?> PEOPLE </h4>
                        <h4 class="desc-text">ROOM: <?php echo $room?> </h4>
                        <h4 class="desc-text">FOOD: <?php echo $food?></h4>
                    </div>
                </a><?php 
                }?>
            </div>
        </div>
        <?php
        // Increment the counter for the next menu item
        $menuCounter++;
    }?>
    </div>
</section>

<?php
// Free the result set after processing all data
mysqli_free_result($result);
?>

<?php include ('../user/footer.php')?>
