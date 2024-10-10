<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIGNUP</title>
    <link rel="stylesheet" href="adminregisterr.css">
    <meta charset="UTF-80">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="C:\wamp64\www\aish\project\jewellery\bootstrap.css">
</head>
<body>
    <div class="main">
        <h2 class="logo">IKSHAK</h2>       

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
                <a href="adminlogin.php">login</a> here!</a></p>
                       
        </form>
    </div>

<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$database="dhanya";
$conn=new mysqli($servername,$username,$password,$database);

if($conn->connect_error)
{
    die("Connection Failed:".$conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"]=="POST")
 {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $sec_code=$_POST['sec_code'];
    if($pass == $cpass)
    { 
        $sql="INSERT INTO admin(username,email,phone,pass,cpass,sec_code) VALUES('$username','$email','$phone','$pass','$cpass','$sec_code')";
        if($conn->query($sql)===TRUE)
        {
            echo "<script>
            alert('Registration Successfull');
            window.location.href='admin.php';
            </script>";
        }
        else
        {
            echo "<script>
            alert('Invalid credentials');
            window.location.href='adminregister.php';
            </script>";
        }
    }
    else{
        echo "<script>
        alert('Password does not match');
        window.location.href='adminregister.php';
        </script>";
    }
   // if($phonenumber>10){
    //    echo"<script>
    //  alert('Phonenumber should contain only 10 digits');
      //  </script>";
    //}


}
    
?>
</body>
</html>