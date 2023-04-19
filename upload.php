<?php

session_start(); 

include_once("Connections/Connections.php");
$con = Connections();
$id = $_GET['ID'];

$sql = "SELECT * FROM student_list WHERE id = '$id'";  
$students = $con->query($sql) or die ($con->error); 
$row = $students->fetch_assoc();

if(isset($_POST['submit'])){

    $fname = $_POST['firstname']; 
    $lname = $_POST['lastname'];
    $birthday = $_POST['Birthday'];
    $image = $_FILES['Image']['name'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO `student_list`(`First_Name`, `Last_Name`, `Birth_Day`, `Image`, `Gender`) 
    VALUES ('$fname','$lname','$birthday','$image','$gender')";
    
    $con->query($sql) or die ($con->error);

    if($sql)
    {
        move_uploaded_file($_FILES["Image"]["tmp_name"], "php-studentinfo-system/img/".$_FILES["Image"]["name"]);
        $_SESSION['status'] = "Image Stored Successfully";
        header("Location: details.php?ID=".$id);
    }
    
    else
    {
        $_SESSION['status'] = "Image not inserted!";
        header("Location: details.php?ID=".$id);;
    }
    // echo header("Location: details.php?ID=".$id);
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Information System</title> 
    <link rel="icon" href="img/studenticon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">


</head>
<body>
    <form action="" method="post">
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <form class="" action=""method="post" autocomplete ="off" enctype ="multiform/form-data">

    <form class="my-form">
        <div class="form-group">
            <label><strong>First Name</strong></label>
            <input type="text" name="firstname" id="firstname" value="<?php echo $row['First_Name'];?>">
        </div>

        <div class="form-group">
            <label><strong>Last Name</strong></label>
            <input type="text" name="lastname" id="lastname" value="<?php echo $row['Last_Name'];?>">
        </div>

        <div class="form-group">
            <label><strong>Birthday</strong></label>
            <input type="Date" name="Birthday" id="birthday">
        <div>

        <label><strong>Image</strong></label>
        <input type="File" name="Image" id="Image"  accept=".jpg, .jpeg, .png" value=""> 
    </div>
    </div>  
        <div class="form-group">  
          <label><strong>Gender</strong></label>
            <select name="gender" name="gender">
            <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected' : '';?>
            >Male</option>
            <option value="Female"<?php echo ($row['gender'] == "Female")? 'selected' : '';?>
            >Female</option>
        </div>
    <div>
        <input type="submit" name="submit" value="submit form" class="btn">
    </div>
    </form>
    </form>
</body>
</html>
