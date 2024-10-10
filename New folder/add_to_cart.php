<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dhanya";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $product_price = $conn->real_escape_string($_POST['product_price']);
    $product_image = $conn->real_escape_string($_POST['product_image']);
    $product_description = $conn->real_escape_string($_POST['product_description']);
    $product_category = $conn->real_escape_string($_POST['product_category']);
    $product_quantity = 1; // Default quantity to 1

    $sql = "INSERT INTO cart (name, image, description, category, price, quantity) VALUES ('$product_name', '$product_image', '$product_description', '$product_category', '$product_price', '$product_quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added to cart successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>
