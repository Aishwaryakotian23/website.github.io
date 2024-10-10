<html>
    <head>
<style>
        body{
            font-family:Arial,sans-serif;
            background: linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%), url(images/backgrounds/img14.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-position: center; /* Adjust to focus on a specific area */
            margin:0;
            padding:0;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        form{
            width: 500px;
            height:400px;
            background-color:#6c6b6bcc;
            padding:20px;
            border-radius:8px;
            box-shadow:0 2px 4px rgba(0,0,0,0.1);
            border:1px solid #ccc;
        }
        
        input[type="password"],
        input[type="email"]{
            width:100%;
            padding:10px;
            margin-bottom:10px;
            border:1px solid #ccc;
            border-radius:4px;
            box-sizing:border-box;
            margin-top:10px;
        }
        
        button[type="submit"]{
            width:100%;
            padding:10px;
            border:none;
            border-radius:4px;
            background-color:#007bff;
            color:#fff;
            cursor:pointer;
            margin-bottom:10px;
            margin-top:15px;
        }

        button[type="submit"]:hover{
            background-color:#0056b3;
        }


        </style>
        </head>
        <body>
    
    <form method="post" action="" id="yourForm">
    <h2 style="text-align:center;">Reset Password</h2>
    <label>Email</label>
    <input type="email" placeholder="Enter email" name="email" required/>
        <label>New Password</label>
        <input type="password" placeholder="Enter NEWPassword" name="new_password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-<>]).{8,}" title="Password must be at least 8 characters long and contain at least one uppercase letter,one lowercase letter,one number, and one special character" required/>
        <label>Confirm Password</label>
        <input type="password" placeholder="Confirm Password" name="confirm_password" required/>
        <div id="errorMessageContainer"></div>
        <button type="submit" name="reset_pass">Submit</button>
        <a style="text-decoration:none;color:white;" href="index.php">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Back to Login Page</a>
    </form>

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

if(isset($_POST['reset_pass'])){
    $new_password=$_POST['new_password'];
    $confirm_password=$_POST['confirm_password'];
    $email=$_POST['email'];
    
    // Check if new password and confirm password match
    if($new_password != $confirm_password){
        echo("<script language='javascript'>
        var errorMessage=document.createElement('div');
        errorMessage.innerHTML='New password and confirm password do not match.';
        errorMessage.style.color='red';
        document.getElementById('errorMessageContainer').appendChild(errorMessage);
        </script>");
        exit();
    }
    // Encrypt the password (You should use a better encryption method)
    $encrypted_password = $new_password;
    // Update user's password in the database
    $update_sql = "UPDATE logins SET pass='".$encrypted_password."' WHERE email='".$email."'";
    mysqli_query($conn, $update_sql);
    // Redirect to a page indicating successful password reset
    echo("<script language='javascript'>
    window.alert('Password reset successful.')
    window.location.href='home.php'
    </script> ");
    exit();
}
?>

    </body>
</html>