<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="update_product.css">
</head>
<body>
<div class="main">
    <header>
        <h1>IKSHAK JEWELLERS</h1>
    </header>
    <div class="container">
        <form action="" method="post">
            <h2>Update Product Details</h2>
            <label for="product_id_update">Product ID:</label>
            <input type="text" name="product_id" required><br>
            
            <label for="name">New Name:</label>
            <input type="text" id="name" name="name"><br>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select Product category</option>
                <option value="rings">Rings</option>
                <option value="bangle">Bangle</option>
                <option value="anklet">Anklet</option>
                <option value="braclet">Bracelet</option>
                <option value="necklace">Necklace</option>
                <option value="earing">Earring</option>
            </select><br>
            
            <label for="price">New Price:</label>
            <input type="text" id="price" name="price"><br>

            <input type="submit" name="update" value="Update"><br>
            <div class="back-button">
                <a href="admin.php">Back</a>
            </div> 
        </form>
    </div>
</div>
</body>
</html>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dhanya";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST['update'])){

        $product_id = $_POST['product_id']; // Assuming you have a form field for product ID
        $name = $_POST['name']; // Assuming you have a form field for the new product name
        $category = $_POST['category'];
        $price = $_POST['price']; // Assuming you have a form field for the new product price
        
        // Update product in database
        $sql_update = "UPDATE products SET `name` = '$name', category='$category',  `price` = '$price' WHERE product_id = $product_id";
        if ($conn->query($sql_update) === TRUE) {
            echo "<div class='container'><p>Product updated successfully</p></div>";
        } else {
            echo "<div class='container'><p>Error updating product: " . $conn->error . "</p></div>";
       }
    }
?>
