<?php

include_once("Connections/Connections.php");
$con = Connections();
$id = $_GET['ID'];

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['Access']) && $_SESSION['Access'] =="admin"){
        // echo "Welcome" .$_SESSION['UserLogin']."<br/><br/>";
        ?>    
        <span class="UserLogin"> Welcome, <?= $_SESSION['UserLogin'] ?></span>
        <?php

    }else{
        echo header ("Location: index.php");
    }


    $sql = "SELECT * FROM student_list WHERE id = '$id'";  
    $students = $con->query($sql) or die ($con->error); 
    $row = $students->fetch_assoc();

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

    <button><a href="index.php">Back</a></button>
    <div class="login-container">
        <div class="add-box">
            <form action="delete.php" method ="post" class="details-form">
                <button><a href="edit.php?ID=<?php echo $row['id'];?>">edit</a></button>
        
                <button type ="Submit" name="delete">Delete Student</button>
                <input type ="hidden" name ="ID" value="<?php echo $row['id'];?>">
            </form>

            <table>
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birth Day</th>
                    <th>Added At</th>
                    <th>Image</th>
                    <th>Gender</th>
                </tr>
                </thead>
                <tbody>
            <tr>
                <td><?php echo $row['First_Name'];?></td>
                <td><?php echo $row['Last_Name'];?></td>
                <td><?php echo $row['Birth_Day'];?></td>
                <td><?php echo $row['Added_at'];?></td> 
                <td><img src="img/<?php echo $row['Image']; ?>" height="100" alt=""></td> 
                <td><?php echo $row['Gender'];?></td>
            </tr>
                </tbody>
            </table>

        </div>
    </div>
</body>
</html>

