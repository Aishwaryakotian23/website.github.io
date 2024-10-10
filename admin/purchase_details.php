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
$sql_purchases = "SELECT * FROM orders";
$result_purchases = $conn->query($sql_purchases);

echo "<div class='container'>";
echo "<h2>Purchase Details</h2>";
echo "<table>";
echo "<tr><th>User Name</th><th>Product name</th><th>Quantity</th><th>Price</th></tr>";
while($row_purchases = $result_purchases->fetch_assoc()) {
    echo "<tr><td>".$row_purchases['name']."</td><td>".$row_purchases['product_name']."</td><td>".$row_purchases['quantity']."</td><td>".$row_purchases['total_amount']."</td></tr>";
}
echo "</table>";
echo "</div>";

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Details</title>
    <link rel="stylesheet" href="purchase_details.css">
    <style>
        .back-button {
    text-align: center;
    margin-top: 10px;
    padding-top: 10px;
}
    </style>
</head>
<body>
    <header>
        <h1>IKSHAK JEWELLERS</h1>
    </header>
    <div class="back-button">
        <a href="admin.php">Back</a>
    </div>
</body>
</html>
