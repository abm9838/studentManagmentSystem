
<?php
     session_start();
     if(isset($_SESSION['sid'])){
         header('location: s_data_in.php');
     }
?>

<html>
    <head>
        <title> student managment system </title>
        <link rel="stylesheet" type="text/css" href="../css/istyle.css" />

    </head>
    <body>
        <h3 align="right" style="margin-right:40px; color:white; " class="a_login"><a href="../index.php" style=" color:white; font-family:Times New Roman; ">Home</a></h3>
        <h2 align="center" class="heading"> Welcome to Student Management System </h2>
        
        <h3 align="center" style=" color:brown;">Registered Student Login Here</h3>
        
        <form method="post" action="s_login.php" >
            <table align="center" >
                <tr>
                    <td align="right" > User Name :  </td>
                    <td> <input type="text" name="suser" ></td>

                </tr>
                <tr>
                    <td align="right" > Password :  </td>
                    <td> <input type="password" name="spass" ></td>
                    
                </tr>
                <tr >  
                    <td colspan="2" align="center"> <input type="submit" name="login" value="Login" ></td>
                    
                </tr>
                
            </table>
            <p style="margin-left:30%;">
             <a style="position:relative; padding-left:0px;" href="../student/s_forget.php">forget password?</a>  </p>
          
        </form>
    </body>
</html>



<?php

include('../dbcon.php');

if(isset($_POST['login'])){
    
    $s_username= $_POST['suser'];
    $s_pass= $_POST['spass'];


    $query= "SELECT * FROM `student` WHERE  `suser`='$s_username' AND `spass`='$s_pass'   ";

    $res=mysqli_query($con,$query);

    $row = mysqli_num_rows($res);


    if($row < 1){
       echo "runiing";
        ?>
        <script>
            alert('username or password does not match!');
            window.open('s_login.php','_self');
        </script>
        <!--window.open('../student/s_login.php','_self');  -->
        <?php
        //header('Location:student/s_login.php');
    }
    else{
        
        $data = mysqli_fetch_assoc($res);
        $current_id= $data['sid'];
        $current_user= $data['suser'];
        echo "id :" .$current_id;
        echo "name: ".$current_user;

       

        $_SESSION['sid']=$current_id;   //new variable sid 
        $_SESSION['suser']=$current_user; 

        header('location:s_afterlogin.php');

    }
}

?>