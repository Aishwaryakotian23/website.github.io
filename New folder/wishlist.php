<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WISHLIST</title>
    <link rel="stylesheet" href="pstylee.css">
    <style>
header {
        height: 100px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }A
    .center-align {
        display: flex;
        align-items: center;
    }
    .welcome {
        text-align: center;
        margin: 0;
        font-size: 80px;
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
/* Product Container and Cards */
.product-container {
  background-image: url('background-image.jpg');
  background-size: cover;
  background-position: center;
  padding: 60px 0;
}

.product-row {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.product-card {
  width: calc(50% - 40px);
  max-width: 300px;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 20px;
  margin: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #fff;
  transition: transform 0.2s, box-shadow 0.2s;
}

.product-card img {
  width: 100%;
  height:50%;
  border-radius: 5px;
}

.product-card h2 {
  margin-top: 10px;
  font-size: 22px;
}

.product-card p {
  font-size: 16px;
  color: #666;
}

.product-card p:last-child {
  font-weight: bold;
  color: #333;
}

.product-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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
                <a href="product1.php">Back to Products</a>
                <p>YOUR WISHLIST</p>
            </div>
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
                // echo '<form action="order_summary.php" method="post">';
                // echo '<input type="hidden" name="product_id" value="' . $item["product_id"] . '">';
                //     echo '<input type="submit" value="Buy Now" class="buy-now"/>';
                // echo '</form>';
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