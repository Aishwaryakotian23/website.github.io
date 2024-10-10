<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dhanya";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cart details
$sql = "SELECT product_id, product_name, description, quantity, price, image FROM cart";
$result = $conn->query($sql);

$cartItems = [];
$totalPrice = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $row['total'] = $row['quantity'] * $row['price'];
        $totalPrice += $row['total'];
        $cartItems[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Summary</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .btn-group {
            margin-top: 20px;
        }
        .btn-group button {
            padding: 10px 20px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Summary</h1>
        <table>
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product ID</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><img src="<?php echo $item['image']; ?>" alt="<?php echo $item['product_name']; ?>" width="100"></td>
                    <td><?php echo $item['product_name']; ?></td>
                    <td><?php echo $item['product_id']; ?></td>
                    <td><?php echo $item['description']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['total']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Total Price: <?php echo $totalPrice; ?></h2>

        <h2>Customer Details</h2>
        <form action="process_order.php" method="post">
            <div class="form-group">
                <label for="customer_name">Customer Name:</label>
                <input type="text" id="customer_name" name="customer_name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" required>
            </div>
            <div class="form-group">
                <label for="pincode">Pincode:</label>
                <input type="text" id="pincode" name="pincode" required>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="online">Online</option>
                    <option value="cod">Cash on Delivery</option>
                    <option value="debit">Debit Card</option>
                    <option value="credit">Credit Card</option>
                </select>
            </div>
            <div class="btn-group">
                <button type="submit" name="action" value="make_payment">Make Payment</button>
                <button type="submit" name="action" value="cancel_order">Cancel Order</button>
            </div>
        </form>
    </div>
</body>
</html>
