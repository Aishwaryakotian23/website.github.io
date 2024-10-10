<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dhanya";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all product data from the database, including out of stock products
$sql = "SELECT * FROM products where category='earing'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Cards</title>
  <link rel="stylesheet" href="style/pstyle.css">
  
  <style>
    body {
    line-height: 24px;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    visibility: visible;
    color: #fff;
    background-color: #333;
}

header {
    height: 100px;
    background-color: #040a1c;
    padding: 20px;
    color: #ff7200;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.welcome a {
    margin: 10px;
    position: absolute;
    left: 20px;
    font-size: 20px;
    color: #ff7220;
    text-decoration: none;
    padding-top: 90px;
}


.wishlist_btn1,
.cart_btn1 {
    background-color: #333;
    color: #ffffff;
    padding: 5px 10px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 10px; /* Increased border-radius for a smoother appearance */
    transition: background-color 0.3s, color 0.3s;
    display: inline-block; /* Ensure it's inline-block for proper spacing */
}

.wishlist_btn1 {
    margin-right: 10px; /* Add margin to create space after the wishlist button */
}

.wishlist_btn1 a,
.cart_btn1 a {
    width: auto; /* Adjust to fit the content */
    height: auto; /* Adjust to fit the content */
    border-radius: 10px; /* Match the button's border-radius */
    text-align: center;
    line-height: normal; /* Adjust line height to normal */
    font-size: 16px; /* Reduced font size to match the button */
    display: block;
    text-decoration: none;
    color: #ffffff;
    padding: 5px 10px; /* Added padding to match the button */
    transition: color 0.3s, border-color 0.3s;
}

.wishlist_btn1 a:hover,
.cart_btn1 a:hover {
    color: #ff7200;
    border-color: #ff7200;
}

.dropdown {
    position: relative;
    display: inline-block;
    margin-right: 30px;
}

.dropdown .dropbtn {
    background-color: #333;
    color: #ffffff;
    margin-left: 70px;
    padding: 10px 35px;
    font-size: 15px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.dropdown .dropbtn:hover {
    color: #ff7200;
}

.dropdown-content {
    display: none;
    position: absolute;
    background:rgba(149, 136, 136, 0.7);;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    margin-left: 70px;
    border-radius: 5px;
    overflow: hidden;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    transition: background-color 0.3s, color 0.3s;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
    color: #333;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.welcome {
    text-align: center;
    margin: 0;
    font-size: 60px;
    flex-grow: 1;
}

.center-align {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
}

.buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}

.buttons form {
    display: inline;
}

.buttons button {
    margin: 0 5px;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s, color 0.3s;
}

.buttons .wishlist-btn {
    background-color: #00ff00;
    color: #333;
}

.buttons .wishlist-btn:hover {
    background-color: #00cc00;
    color: #fff;
}

.buttons .buy-now {
    background-color: #FF8C00;
    color: #fff;
}

.buttons .buy-now:hover {
    background-color: #e07b00;
}

.buttons .add-to-cart {
    background-color: #008CBA;
    color: #fff;
}

.buttons .add-to-cart:hover {
    background-color: #007bb5;
}

.buttons .remove-from-wishlist {
    background-color: #ff0000;
    color: #fff;
}

.buttons .remove-from-wishlist:hover {
    background-color: #cc0000;
}
  </style>
</head>
<body>
    <header>
        <div class="dropdown">
            <button class="dropbtn"><b>&#9776;Categories</b></button>
            <div class="dropdown-content">
                <!-- <a href="home.php">HOME</a> -->
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
                <a href="home.php">Home</a>
                <p>EARINGS</p>
            </div>
        </div>
        <div class="wishlist_btn1">
                            <a href="wishlist.php">WISHLIST</i></a>
                        </div>
        <div class="wishlist_btn1">
                            <a href="cart.php">CART</i></a>
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
                        echo '<button type="button" class="add-to-cart" onclick="addToCart(this.form)">Add to Cart</button>';
                        echo '</form>';
                        echo '<form class="add-to-cart-form" method="post">';
                        echo '<input type="hidden" name="product_name" value="' . $row["name"] . '">';
                        echo '<input type="hidden" name="product_price" value="' . $row["price"] . '">';
                        echo '<input type="hidden" name="product_image" value="' . $row["image"] . '">';
                        echo '<button type="button" class="wishlist-btn" onclick="addtowish(this.form)">&#x2665; Add to Wishlist</button>';
                         echo '</form>';
                        echo '<button class="buy-now">Buy Now</button>';
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
