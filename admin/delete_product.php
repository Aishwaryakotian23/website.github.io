<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="delete_product.css">
</head>
<body>
    <header>
        <h1>IKSHAK JEWELLERS</h1>
    </header>
    <div class="container">
        <form method="post" action="">
            <h2>Delete Product</h2>
            <label for="product_id">Enter Product ID:</label>
            <input type="number" id="product_id" name="product_id" required>
            <input type="submit" name="delete" value="Delete">
        </form>
        <div class="back-button">
            <a href="admin.php">Back</a>
        </div>
    </div>
</body>
</html>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dhanya";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete'])) {
    $product_id = $_POST['product_id'];

    // Check if the product exists
    $sql_check = "SELECT * FROM products WHERE product_id = $product_id";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        // Product exists, proceed with deletion
        $sql_delete = "DELETE FROM products WHERE product_id = $product_id";
        if ($conn->query($sql_delete) === TRUE) {
            echo "<script>
            alert('Record Deleted Successfully');
            window.location.href='delete_product.php';
            </script>";
        } else {
            echo "<script>
            alert('Error deleting record: " . $conn->error . "');
            window.location.href='delete_product.php';
            </script>";
        }
    } else {
        // Product does not exist
        echo "<script>
        alert('No such product found');
        window.location.href='delete_product.php';
        </script>";
    }
}

$conn->close();
?>
