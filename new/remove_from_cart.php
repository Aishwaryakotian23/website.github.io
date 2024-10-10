<?php
session_start();

// Check if index is provided via POST
if (isset($_POST['index'])) {
    $index = $_POST['index'];

    // Check if the index exists in the cart array
    if (isset($_SESSION['cart'][$index])) {
        // Remove the item from the cart using unset
        unset($_SESSION['cart'][$index]);

        // Reset array keys to maintain sequential order (optional but recommended)
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Redirect back to cart page or wherever you want after removing
header('Location: cart.php');
exit();
?>