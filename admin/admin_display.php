<?php
include_once '../config/constant.php';
include_once 'header.php';
include_once 'admin_delete.php';
include_once 'admin_login_checking.php';
include_once 'status_change.php';

$checkLogin= new AdLogin_checking(); 
$checkLogin -> redirectLogin();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>hotpot</title>
        <style>
            .container{
                margin: 10px 20px;
            }

            .addbtn{
                align-items: center;
                background-color: #04AA6D;
                border-radius: 10px;
                border-color: #04AA6D;
                padding: 12px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            .addbtn:hover {
            background-color: #2E8B57;
            border-color: #000000;
            }

            .btn{
                align-items: center;
                background-color: #800020;
                color: white;
                border-color: re#800020;
                padding: 10px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            .btn a{
                color: white;
            }

            .btn:hover {
            background-color: #000000;
            border-color: #000000;
            }

            #admin {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #admin td, #admin th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #admin th{
                
                box-shadow: .8px 0px 1.5px 0 rgba(0,0,0,0.2);
            }

            #admin tr{
                box-shadow: 0 .5px 2px 0 rgba(0,0,0,0.2);
                border-radius: 4px;
            }

            #admin tr:hover {background-color: #e7e7e7; color: black;}

            #admin th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
            }

            /* General table styling */
            table {
                border-collapse: collapse; /* Collapses borders into a single border */
                width: 100%; /* Full width tables */
                margin-bottom: 20px; /* Adds some space between tables */
            }

            /* Table header styling */
            table thead {
                background-color: #f2f2f2; /* Light grey background for headers */
            }

            /* Table header cells styling */
            table thead th {
                border: 1px solid #ddd; /* Light grey border for header cells */
                padding: 8px; /* Padding for header cells */
                text-align: left; /* Align text to the left */
            }

            /* Table body cells styling */
            table tbody td {
                border: 1px solid #ddd; /* Light grey border for body cells */
                padding: 8px; /* Padding for body cells */
            }

            /* Table row hover effect */
            table tbody tr:hover {
                background-color: #f5f5f5; /* Light grey background on hover */
            }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>MENU</h1>
                <table id="menuTable">
                    <thead>
                        <tr>
                            <th scope="col">Package Id</th>
                            <th scope="col">Package Name</th>
                            <th scope="col">Food</th>
                            <th scope="col">Pax</th>
                            <th scope="col">Room</th>
                            <th scope="col">Price</th>
                            <th scope="col">Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "Select * from menu";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                                $package_id = $row['package_id'];
                                $package_name = $row['package_name'];
                                $food = $row['food'];
                                $pax = $row['pax'];
                                $room = $row['room'];
                                $price = $row['price'];
                                $formatted_price = "RM " . number_format($price, 2, '.', ',');
                                echo '<tr>
                                <th scope="row">'.$package_id.'</th>
                                <td>'.$package_name.'</td>
                                <td>'.$food.'</td>
                                <td>'.$pax.'</td>
                                <td>'.$room.'</td>
                                <td>'.$formatted_price.'</td>
                                <td>
                                <button class="btn"><a href="admin_delete.php?deleteid='.$package_id.'&type=package">Delete</a></button>
                                </td>
                                </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <button class="addbtn"><a href="admin_add.php">Add menu</a></button>

                <h1>BOOKING</h1>
                <table id="bookingTable">
                    <thead>
                        <tr>
                            <th scope="col">Booking No</th>
                            <th scope="col">Package Name</th>
                            <th scope="col">Customer Email</th>
                            <th scope="col">Receipt No</th>
                            <th scope="col">People No</th>
                            <th scope="col">Date and Time</th>
                            <th scope="col">Completed</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "Select b.*, p.completed, p.receipt_no from booking b, payment p where p.receipt_no = b.booking_no";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                                $booking_no = $row['booking_no'];
                                $package_name = $row['package_name'];
                                $cus_email = $row['cus_email'];
                                $receipt_no = $row['receipt_no'];
                                $people_no = $row['people_no'];
                                $date_time = $row['date_time']; 
                                $completed = $row['completed'];
                                echo '<tr>
                                <th scope="row">'.$booking_no.'</th>
                                <td>'.$package_name.'</td>
                                <td>'.$cus_email.'</td>
                                <td>'.$receipt_no.'</td>
                                <td>'.$people_no.'</td>
                                <td>'.$date_time.'</td>
                                <td>'.$completed.'</td>
                                <td>
                                    <form action="status_change.php" method="post">
                                        <input type="hidden" name="booking_id" value="'.$booking_no.'">
                                        <button type="submit" class="btn btn-primary">Change</button>
                                    </form>
                                    <form action="admin_delete.php" method="get">
                                        <input type="hidden" name="deleteno" value="'.$booking_no.'">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>