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
        

        <form method="post" action="s_data_in.php" style=" width:100%" enctype="multipart/form-data">
            <table align="center"  style=" width:100% ; height:100%;">
                <tr>
                    <td align="center" colspan="4">fill tha data correctly<td>
                </tr>
                <tr>
                    <td align="right" > Name :  </td>
                    <td> <input type="text" name="s_name" ></td>
                    <td align="right" > father's name :  </td>
                    <td> <input type="text" name="s_father" ></td>

                </tr>
                <tr>
                    <td align="right" > Roll no :  </td>
                    <td> <input type="number" name="s_roll" ></td>
                    <td align="right" > branch :  </td>
                    <td> <input type="text" name="s_branch" ></td>

                </tr>
                <tr>
                    <td align="right" > semester :</td>
                    <td> <input type="number" name="s_sem" ></td>
                    <td align="right" >total marks obtained :  </td>
                    <td> <input type="number" name="s_marks" ></td>
                    
                </tr>
                
                <tr >  
                    <td align="right"> Upload photo :</td>
                    <td><input type="file" name="img" /></td>
                    <td colspan="4" align="center"> <input type="submit" name="submit" value="submit" ></td>
                    
                </tr>
                
            </table>
            
        </form>
    </body>
</html>



<?php

include('../dbcon.php');
if(isset($_POST['submit'])){
    
    $s_name= $_POST['s_name'];
    $s_father= $_POST['s_father'];
    $s_roll= $_POST['s_roll'];
    $s_branch= $_POST['s_branch'];
    $s_sem= $_POST['s_sem'];
    $s_marks= $_POST['s_marks'];


    $thisId=$_SESSION['sid'];
    //check data already uploaded or not

    $CheckQuery= "SELECT * FROM `sdetails` WHERE `id`='$thisId' ";

    $CheckRes=mysqli_query($con,$CheckQuery);

    $CheckRow = mysqli_num_rows($CheckRes);
      
       if($CheckRow < 1){     // no details with this id
           
               //take data in

            $imgName = $_FILES['img']['name'] ;	//saving img as name
            $tempImagesName= $_FILES['img']['tmp_name'] ; //saving img name as temp name
            
            move_uploaded_file($tempImagesName , "../images/$imgName");
            
            
            
            $query= "INSERT INTO `sdetails` (`id`, `name`, `branch`, `sem`, `roll`, `fathername`, `score`,`photo`) 
                                VALUES ('$thisId','$s_name','$s_branch','$s_sem','$s_roll','$s_father','$s_marks','$imgName')";
    
           $res=mysqli_query($con,$query);
       
           $ndata = mysqli_fetch_assoc($res); 
       
           if($res){
       
               ?>
               <script>
                   alert('data uploaded you can edit it as well. \n or exit.');
                   window.open('s_update.php?sid=<?php echo $_SESSION['sid']; ?>','_self');
               </script>
               
               <?php
               
           }
           else{
               //header('Location:../student/s_data_in.php');
               ?>
                   <script>
                       alert('already submit.');
                       window.open('s_data_in.php','_self');
                   </script>
               <?php
              // echo "Error!";
               
           }


        }

        else{
            ?>
            <script>
                alert('already uploaded data. \n You can update it.');
                window.open('s_update.php','_self'); 
            </script>
            
            <?php
        }
		
}

?>