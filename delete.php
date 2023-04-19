<?php

include_once("Connections/Connections.php");
$con = Connections();

if(isset($_POST['delete'])){

    $id = $_POST['ID'];
    $sql = "DELETE FROM student_list WHERE id = '$id'";
    $con->query($sql) or die ($con->error);

    echo header ("Location: index.php");
}

?>