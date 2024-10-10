<?php
session_start();
include("connection.php");
include("function.php");

// Check if user is logged in
$user_data = check_login($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
        .buttons .wishlist-btn {
            padding: 10px 20px;
            background-color: #FF6347;
        }
        .buttons .buy-now {
            padding: 10px 20px;
            background-color: #008CBA;
            color: white;
            text-decoration: none;
        }
        .buttons .remove-from-cart {
            padding: 10px 20px;
            background-color:#FF6347;
        }
    </style>
</head>
<body>
    <header>
    <div class="center-align">
            <div class="welcome">
                <p>CART</p>
            </div>
            <a href="product1.php">PRODUCTS</a>
        </div>
    </header>
    <div class="product-container">
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $index => $item) {
                echo '<div class="product-card">';
                echo '<img src="image/' . $item['image'] . '" alt="' . $item['name'] . '">';
                echo '<h2>' . $item['name'] . '</h2>';
                echo '<p>Rs' . $item['price'] . '</p>';
                echo '<div class="buttons">';
                echo '<a href="order_summary.php?product_name=' . $item['name'] . '" class="buy-now">Buy</a>';
                echo '<form method="post" action="remove_from_cart.php">';
                echo '<input type="hidden" name="index" value="' . $index . '">';
                echo '<button type="submit" class="remove-from-cart">Remove From Cart</button>';
                echo '</form>';
                echo '</div></div>';
            }
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>
    </div>
</body>
</html>
