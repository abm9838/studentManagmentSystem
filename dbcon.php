<?php 

    $con = mysqli_connect("localhost","root","","sms");

    if($con){
       // echo "connection successfull";
    }
    else{
        echo mysql_error();
    }
?>