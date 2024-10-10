<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dhanya";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all product data from the database, including out of stock products
$sql = "SELECT * FROM products where category='anklet'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Cards</title>
  <link rel="stylesheet" href="productt.css">
<style>
.product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .product-card {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
            width: 35%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .product-card img {
            max-width: 100%;
            height: auto;
        } 
        .buttons {
            margin: 0 5px;
            padding: 10px 15px;
            color: white;
            border: none;
            cursor: pointer;
        }
        .buttons button {
            margin: 0 5px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .buttons button {
            margin: 0 5px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .buttons .wishlist-btn {
            padding: 10px 20px;
            background-color: #FF6347;
        }
        .buttons .buy-now {
            padding: 10px 20px;
            background-color: #4CAF50;
            text-decoration: none;
        }
        .buttons .remove-from-wishlist {
            padding: 10px 20px;
            background-color:#FF6347;
        }
</style>
</head>
<body>
    <header>
      <div class="dropdown">
            <button class="dropbtn"><b>&#9776;Categories</b></button>
            <div class="dropdown-content">
                <a href="home.php">HOME</a>
                <a href="product1.php">All collection</a>
                <a href="catring.php">Rings</a>
                <a href="catban.php">Bangels</a>
                <a href="catank.php">Anklets</a>
                <a href="catbrac.php">Braclets</a>
                <a href="catneck.php">Necklaces</a>
                <a href="catear.php">Earings</a>
            </div>
        </div>


        <div class="center-align">
            <div class="welcome">
                <p>ANKKLETS</p>
            </div>
            <a href="product1.php">PRODUCTS</a>
        </div>
        
    </header>
  <div class="content">
        <div class="product-container">
            <?php
                if ($result->num_rows > 0) {
                    $products_per_row = 3;
                    $count = 0;

                    while ($row = $result->fetch_assoc()) {
                        if ($count % $products_per_row === 0) {
                            echo '<div class="product-row">';
                        }
                        echo '<div class="product-card">';
                        echo '<img src="image/' . $row["image"] . '" alt="' . $row["name"] . '">';
                        echo '<h2>' . $row["name"] . '</h2>';
                        echo '<p>' . $row["description"] . '</p>';
                        echo '<p>Rs' . $row["price"] . '</p>';
                        echo '<p>Category: ' . $row["category"] . '</p>';
                        echo '<p>Status: ' . $row["stock_status"] . '</p>';
                        echo '<div class="buttons">';
                        echo '<form class="add-to-cart-form" method="post">';
                        echo '<input type="hidden" name="product_name" value="' . $row["name"] . '">';
                        echo '<input type="hidden" name="product_price" value="' . $row["price"] . '">';
                        echo '<input type="hidden" name="product_image" value="' . $row["image"] . '">'; // Add product image
                        echo '<button type="button" class="add-to-cart" onclick="addToCart(this.form)">Cart</button>';
                        echo '</form>';
                        echo '<form class="add-to-cart-form" method="post">';
                        echo '<input type="hidden" name="product_name" value="' . $row["name"] . '">';
                        echo '<input type="hidden" name="product_price" value="' . $row["price"] . '">';
                        echo '<input type="hidden" name="product_image" value="' . $row["image"] . '">';
                        echo '<button type="button" class="wishlist-btn" onclick="addtowish(this.form)">&#x2665;Wishlist</button>';
                         echo '</form>';
                         echo '</form>';
                             echo '<form action="order_summary.php" method="post">';
                             echo '<a href="order_summary.php?product_name=' .$row['name'] . '" class="buy-now">Buy</a>';
                         echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        $count++;
                        if ($count % $products_per_row === 0) {
                            echo '</div>';
                        }
                    }
                    if ($count % $products_per_row !== 0) {
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
            ?>
        </div>
    </div>
    <script>
         function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        function addToCart(form) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var formData = new FormData(form);
            var params = new URLSearchParams(formData).toString();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert("Item added to cart!");
                    } else {
                        alert("Failed to add item to cart. Please try again.");
                    }
                }
            }
            xhr.send(params);
        }
        function addtowish(form) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_wishlist.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var formData = new FormData(form);
            var params = new URLSearchParams(formData).toString();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert("Item added to wishlist!");
                    } else {
                        alert("Failed to add item to wishlist. Please try again.");
                    }
                }
            }
            xhr.send(params);
        }
    </script>

</body>
</html>
