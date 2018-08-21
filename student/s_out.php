<?php
    session_start();

    session_destroy();

    header('location:../student/s_login.php');

    

?>