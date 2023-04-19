<?php

function Connections(){

    $host ="localhost";
    $username ="root";
    $password ="12345";
    $database ="studentinfo_system";

    $con = new mysqli($host, $username, $password, $database);

    if($con->connect_error){
        
        echo $con->connect_error;
    }else{

        return $con;
    }

} 