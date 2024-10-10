<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image']; // Add this line to get the product image

    $product = [
        
        'name' => $product_name,
        'price' => $product_price,
        'image' => $product_image // Store the product image in the session
    ];

    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'][] = $product;
    } else {
        $_SESSION['cart'] = [$product];
    }

    echo "Product added to cart successfully";
} else {
    echo "Invalid request method";
}
?>
