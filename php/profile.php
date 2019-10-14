<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-image: linear-gradient(to right, #355C7D, #6C5B7B, #C06C84);
        }
        .history{
            background-color: rgba(0,0,150, 0.7);
            color:white;
            font-size:150%;
            width:50%;
			margin:auto;
			padding:5px;
        }
        h2{
            text-align:center;
            font-size:200%;
        }

        a{
            color:white;
            background-color:red;
            transition: background-color 0.5s ease;
            float:right;
            padding:5px;
            margin:5px;
        }
        a:hover{
            background-color:pink;
        }
    </style>
</head>

<body>

<h2>User Profile</h2>

<?php 
require("db.php");
session_start();

$id = $_SESSION['username'];
$id = mysqli_real_escape_string($con, $id);

echo "<div class='history'>";
echo "Username: " . $id . "<br>";


$order_query = "SELECT * FROM `orders` WHERE `customer_id`='$id'";
$order_result = mysqli_query($con, $order_query) or die(mysql_error());

echo "<h4>Order History</h4>";

while($row=mysqli_fetch_assoc($order_result)){
    $n=$row['car_id'];
    $query = "SELECT * FROM `inventory` WHERE `car_id` = '$n'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    
    while($arow=mysqli_fetch_assoc($result)){

        echo "<p>Car Name: " . $arow['car_name'] . " " . $arow['car_make'] . "</p>";
        echo "<p>Car Type: " . $arow['car_type'] . "</p>";
        echo "<p>Car Price: $" . $arow['price'] . " per day</p>";
        echo "<br><br>";
        
    }
}

?>

<a href="inventory.php">Return to Inventory</a>
<a href="login.php">Login as Different User</a>
</body>
</html>

