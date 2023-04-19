<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("Connections/Connections.php");
$con = Connections();
  
if(isset($_POST['login'])){
    // echo"login";
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM student_users WHERE username ='$username' AND password = '$password'";
    $user = $con->query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;


    if($total > 0){
        $_SESSION['UserLogin'] = $row['username'];
        $_SESSION['Access'] = $row['access'];
        echo header("Location: index.php");
    }else{
        // echo "No user found.";

        echo "<p class='mycss'>No user found.</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Information System</title> 
    <link rel="icon" href="https://res.cloudinary.com/dlmhhmfb7/image/upload/v1681537256/marion_christian_macaraig_5_mpicrj.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">


</head>
<body>
    <div class="login-container">
        <h1>Welcome to Login Page</h1>
        <div class="contact-box">
            <div class="left">
                <h5 class="address">Marion Christian State University</h5>
            </div>
            <div class="right">
                <form action="" method="post">
                    <label for="Username">
                        <input type="text" class="field" placeholder="Username" name="Username" id="Username" required>
                    </label>
                    <label for="Password">
                        <input type="text" class="field" placeholder="Password" name="Password" id="Password" required>
                    </label>
                    <button type="submit" name="login" class="btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>