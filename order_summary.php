<?php

session_start();
include("connection.php");
include("function.php");

// Check if user is logged in
$user_data = check_login($conn);

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dhanya";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$product_name = $_GET['product_name'];


// Check if product_id is set and not empty
if (!isset($_GET['product_name']) || empty($_GET['product_name'])) {
    die("Product Name is required");
}



// Fetch product details
$sql = "SELECT product_id, name, description, category, price, image FROM products WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_name);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'pay_now') {
        
        $name = $_POST['customer_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pin = $_POST['pincode'];
        $payment_method = $_POST['payment_method'];
        $quantity = $_POST['quantity'];
        $total_amount = $quantity * $product['price'];
        $date = date("Y-m-d H:i:s");

        // Insert customer info
        $stmt = $conn->prepare("INSERT INTO customer_info (customer_name, phone, address, city, state, pincode, payment_method, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $name, $phone, $address, $city, $state, $pin, $payment_method, $date);
        $stmt->execute();
        $customer_id = $stmt->insert_id;

        // Insert order info

$query = "
    INSERT INTO orders (
        product_id, product_name, name, phone, address, district, state, pin, payment_method, total_amount, quantity, order_date) VALUES (
        1, '$product_name', '$name', '$phone', '$address', '$city', '$state', '$pin', '$payment_method', $total_amount, $quantity, '$date')";
if (mysqli_query($conn, $query)) {
        echo ("<script language='javascript'>
        window.alert('Order Placed Successfully')
        window.location.href='product1.php'
        </script>");
        $stmt->close();
        $conn->close();
        exit;
    }
 } elseif ($_POST['action'] == 'cancel_order') {
        echo("<script language='javascript'>
        window.alert('Order Canceled')
        window.location.href='product1.php'
        </script>");
        exit();   
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy Now</title>
    <style>
        body {
            background-color: #333;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #444;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            color: #ff7220;
        }
        .product-details, .customer-details {
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            background-color: #555;
            color: #fff;
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            background-color: #666;
        }
        .btn-group {
            margin-top: 20px;
            text-align: center;
        }
        .btn-group button {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 4px;
            background-color: #ff7220;
            color: #fff;
            cursor: pointer;
        }
        .btn-group button:hover {
            background-color: #ff9500;
        }
        .total-amount {
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 20px;
            text-align: center;
        }
    </style>
    <script>
        function calculateTotal() {
            const price = <?php echo $product['price']; ?>;
            const quantity = document.getElementById('quantity').value;
            const totalAmount = price * quantity;
            document.getElementById('totalAmount').innerText = 'Total Amount: ' + totalAmount;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Product Details</h1>
        <div class="product-details">
            <p><strong>Product Name:</strong> <?php echo $product['name']; ?></p>
            <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
            <p><strong>Category:</strong> <?php echo $product['category']; ?></p>
            <p><strong>Price:</strong> <?php echo $product['price']; ?></p>
            <!-- <p><strong>Image:</strong><br><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="200"></p> -->
        </div>

        <h1>Customer Details</h1>
        <form action="" method="post" oninput="calculateTotal()">
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
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" required>
            </div>
            <div id="totalAmount" class="total-amount">Total Amount: <?php echo $product['price']; ?></div>
            <div class="btn-group">
                <button type="submit" name="action" value="pay_now">Pay Now</button>
                <button type="submit" name="action" value="cancel_order">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
