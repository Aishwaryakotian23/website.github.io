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
        
        <div class="center-align">
            <div class="welcome">
                <p>YOUR WISHLIST</p>
            </div>
            <a href="product1.php">PRODUCTS</a>
        </div>
    </header>
    <div class="product-container">
        <?php
        if (isset($_SESSION['wishlist']) && !empty($_SESSION['wishlist'])) {
            // Loop through cart items
            foreach ($_SESSION['wishlist'] as $index => $item) {
                echo '<div class="product-card">';
                if (isset($item['image'])) {
                    echo '<img src="image/' . $item['image'] . '" alt="' . $item['name'] . '">';
                } else {
                    echo '<p>No image found</p>'; // Error handling if 'image' key is missing
                }
                echo '<h2>' . $item['name'] . '</h2>';
                echo '<p>Rs' . $item['price'] . '</p>';
                echo '<div class="buttons">';
               echo '<form id="removeFromWishlistForm_' . $index . '" method="post" onsubmit="removeFromWishlist(event, ' . $index . ')">';
        echo '<button type="submit" class="remove-from-wishlist">Remove from Wishlist</button>';
        echo '</form>';
        echo '<a href="order_summary.php?product_name=' . $item['name'] . '" class="buy-now">Buy</a>';
                echo '</div></div>';
            }
        } else {
            echo '<p>Your wishlist is empty.</p>';
        }
        ?>
    </div>
    <script>
function removeFromWishlist(event, index) {
    event.preventDefault(); // Prevent default form submission

    // Fetch API to send POST request to remove_from_wishlist.php
    fetch('remove_from_wishlist.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'index=' + index,
    })
    .then(response => {
        if (response.ok) {
            // Remove the product card from the DOM upon successful removal
            document.querySelector('.product-card:nth-child(' + (index + 1) + ')').remove();
        } else {
            console.error('Failed to remove item from wishlist');
        }
    })
    .catch(error => console.error('Error removing item from wishlist:', error));
}
</script>
</body>
</html>