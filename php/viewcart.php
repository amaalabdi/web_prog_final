<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-image: linear-gradient(to right, #355C7D, #6C5B7B, #C06C84);
        }
        #order, #total{
            background-color: rgba(0,0,150, 0.7);
            color:white;
            font-size:150%;
            width:50%;
			margin:auto;
			padding:5px;
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

        #submit{
            background-color:red;
            color:white;
			width:250px;
			height:50px;
			border-radius:100px;
			border:none;
            transition: background-color 0.5s ease;
            font-size:120%;
            float:left;
		}
		#submit:hover{
			background-color:pink;
        }
        
        h2{
            text-align:center;
            font-size:200%;
        }
    </style>
</head>


<body>
<h2>Your Cart Items</h2>
<?php
require('db.php');
session_start();

$total=0;
$user_id= $_SESSION['username'];

$car_id = $_POST['submit_id'];


$user_id = mysqli_real_escape_string($con,$user_id);
$car_id = mysqli_real_escape_string($con, $car_id);

$query="INSERT INTO `orders`(`customer_id`, `car_id`) VALUES ('$user_id', '$car_id')";
mysqli_query($con, $query);


$query2="INSERT INTO `user_orders`(`customer_id`, `car_id`) VALUES ('$user_id', '$car_id')";
$result=mysqli_query($con, $query2) or die(mysql_error());


$aquery="SELECT * FROM `user_orders`";
$aresult=mysqli_query($con, $aquery) or die(mysql_error()); 
while($arow=mysqli_fetch_assoc($aresult)){
    $n=$arow['car_id'];

    $car_query= "SELECT * FROM `inventory` WHERE `car_id`='$n'";
    $car_result=mysqli_query($con, $car_query) or die(mysql_error());
    while($line=mysqli_fetch_assoc($car_result)){
        echo "<div id='order'>";
        echo $line['car_id'] . "<br>";
        echo "<p>Car Name: " . $line['car_name'] . " " . $line['car_make'] . "</p>";
        echo "<p>Car Type: " . $line['car_type'] . "</p>";
        echo "<p>Car Price: $" . $line['price'] . " per day</p>";
        echo"</div>";
        $total = $total + $line['price'];
        echo "<br><br>";
    }
}
echo "<div id='total'>";
echo "<p>Cart Total: $" . $total . "</p>";

?>

<form action="checkout.php" method="post">
    <input type="hidden" name="items" value="<?php echo $total;?>">
    <input type="submit" name="checkout" id="submit" value="Buy Items">
</form>

<a href="inventory.php">Continue Shopping</a>
<?php echo "</div>"; ?>


</body>
</html>