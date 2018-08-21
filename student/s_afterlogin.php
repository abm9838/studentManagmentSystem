<?php

    session_start();
        
    if(isset($_SESSION['sid']))  {
         
        //echo   $_SESSION['suser'] ;
    }
    else{
        header('location:../student/s_login.php');
    }

?>

<html>
    <head>
        <title> student managment system </title>
        <link rel="stylesheet" type="text/css" href="../css/istyle.css" />

    </head>
    <body>
        <table id="nav-bar" style=" height:100px; width:100%;  background-color:brown; ">
                <tr>
                    <td> <p style="color:white;" align="center" class="dh1">Login as :  </p> </td>
                    <td style="color:white;"><?php echo   $_SESSION['suser'] ; ?></td>
                    <td> <h2 align="center" class="heading" style="margin-top:10px; " > Welcome to Student Management System </h2></td>
                    <td> <p  align="center" class="dh3" ><a style="color:white;" href="../student/s_out.php" >Logout</a></p></td>
                </tr>
        </table>
        

        <form method="post" action="s_afterlogin.php" style=" width:100%" >
            <table align="center"  style=" width:100% ; height:100%;">
                
                <tr>

                    <td  align="center"> <input style=" width:40% ; height:50px;" type="submit" name="dataNotSubmitted" value="Upload data first time"></td>

                    <td  align="center"> <input style=" width:40% ; height:50px;" type="submit" name="alreadySubmitted" value="Update data" ></td>
    
                </tr>
                
            </table>
            
        </form>
    </body>
</html>



<?php

include('../dbcon.php');


    if(isset($_POST['alreadySubmitted'])){
            

        ?>
        <script>
            alert('Update your data here ');
            window.open('s_update.php?sid=<?php echo $_SESSION['sid'] ; ?>','_self');
        </script>
        
        <?php
        
    }

    if(isset($_POST['dataNotSubmitted'])){
        
    
        ?>
        <script>
            alert(' Submit your data here ');
            window.open('s_data_in.php','_self');
        </script>
        
        <?php
            
    }
    
    

?>