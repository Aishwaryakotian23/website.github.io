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
$email=$_POST['email'];
$pass=$_POST['pass'];

if(!$_POST['email']|!$_POST['pass'])
{
    echo("<script language='javascript'>
    window.alert('You did not completed all the required fields')
    window.location.href='dhanya.php'
    </script>");
    exit();
}
$sql = "SELECT * FROM admin WHERE email='$email' AND pass='$pass'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
    $_SESSION['log']="yes";
    $_SESSION['email']=$email;
    $_SESSION['pass']=$pass;
    echo("<script language='javascript'>
    window.alert('logged in successfully')
    window.location.href='admin.php'
    </script>");
    exit();
}
else{
    echo("<script language='javascript'>
    window.alert('Wrong email or password')
    window.location.href='adminlogin.php'
    </script>");
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="adminloginn.css">
    <meta charset="UTF-80">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="C:\wamp64\www\aish\project\jewellery\bootstrap.css">
</head>
<body>
    <div class="main">
        <div class="navbar">
            <div class="icon">
            <h2 class="logo">IKSHAK</h2>
            </div>
             
        </div>
        <div class="content">
            <h1><span>IKSHAK JEWELLERS</span></h1>
            <h2>SILVERS</h2>
            
            <p class="par">Our jewellery is made by the finest artists and carefully <br>
                selected to reflect your style and personality</p>
                
            <form method="post" action="">
                <h2>LOGIN HERE</h2>
    
                <input type="text" name="email" placeholder="Enter email" required>
                <input type="password" id="pass" name="pass" placeholder="Enter Password" required>
                <input type="submit" class="btnn" value="SUBMIT">
                <p class="forgot"><br>
                    <a href="forgotpassword">Forgot password?</a></p>
                <p class="link">Does not have an account?<br>
                <a href="adminregister.php">Register</a> here!</a></p>
                        
            </form>
        </div>
    </div>
</body>
</html>
