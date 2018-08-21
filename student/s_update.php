<?php
    
    session_start();
        
    if(isset($_SESSION['sid']))  {
         
        
    }
    else{
        header('location:../student/s_login.php');
    }


    include('../dbcon.php');

    //check for if data is already uploaded or not
    $sid = $_SESSION['sid'];

    $CheckQuery= "SELECT * FROM `sdetails` WHERE `id`='$sid' ";

    $CheckRes=mysqli_query($con,$CheckQuery);

    $CheckRow = mysqli_num_rows($CheckRes);
      
       if($CheckRow < 1){     // no details with this id

        ?>
        <script>
            alert('data not uploaded yet. \n You can upload it here.');
            window.open('s_data_in.php','_self'); 
        </script>
        
        <?php

       }

    $data = mysqli_fetch_assoc($CheckRes);
           

?>
<html>
<head> 
    <title> dashboard </title>
    <link rel="stylesheet" type="text/css" href="../css/istyle.css" />
    <style>
        table, td{
            border:0px solid red;

        }
        td{
            height:100px;
            width:500px;
            padding:20px;
        }
        input{
            height:35px;
        }
        
        img{
            height: 300px;
            width: 300px;
            margin:25%;
        }
        
    </style>
</head>
<body>
<div >

<div>
    <table align="center" id="nav-bar" style=" height:100px; width:100%;  background-color:brown; ">
            <tr>
                <td  style=" width:10%;"> <p style="color:white;" align="right" class="dh1">Login as :</p></td>
                <td  style=" width:10%;"> <p style="color:white;" align="left"><?php echo   $_SESSION['suser'] ; ?> </p> </td>
               
                <td> <h2 align="center" class="heading" style="margin-top:10px; " > Welcome to Student Management System </h2></td>
                <td style=" width:15%;"> <p  align="center" class="dh3" ><a style="color:white;" href="s_out.php" >Logout</a></p></td>
            </tr>
    </table>
    </div>
    <div>
    <form method="post" action="s_update.php" style=" width:100%" enctype="multipart/form-data">


         <table align="center"  style=" width:100% ; height:100%;">

         <tr>
             <th style=" height:70px; "colspan="3"> <h3 style="color:rgb(54, 47, 7); ">Student Profile</h3> </th>
        </tr>

        <tr>
            <td rowspan="4"> <img src="../images/<?php echo $data['photo']; ?>" /></td>
            <td style=" width:25%;" align="right" > Name :  </td>
            <td style=" width:35%;"> <input type="text" name="s_name" value=" <?php echo $data['name']; ?>"></td>
        </tr>


        <tr>
                
             <td align="right" > father's name :  </td>
             <td> <input type="text" name="s_father" value="<?php echo $data['fathername']; ?> "></td>
        </tr>
        <tr>
               
            <td align="right" > Roll no :  </td>
            <td> <input type="number" name="s_roll" value="<?php echo $data['roll']; ?>" ></td>
        </tr>


        <tr>
               
            <td align="right" > branch :  </td>
            <td> <input type="text" name="s_branch" value="<?php echo $data['branch']; ?>" ></td>
        </tr>


        <tr>
                <td style="padding-left:10%;" align="center"> <input type="file" name="img" value="<?php echo $data['photo']; ?> "/></td>
                <td align="right" > semester :</td>
                <td> <input type="number" name="s_sem" value="<?php echo $data['sem']; ?>" ></td>
        </tr>


        <tr>
            <td align="center"></td>
            <td align="right" >total marks obtained :  </td>
            <td> <input type="number" name="s_marks" value="<?php echo $data['score']; ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"> <input type="submit" name="submit" value="Update" ></td>
            <td></td>   
        <tr>
    

        </form>
    <div>
</div>
</body>
</html>


<?php


if(isset($_POST['submit'])){

    /* ******* */
//$sid = $_GET['sid'];
$s_name= $_POST['s_name'];
$s_father= $_POST['s_father'];
$s_roll= $_POST['s_roll'];
$s_branch= $_POST['s_branch'];
$s_sem= $_POST['s_sem'];
$s_marks= $_POST['s_marks'];


$imgName = $_FILES['img']['name'] ;
	//saving img as name
if($imgName==null){
    $que= "UPDATE `sdetails` SET `name`='$s_name',`branch`='$s_branch',`sem`='$s_sem',
    `roll`='$s_roll',`fathername`='$s_father',`score`='$s_marks' WHERE `id`='$sid' "  ;
    
}
else{

    $tempImagesName= $_FILES['img']['tmp_name'] ; //saving img name as temp name
        
    move_uploaded_file($tempImagesName , "../images/$imgName");

    $que= "UPDATE `sdetails` SET `name`='$s_name',`branch`='$s_branch',`sem`='$s_sem',
                `roll`='$s_roll',`fathername`='$s_father',`score`='$s_marks',`photo`='$imgName' WHERE `id`='$sid' "  ;
}

$res=mysqli_query($con,$que);

if($res){
   
  //  header('Location:student/s_show.php');
   // echo "registered";
    ?>
    <script>
        alert(' data has been Updated successfully.');
        window.open('s_update.php','_self');
    </script>
    <!--window.open('../student/s_login.php','_self');  -->
    <?php
    
    
}
else{
    header('Location:edit.php');
    ?>
        <script>
            alert('data not received! Try again.');
        </script>
    <?php
   // echo "Error!";
    
}
}
?>