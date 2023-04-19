<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['UserLogin'])){
        // <!-- // echo "Welcome" .$_SESSION['UserLogin']; -->
        ?>    
         <span class="UserLogin"> Welcome, <?= $_SESSION['UserLogin'] ?></span>
        <?php
    }else{
        // echo "Welcome Guest";
        // echo "<p class='mycss'>Welcome Guest.</p>";
    }

    include_once("Connections/Connections.php"); //mag reredirect sa folder na Connection>Connections.php
    $con = Connections();

    $sql = "SELECT * FROM student_list ORDER BY id ASC";  
    $students = $con->query($sql) or die ($con->error); 
    $row = $students->fetch_assoc(); // built in sa php

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

    <div class="box-1">
    <h1>Student Information System</h1> 
    </div>

        <form action="result.php" method="get">
            <input type="text" name="search" id="search" class="input-search">
            <button type="submit" name="query" class="btn-search" required>search</button> 
        </form>

    <?php if(isset($_SESSION['UserLogin'])){?>

            <a href="logout.php"> <button class="logout"> Logout </button></a>

    <?php } else{ ?>

            <a href="login.php" ><button class="login"> login </button></a> <br></br>

    <?php } ?>

            <a href="add.php"><button class="addnew"> add new student</button></a> 

    <table>
        <thead>
        <tr>
            <th></th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birth Day</th>
            <th>Added At</th>
            <th>Image</th>
            <th>Gender</th>
        </tr>
        </thead>
        <tbody>
        <?php do{ ?>
        <tr>
            <td><a href="details.php?ID=<?php echo $row['id'];?>">view</a></td>
            <td><?php echo $row['First_Name'];?></td>
            <td><?php echo $row['Last_Name'];?></td>
            <td><?php echo $row['Birth_Day'];?></td>
            <td><?php echo $row['Added_at'];?></td> 
            <td><img src="img/<?php echo $row['Image']; ?>" height="100" alt=""></td> 
            <td><?php echo $row['Gender'];?></td>
        </tr>
        <?php }while($row = $students->fetch_assoc())?>

        </tbody>
    </table>
        <footer id="main-footer">
                <p>Copyright &copy; 2022 studentinfo_system</p>
        </footer>
</body>
</html>

