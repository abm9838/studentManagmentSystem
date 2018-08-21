<?php
    session_start();

    session_destroy();

    header('location:../admin/a_login.php');

    

?>