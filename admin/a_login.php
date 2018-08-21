
<?php
     session_start();
     if(isset($_SESSION['aid'])){
         header('location:../admin/dashboard.php');
     }
?>

<html>
    <head>
        <title> student managment system </title>
        <link rel="stylesheet" type="text/css" href="../css/istyle.css" />

    </head>
    <body>
        <h3 align="right" style="margin-right:40px; color:white; " class="a_login">
            <a href="../index.php" style=" color:white; font-family:Times New Roman; ">Home</a></h3>
        <h2 align="center" class="heading"> Welcome to Student Management System </h2>
        
        <h3 align="center" style=" color:brown;">Admin portal</h3>
        
        <form method="post" action="a_login.php" >
            <table align="center" >
                <tr>
                    <td align="right" > User Name :  </td>
                    <td> <input type="text" name="auser" ></td>

                </tr>
                
                <tr>
                    <td align="right" > Password :  </td>
                    <td> <input type="password" name="apass" ></td>
                    
                </tr>
                <tr >  
                    <td colspan="2" align="center"> <input type="submit" name="alogin" value="Login" ></td>
                    
                </tr>
                <p></p>
            </table>
            
        </form>
    </body>
</html>


<?php

include('../dbcon.php');


if(isset($_POST['alogin'])){
    
    
    $a_username= $_POST['auser'];
    $a_pass= $_POST['apass'];
    ?>

        <script>
            alert('username or password '); 
        </script>
    <?php

    
    $query= "SELECT * FROM `admin` WHERE  `user`='$a_username' AND `pass`='$a_pass' ";
    
    $res=mysqli_query($con,$query);

    $row = mysqli_num_rows($res);
    


    if($row < 1){
       echo "running";
        ?>
        <script>
            alert('username or password does not match!');
            window.open('a_login.php','_self');
        </script>
        <!--window.open('../student/a_login.php','_self');  -->
        <?php
        //header('Location:student/a_login.php');
    }
    else{
        
        $data = mysqli_fetch_assoc($res);

        $current_id= $data['id'];
        $current_user= $data['user'];

        echo "id :" .$current_id;
        echo "name: ".$current_user;

        ?>
        <script>
            alert('username or password match!');
        </script>
        <?php
        $_SESSION['aid']=$current_id;   //new variable sid 
        $_SESSION['auser']=$current_user; 

        header('location:../admin/dashboard.php');

    }
}


?>