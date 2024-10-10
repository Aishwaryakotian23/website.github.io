<html>
    <head>
        <style>
        body{
            font-family:Arial,sans-serif;
            background:url(images/backgrounds/img9.jpg);
            background-position:center;
            background-size:cover;
            margin:0;
            padding:0;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        form{
            background:rgba(120, 126, 136, 0.7);
            padding:20px;
            border-radius:8px;
            box-shadow:0 2px 4px rgba(0,0,0,0.1);
            border:1px solid #ccc;
        }

        form h2 {
            font-family: 'Times New Roman';
            padding-top: 20px;
            color: #ff7200;
            padding-left: 35px;
            margin-top: 0%;
            letter-spacing: 2px;
        }
        
        input[type="email"],
        input[type="text"]{
            width:100%;
            padding:10px;
            margin-bottom:10px;
            border:1px solid #ccc;
            border-radius:4px;
            box-sizing:border-box;
        }
        
        button[type="submit"]{
            width:100%;
            padding:10px;
            border:none;
            border-radius:4px;
            background-color:#007bff;
            color:#fff;
            cursor:pointer;
            margin-bottom:5px;
        }

        button[type="submit"]:hover{
            background-color:#0056b3;
        }
        .back-button {
            text-align: center;
            margin-top: 10px;
            padding-top: 10px;
        }

        .back-button a {
            background-color:#007bff;
            color: rgb(255, 255, 255);
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 4px;
        }

        .back-button a:hover {
            background-color: #0056b3;
        }


    </style>
    </head>
    
<body>
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
if(isset($_POST['forgot_submit'])){
    $email=$_POST['email'];
    $sec_code=$_POST['sec_code'];
    
    // Check if user exists and security question answer is correct
    $sql = "SELECT * FROM logins WHERE email='$email' AND sec_code='$sec_code'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if($count == 1){
        // Password reset code here
        // Redirect to password reset page or send password reset link via email
        echo("<script language='javascript'>
        window.alert('User verification successful. Redirecting to password reset page...')
        window.location.href='reset_pass'
        </script> ");
        exit();
    } else {
        echo("<script language='javascript'>
        window.alert('User not found or security answer incorrect. Please try again.')
        window.location.href='forgotpassword'
        </script> ");
        exit();  
    }
}
?>

<!-- HTML form for forgot password -->
<form method="post" action="" >
    <h2 style="text-align:center;">Forgot Password</h2>
    <h5 style="text-align:center;">Enter your security code and reset your password.</h5>
    <input type="email" placeholder="Enter email" name="email" required/>
    <input type="text" name="sec_code" placeholder="Enter your security code" required>
    <button type="submit" name="forgot_submit">Submit</button>
    <div class="back-button">
        <a href="login.php">Back</a>
    </div>
</form>
</html>