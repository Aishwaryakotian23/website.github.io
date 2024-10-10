<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo "Please log in to add items to your cart.";
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "dhanya";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $item = [
        'name' => $product_name,
        'price' => $product_price,
        'image' => $product_image
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $item;

    echo "Item added to cart!";
}
?>
