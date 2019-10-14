<!DOCTYPE html>
<html>

<head>
    <style>
        body{
            background-image: linear-gradient(to right, #355C7D, #6C5B7B, #C06C84);
        }
        #top{
            background-color: rgba(0,0,150, 0.7);
            color:white;
            font-size:150%;
        }
        #welcome{
            font-size:200%;
            color:white;
        }

        a{
            color:white;
            background-color:red;
			transition: background-color 0.5s ease;
        }
        a:hover{
            background-color:pink;
        }

        img{
            width:450px; height:250px;
        }

        #carinfo{
            float:right;
            width:50%;
			margin:auto;
			padding:5px;
            font-size:200%;
            background-color:rgba(150,150,150, 0.7);
        }
        #submit{
			background-color:red;
			width:250px;
			height:50px;
			border-radius:100px;
			border:none;
            transition: background-color 0.5s ease;
            font-size:120%;
		}
		#submit:hover{
			background-color:pink;
		}

    </style>
</head>

<body>
    <?php 
    require("db.php");
    session_start();

    echo "<p id='welcome'>Welcome, " . $_SESSION['username'] . " <p>";
    echo "<div id='top'>";
    echo "<span><a href='viewcart.php'>View Cart</a></span> ";
    echo " <span><a href='profile.php'>User Profile</a></span>" . "<br>";
    echo "</div>";
    $query= "SELECT * FROM `inventory`";
    $result= mysqli_query($con,$query) or die(mysql_error());
    while($row=mysqli_fetch_assoc($result)){
        echo "<img src='img/" . $row['car_id'] . ".png'> ";
        echo "<div id='carinfo'>";
        echo $row['car_name'] . " " . $row['car_make'];
        echo "<br>";
        echo $row['car_type'];
        echo "<br>";
        echo "$" . $row['price'];
        echo "<br>";
        ?>
        <form action="viewcart.php" method="post">
        <input type="hidden" name="submit_id" value= "<?php echo $row['car_id']?>">
        <input type='submit' id="submit" name="<?php echo $row['car_id']?>"  value='Add to Cart'>
        </form>
        <?php
        echo "</div>";
        echo "<hr>";
    }

    ?>

    <div id="filter">
        <h4>Filter Results</h4>
        <form action="inventory.php">
        <p>Car Brand</p>
        <select name="brand">
            <option>--Select--</option>
            <option value="Toyota">Toyota</option>
            <option value="Ford">Ford</option>
            <option value="Nissan">Nissan</option>
        </select>
        <p>Car Type</p>
        <select name="type">
            <option>--Select--</option>
            <option value="Compact">Compact</option>
            <option value="Midsize">Midsize</option>
            <option value="SUV">SUV</option>
        </select>
        <p>Price Range</p>
        <select name="price">
            <option>--Select--</option>
            <option value="low">Less than 40$ per day</option>
            <option value="mid">$40-$60 per day</option>
            <option value="high">More than $60 per day</option>
        </select>
        <input type="submit" name="submit" value="Filter">
        </form>
    </div>


</body>
</html>