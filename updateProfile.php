<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="updateProfile.css"> <!-- Link to external CSS file -->
    <title>Admin Panel</title>
</head>
<body>
<body>
    <div class="wrapper">
        <div class="left">
             <p class="para">YOU CAN UPDATE YOUR DETAILS HRER!!</p>
            <br><br> 
             <a href="home.php"><button class="btn1">Cancel</button></a> 
        </div> 
        <div class="right">
        <form action=" " method="post">
        <h2>Update User Details</h2>
        
        <input type="text" name="username" placeholder="Enter Name" required><br><br>

        <input type="password" id="pass" name="pass" placeholder="Enter New Password" required><br><br>
        <input type="password" id="cpass" name="cpass" placeholder="Enter Confirm Password" required><br><br>
    
        <input type="submit" class="update" name="update" value="Update">
        </form>
            
        </div>
    </div>

    
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

        if (isset($_POST['update'])) {
            $username = $_POST['username'];
            $pass = $_POST['pass'];
            $cpass = $_POST['cpass'];
            
            // Validate that passwords match
            if ($pass !== $cpass) {
                echo("<script language='javascript'>
                window.alert('Passwords do not match.')
                window.location.href='profile.php'
                </script>");
                exit();
            }
            
            // Update user in the database
            $sql_update = "UPDATE logins SET pass='$pass', cpass='$cpass' WHERE username='$username'";
            
            if ($conn->query($sql_update) === TRUE) {
                echo("<script language='javascript'>
                window.alert('User updated successfully.')
                window.location.href='profile.php'
                </script>");
                exit();

            } else {
                echo "Error updating user: " . $conn->error;
            }
        }

        $conn->close();
    ?>
</body>
</html>
