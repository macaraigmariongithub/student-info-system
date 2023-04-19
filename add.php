<?php

include_once("Connections/Connections.php");
$con = Connections();

if(isset($_POST['submit'])){
    $fname = $_POST['firstname']; 
    $lname = $_POST['lastname'];
    $birthday = $_POST['Birthday'];
    $image = $_FILES['Image']['name'];
    $image_tmp_name = $_FILES['Image']['tmp_name'];
    $image_folder = 'img/'.$image;
    $gender = $_POST['gender'];


    if(empty($fname) || empty($lname) || empty($birthday) || empty($image) || empty($gender)){
        $message[] = 'please fill out all';

    }else{
        $sql = "INSERT INTO `student_list`(`First_Name`, `Last_Name`, `Birth_Day`, `Image`, `Gender`) 
                VALUES ('$fname','$lname','$birthday','$image','$gender')";
        $con->query($sql) or die ($con->error);

        if($sql){
           move_uploaded_file($image_tmp_name, $image_folder);
           $message[] = 'new student added successfully';
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

    <button><a href="index.php">Back</a></button>
    <div class="add-container">
        <h1>Add new student here</h1>
        <div class="add-box">

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="my-form">
                <label>
                    <input type="text" name="firstname" id="firstname" class="field" placeholder="First Name" required>
                </label>

                <label>
                    <input type="text" name="lastname" id="lastname" class="field" placeholder="Last Name" required>
                </label>

                <label>
                    <input type="text" name="Birthday" id="birthday" class="field" placeholder="Birthday" required>
                </label>

                <label>
                    <input type="File" name="Image" id="Image"  accept="image/png, image/jpeg, image/jpg" value="" class="field" placeholder="Image" required>
                </label>

                <label>
                    <select name="gender" name="gender" class="field" placeholder="Gender" required>
                </label>

                <option value="Male">Male</option>
                <option value="Female">Female</option>

                <input type="submit" name="submit" value="submit" class="btn-add">
            </form>
        </div>
    </div>
</body>
</html>
