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
$sql_users = "SELECT * FROM logins";
$result_users = $conn->query($sql_users);

echo "<div class='container'>";
echo "<h2>User Login Details</h2>";
echo "<table>";
echo "<tr><th>UserId</th><th>Username</th><th>Email</th><th>Phone</th><th>Password</th><th>security code</th></tr>";
while($row_users = $result_users->fetch_assoc()) {
    echo "<tr><td>".$row_users['id']."</td><td>".$row_users['username']."</td><td>".$row_users['email']."</td><td>".$row_users['phone']."</td><td>".$row_users['pass']."</td><td>".$row_users['sec_code']."</td></tr>";
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
    <title>User Login Details</title>
    <link rel="stylesheet" href="customer_login_info.css">
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
