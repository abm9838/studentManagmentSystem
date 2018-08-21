
<html>
    <head>
        <title> student managment system </title>
        <link rel="stylesheet" type="text/css" href="css/istyle.css" />

    </head>
    <body>
        <h3 align="right" style="margin-right:40px; color:white; " class="a_login">
            <a href="admin/a_login.php" style=" color:white; font-family:Times New Roman; ">admin login</a></h3>
        <h2 align="center" class="heading"> Welcome to Student Management System </h2>
        
        <h3 align="center" style=" color:brown;">Student Portal</h3>
        <p></p>
        <form method="post" action="index.php" >
            <table align="center" >
                <tr>
                    <td align="right" > User Name :  </td>
                    <td> <input type="text" name="s_user" ></td>

                </tr>
                <tr>
                    <td align="right" > Email :  </td>
                    <td> <input type="text" name="s_email" ></td>

                </tr>
                <tr>
                    <td align="right" > Password :  </td>
                    <td> <input type="password" name="s_pass" ></td>
                    
                </tr>
                <tr >  
                    <td colspan="2" align="center"> <input type="submit" name="submit" value="SignUp" ></td>
                    
                </tr>
                
            </table>
            <p style="margin-left:30%;"><a href="student/s_login.php">already registered?</a>
             
              <a style="position:relative; padding-left:200px;" href="student/s_forget.php">forget password?</a>  </p>
           
        </form>
    </body>
</html>


<?php

    include('dbcon.php');
    if(isset($_POST['submit'])){
        
        $s_username= $_POST['s_user'];
        $s_email= $_POST['s_email'];
        $s_pass= $_POST['s_pass'];

        /*

            verify  input

        */



     $SearchQuery= "SELECT * FROM `student` WHERE  `suser`='$s_username' ";

     $SearchRes=mysqli_query($con,$SearchQuery);

     $SearchRow = mysqli_num_rows($SearchRes);
       
        if($SearchRow < 1){     // no username found with the same name
            
                $query= "INSERT INTO `student`( `suser`, `spass`, `email`) VALUES ('$s_username','$s_pass','$s_email')";

                $res=mysqli_query($con,$query);

                if($res){
                    ?>
                    <script>
                        alert('registered successfully!. \n now login here.');
                    
                        window.open('./student/s_afterlogin.php','_self'); 
                    </script>
                    <?php
                }
                else{
                    ?>
                    <script></script>
                    <script>
                        alert('data not received! Try again.');
                        window.open('index.php','_self'); 
                    </script>
                    
                    <?php
                }

        }
        else{    //user found with the same name
            
            ?>
                <script>
                    alert('Username already taken choose another one.');
                  //  window.open('./student/s_login.php','_self'); 
                </script>
            <?php
        }
    }

    
    
?>