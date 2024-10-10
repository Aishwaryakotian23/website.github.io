<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="add_product.css">
</head>
<body>
    <div class="main">
        <header>
            <h1>IKSHAK JEWELLERS</h1>
        </header>
        <div class="container">
            <h1>Add Product Details</h1>
            <form method="post" action="">
                <label for="name">Product Name:</label><br>
                <input type="text" id="name" name="name" required><br>

                <label for="category">Category:</label><br>
                <select id="category" name="category" required>
                    <option value="" disabled selected>Select Product category</option>
                    <option value="rings">Rings</option>
                    <option value="bangle">Bangle</option>
                    <option value="anklet">Anklet</option>
                    <option value="braclet">Braclet</option>
                    <option value="necklace">Necklace</option>
                    <option value="earing">Earing</option>
                </select><br>

                Product Status:
                <select id="status" name="status" required >
                    <option value="" disabled selected>Select Product Status</option>
                    <option value="In-Stock">In-Stock</option>
                    <option value="Out of Stock">Out of Stock</option>
                    <option value="Limited Stock">Limited Stock</option>
                    <option value="Pre-order">Pre-order</option>
                    <option value="Discontinued">Discontinued</option>
                </select><br><br>

                <label for="description">Description:</label><br>
                <textarea id="description" rows="5" cols="50" name="description" required></textarea><br>

                <label for="price">Price:</label><br>
                <input type="number" id="price" name="price" required><br>

                <label for="image">Image:</label><br>
                <input type="file" accept="image/*" id="image" name="image" required><br><br>

                <input type="submit" name="submit" value="Submit">
            </form>

            <div class="back-button">
                <a href="admin.php">Back</a>
            </div>   
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

    if(isset($_POST['submit'])){

    // Fetching values from form fields
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $status = $_POST['status'];

    $sql_insert_data = "INSERT INTO products (name, category, description, price, image,stock_status) VALUES
    ('$name','$category','$description','$price','$image','$status')";

    if ($conn->query($sql_insert_data) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data: " . $conn->error;
    }

}
?>
