<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "dhanya";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if (empty($email) || empty($pass)) {
        echo "<script language='javascript'>
        window.alert('You did not complete all the required fields')
        window.location.href='login.php'
        </script>";
        exit();
    }

    $sql = "SELECT * FROM logins WHERE email=? AND pass=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['log'] = "yes";
        $_SESSION['email'] = $email;
        echo "<script language='javascript'>
        window.alert('Logged in successfully')
        window.location.href='home.php'
        </script>";
        exit();
    } else {
        echo "<script language='javascript'>
        window.alert('Wrong email or password')
        window.location.href='login.php'
        </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>LOGIN</title>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="stylesheet" href="login.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="main">
        <h2 class="logo">IKSHAK</h2>
        <h1><span>IKSHAK JEWELLERS</span></h1>
        <h2 class="silver">SILVERS</h2>
        <p class="par">Our jewellery is made by the finest artists and carefully <br>selected to reflect your style and personality.</p>

        <form method="post" action="">
            <h2>LOGIN HERE</h2>
            <input type="text" name="email" placeholder="Enter email" required>
            <input type="password" id="pass" name="pass" placeholder="Enter Password" required>
            <input type="submit" class="btnn" value="SUBMIT">
            <p class="forgot"><br>
                <a href="forgotpassword.php">Forgot password?</a>
            </p>
            <p class="link">Don't have an account?<br>
                <a href="register.php">Sign up</a> here!
            </p>
            <div class="footer">
                <small><a href="home.php">SKIP</a></small>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
