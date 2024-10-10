<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "dhanya";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed:" . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $sec_code=$_POST['sec_code'];

    // Check if username or email already exists
    $check_query = "SELECT * FROM logins WHERE username='$username' OR email='$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo "<script>
                alert('Username or Email already exists');
                window.location.href='register.php';
                </script>";
    } else {
        // Validate phone number length
        if (strlen($phone) != 10 || !is_numeric($phone)) {
            echo "<script>
            alert('Phone number should contain exactly 10 digits');
            window.location.href='register.php';
            </script>";
        } else if ($pass != $cpass) {
            echo "<script>
            alert('Password does not match');
            window.location.href='register.php';
            </script>";
        } else {
            $sql = "INSERT INTO logins(username, email, phone, pass, cpass,sec_code) VALUES('$username', '$email', '$phone', '$pass', '$cpass','$sec_code')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                alert('Registration Successful');
                window.location.href='home.php';
                </script>";
            } else {
                echo "<script>
                alert('Invalid credentials');
                window.location.href='register.php';
                </script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIGNUP</title>
    <meta charset="UTF_8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">      

</head>
<body>
    <div class="main">
        <h2 class="logo">IKSHAK JEWELLERS</h2>       

        
        <form method="post" action="">
            <h2>SIGNUP HERE</h2>

            <input type="text" placeholder="Enter your name" name="username" pattern="^[A-Za-z\s]+$" required/>
            <input type="email" placeholder="Enter email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required/>
            <input type="text" id="phone" name="phone" placeholder="Enter 10-digit phone number" required>
            <input type="password" placeholder="Enter Password" name="pass" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-<>]).{8,}" title="Password must be at least 8 characters long and contain at least one uppercase letter,one lowercase letter,one number, and one special character" required/>
            <input type="password" id="cpass" name="cpass" placeholder="Confirm Password" required>
            <input type="text" placeholder="Enter security code" name="sec_code" required/>
            <input type="submit" class="btnn" value="SIGNUP">

            <p class="link">Already have an account?<br>
                <a href="login.php">Login</a> here!</a></p>
            <div class="footer">
                <small><a href="home.php">SKIP</a></small>
            </div>            
        </form>
    </div>
</body>
</html>
