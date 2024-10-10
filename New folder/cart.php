<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="pstyle.css">
    <style>
    body {
    color: #ccc;
    background-color: #333;
}
header {
    height: 100px;
    background-color: #040a1c;
    padding: 20px;
    display: flex;
    color: #ff7220;
    justify-content: center; /* Centers the content horizontally */
    align-items: center; /* Centers the content vertically */
}
header a {
    margin: 10px;
    position: absolute;
    left: 20px;
    color: #ff7220;
    text-decoration: none;
    padding-top: 80px;
}
.center-align {
    display: flex;
    align-items: center; /* Vertically centers the items */
    justify-content: center; /* Horizontally centers the items */
    height: 100%; /* Ensure it takes full height of its parent */
    width: 100%; /* Ensure it takes full width of its parent */
}

.welcome {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%; /* Ensure it takes full height of its parent */
    width: 100%; /* Ensure it takes full width of its parent */
}
.welcome p {
    font-size: 60px;
    margin: 0; /* Remove default margin */
}
    
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .product-card {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
            width: 30%;
            color:black;
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
            background-color: #FF8C00;
        }
        .buttons .remove-from-cart {
            padding: 10px 20px;
            background-color: #FF0000;
        }
    </style>
</head>
<body>
    <header>
        
        <div class="center-align">
            <div class="welcome">
                <p>YOUR CART</p>
            </div>
        </div>
    </header>
    <div class="product-container">
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // Loop through cart items
            foreach ($_SESSION['cart'] as $index => $item) {
                echo '<div class="product-card">';
                if (isset($item['image'])) {
                    echo '<img src="image/' . $item['image'] . '" alt="' . $item['name'] . '">';
                } else {
                    echo '<p>No image found</p>'; // Error handling if 'image' key is missing
                }
                echo '<h2>' . $item['name'] . '</h2>';
                echo '<p>Rs' . $item['price'] . '</p>';
                echo '<div class="buttons">';
                echo '<button class="wishlist-btn">&#x2665; Add to Wishlist</button>';
                // echo '<button class="buy-now">Buy Now</button>';
                // Form to remove item based on its index
                echo '<form method="post" action="remove_from_cart.php">';
                echo '<input type="hidden" name="index" value="' . $index . '">';
                echo '<button type="submit">Remove from Cart</button>';
                echo '</form>';
                echo '<form action="order_summary.php" method="post">';
                          echo '<input type="hidden" name="product_id" value="' . $item["product_id"] . '">';
                        echo '<input type="submit" value="Buy Now" class="buy-now"/>';
                           echo '</form>';
                echo '</div></div>';
            }
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>
    </div>
    <a href="product1.php">Back to Products</a>
</body>
</html>