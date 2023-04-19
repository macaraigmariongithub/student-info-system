<?php

include_once("Connections/Connections.php");
$con = Connections();
$id = $_GET['ID'];

if(isset($_POST['submit'])){

    $fname = $_POST['firstname']; 
    $lname = $_POST['lastname'];
    $birthday = $_POST['Birthday'];
    $image = $_FILES['Image']['name'];
    $image_tmp_name = $_FILES['Image']['tmp_name'];
    $image_folder = 'img/'.$image;
    $gender = $_POST['gender'];

    // echo header("Location: details.php?ID=".$id);

    if(empty($fname) || empty($lname) || empty($birthday) || empty($image) || empty($gender)){
        $message[] = 'please fill out all';

    }else{
        $sql =  "UPDATE `student_list` SET `First_Name`='$fname',`Last_Name`=
        '$lname',`Birth_Day`='$birthday',`Image`='$image',`Gender`='$gender' WHERE id ='$id'";

        $con->query($sql) or die ($con->error);

        if($sql){
           move_uploaded_file($image_tmp_name, $image_folder);
           echo header('Location: index.php');
           $message[] = 'edit student successfully';
        }else{
           $message[] = 'could not fill out all';
        }
     }
};


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

    <?php
        if(isset($message)){
            foreach($message as $message){
                echo '<span class="message">'.$message.'</span>';
            }
        }
    ?>

    <div class="add-container">

    <?php
        $sql = "SELECT * FROM student_list WHERE id = '$id'";  
        $students = $con->query($sql) or die ($con->error); 
        while($row = $students->fetch_assoc()){; // built in sa php
    ?>  

        <h1>edit student here</h1>
        <div class="add-box">
            <form action="" method="post" enctype="multipart/form-data" class="my-form">
                <div class="form-group">
                    <label><strong>First Name</strong></label>
                    <input type="text" name="firstname" id="firstname"  class="field" placeholder="First Name" required value="<?php echo $row['First_Name'];?>">
                </div>

                <div class="form-group">
                    <label><strong>Last Name</strong></label>
                    <input type="text" name="lastname" id="lastname"  class="field" placeholder="Last Name" required value="<?php echo $row['Last_Name'];?>">
                </div>

                <div class="form-group">
                    <label><strong>Birthday</strong></label>
                    <input type="Date" name="Birthday" id="birthday"  class="field" placeholder="First Name" required>
                </div>

                <div class="form-group">
                    <label><strong>Image</strong></label>
                    <input type="File" name="Image" id="Image"  accept="image/png, image/jpeg, image/jpg" value="" class="field" placeholder="Image" required> 
                </div>

                <div class="form-group">  
                    <label><strong>Gender</strong></label>
                    <select name="gender" name="gender" class="field" placeholder="Gender" required>
                        <!-- <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected' : '';?>
                        >Male</option> -->
                        <option value="Male">Male</option>
                        <!-- <option value="Female"<?php echo ($row['gender'] == "Female")? 'selected' : '';?>
                        >Female</option> -->
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div>
                    <input type="submit" name="submit" value="Update" class="btn-update">
                </div>
            </form>

            <?php }; ?>
        </div>
    </div>
    </form>
</body>
</html>
  