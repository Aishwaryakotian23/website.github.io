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
$sql_purchases = "SELECT * FROM feedback";
$result_purchases = $conn->query($sql_purchases);

echo "<div class='container'>";
echo "<h2>Customer Feedback</h2>";
echo "<table>";
echo "<tr><th>Name</th><th>Email</th><th>Message</th><th>Rating</th></tr>";
while($row_feedback = $result_purchases->fetch_assoc()) {
    echo "<tr><td>".$row_feedback['name']."</td><td>".$row_feedback['email']."</td><td>".$row_feedback['message']."</td><td>".$row_feedback['rating']."</td></tr>";
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
    <title>Customer Feedback</title>
    <link rel="stylesheet" href="feedback.css">
    <style>
        .back-button {
    text-align: center;
    margin-top: 10px;
    padding-top: 10px;
    padding-right:200px;
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
