<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="total_sale.css">
    <style>
        .back-button {
    text-align: center;
    margin-top: 10px;
    padding-top: 10px;
    padding-right:80px;
}
    </style>
</head>
<body>
    <header>
        <h1>IKSHAK JEWELLERS</h1>
    </header>
    <form method="post" action="" class="container">
        <h1>Total Sales</h1>

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

        $sql_sales = "SELECT COUNT(*) AS total_sales FROM orders";
        $result_sales = $conn->query($sql_sales);
        $row_sales = $result_sales->fetch_assoc();
        $total_sales = $row_sales['total_sales'];

        echo "<h2>Total Sales: ".$total_sales."</h2>";

        $conn->close();
        ?>
    </form>
    <div class="back-button">
        <a href="admin.php">Back</a>
    </div>
</body>
</html>
