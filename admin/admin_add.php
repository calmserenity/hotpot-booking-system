<?php
include_once '../config/constant.php';
include 'header.php';
include_once 'admin_add_function.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $package_name = $_POST["package_name"];
    $pax = $_POST["pax"];
    $food = $_POST["food"];
    $room = $_POST["room"]; 
    $price = $_POST["price"];

    $Admin_add = new Admin_Add($conn);
    $Admin_add->add_package_info($package_name, $food, $pax, $room, $price);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>hotpot</title>

    <style>
        body {
    font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 10px auto;
            padding: 20px;
            background-color: #e7e7e7;
            border-radius: 10px;
        }

        h1{
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
  </head>

  <body>
    <div class="container">
        <form method="post">
            <h1>ADD MENU</h1>
            <div class="form-group">
                <label>Package Name</label>
                <input type="text" name="package_name" id="package_name" placeholder="Package Name" required> 
            </div>
            <div class="form-group">
                <label>Pax</label>
                <input type="number" class="form-control" placeholder="" name="pax" required>
            </div>
            <div class="form-group">
                <label>Food</label>
                <input type="text" name="food" id="food" placeholder="Food" required> 
            </div>
            <div class="form-group">
                <label>Room</label>
                <select name="room" id="room" class="form-control" >
                <option value="yes">yes</option>
                <option value="no">no</option>
                </select>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" placeholder="Price" name="price" required>
            </div>

            <button type="submit" name="submit" class="btn-primary">Submit</button>
        </form>
    </div>
  </body>
</html>

