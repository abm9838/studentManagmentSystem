
<html>
    <head>
        <title> student managment system </title>
        <link rel="stylesheet" type="text/css" href="../css/istyle.css" />
        <script src="../assets/jquery.js"></script>
    </head>
    <body>
        <h3 align="right" style="margin-right:40px; color:white; " class="a_login">
            <a href="../index.php" style=" color:white; font-family:Times New Roman; ">Home</a></h3>
        <h2 align="center" class="heading"> Welcome to Student Management System </h2>
        
        <h3 align="center" style=" color:brown;">forget password</h3>
        
        <form method="post" action="s_forget.php" >
            <table align="center" class="u_verify">
                <tr>
                    <td align="right" > User Name :  </td>
                    <td> <input type="text" name="s_user" ></td>

                </tr>
                <tr>
                    <td align="right" > Email :  </td>
                    <td> <input type="text" name="s_email" ></td>
                    
                </tr>
                <tr >  
                    <td colspan="2" align="center"> <input type="submit" name="submit" value="Submit" ></td>
                    
                </tr>
                
            </table>
            <table align="center" class="new_pass" >
                
                <tr>
                    <td align="right" > New Password :  </td>
                    <td> <input type="text" name="n_pass" ></td>

                </tr>
           
                <tr >  
                    <td colspan="2" align="center"> <input type="submit" name="n_submit" value="Submit" ></td>
                    
                </tr>
            
                
            </table>
           
        </form>

        <script>
            var n_id;
           $('.new_pass').hide();

        </script>
    </body>
</html>



<?php


include('../dbcon.php');


if(isset($_POST['submit'])){
    
    $s_username= $_POST['s_user'];
    $s_email= $_POST['s_email'];


    $query= "SELECT * FROM `student` WHERE  `suser`='$s_username' AND `email`='$s_email' ";

    $res=mysqli_query($con,$query);

    $row = mysqli_num_rows($res);


    if($row < 1){
      // echo "....ro". $row ;
        ?>
        <script>
            alert('username or email does not match!');
        </script>
        <window.open('../student/s_forget.php','_self'); 
        <?php
        
    }
    else{
        echo "email verified";
        $n_data = mysqli_fetch_assoc($res);

        $cu_id = $n_data['sid'];
        $cu_user=$n_data['suser'];
      //  echo $cu_user;
        $nquery = "INSERT INTO `id`(`nid`, `email`) VALUES ('$cu_id','$cu_user')";


        $ts = mysqli_query($con,$nquery);

        ?>
        <script></script>
        <script>
           $('.u_verify').hide();
           $('.new_pass').show();
        </script>
    <?php
    }
}

if(isset($_POST['n_submit'])){

        $qur = " SELECT * FROM `id` WHERE `nid`=1 ";

        $n = mysqli_query($con,$qur); 
        $new = mysqli_fetch_assoc($n);
        $n_email=$new['email'];
        
        $dqry = "DELETE FROM `id` WHERE `sn`=1";
        mysqli_query($con, $dqry);

        echo "email :" .$n_email;
        
        $s_new_password= $_POST['n_pass'];

        // echo $s_new_password;

        $nquery = "UPDATE `student` SET `spass`='$s_new_password' WHERE `email`='$n_email' ";

        $ress = mysqli_query($con,$nquery);
       
        if($ress){
            ?>
            <script>
                alert('password updated successfully!.');
                window.open('../student/s_login.php','_self');
            </script>
            
            <?php
        }
        else{
            ?>
            <script></script>
            <script>
                alert('password update failed');
                window.open('../student/s_forget.php','_self'); 
            </script>
            <?php
        }
    
    }

?>