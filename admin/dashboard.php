<?php
    //  echo "Id:";
    session_start();
        
    if(isset($_SESSION['aid']))  {
         
        
    }
    else{
        header('location:../admin/a_login.php');
    }

?>
<html>
<head> 
    <title> dashboard </title>
    <link rel="stylesheet" type="text/css" href="../css/istyle.css" />
    <style>
        td{
            border:1px;
        }
    </style>
</head>
<body>
<div >

    <table align="center" id="nav-bar" style=" height:100px; width:100%;  background-color:brown; ">
            <tr>
                <td> <p style="color:white;" align="center" class="dh1">Login as :  </p> </td>
                <td style="color:white;"><?php echo   $_SESSION['auser'] ; ?></td>
                <td> <h2 align="center" class="heading" style="margin-top:10px; " > Welcome to Student Management System </h2></td>
                <td> <p  align="center" class="dh3" ><a style="color:white;" href="a_logout.php" >Logout</a></p></td>
            </tr>
    </table>
    <form method="post" action="dashboard.php">
        <table align="center" id="show-details" style=" height:100px; width:100%;  background-color:rgb(166, 221, 39);">
            <tr>
                <th> Student Name </th><td><input type="text" name="studentName" placeholder="Enter Name" /></td>
                <th> Student Branch </th><td><input type="text" name="branchName" placeholder="Enter Branch" /></td>
                <td colspan="2"><input type="submit" name="Search" value="Search" /></td>
            </tr>
        </table>
    </form>
    <table align="center" border="1" style=" width:100%; ">
        <tr >
            <th align="center">SrNo.</th>
            <th align="center"> Photo</th>
            <th align="center">Name </th>
            <th align="center">Branch </th>
            <th align="center">Option</th>
        </tr>
    
        
            
<?php

include('../dbcon.php');

if(isset($_POST['Search'])){
    
    $student_name= $_POST['studentName'];
    $branch_name= $_POST['branchName'];


    $query= "SELECT * FROM `sdetails` WHERE `name` LIKE '%$student_name%' AND `branch`='$branch_name'";
    
    $res=mysqli_query($con,$query);

    $row = mysqli_num_rows($res);


    if($row < 1){
       
        ?>
        <script>
            alert('no record found');
            window.open('dashboard.php','_self');
        </script>
        <!--window.open('../student/a_login.php','_self');  -->
        <?php
        //header('Location:student/a_login.php');
    }
    else{
        $count=0;
        while($data = mysqli_fetch_assoc($res)){
            $count++;
            ?>

            <tr>
                <td align="center"> <?php echo $count; ?>   </td>
                <td align="center"><img src="/images/<?php echo $data['photo']; ?>" style="height:100px; width:100px;" />  </td>
                <td align="center"> <?php echo $data['name']; ?>    </td>
                <td align="center"> <?php echo $data['branch']; ?>  </td>
                <td align="center">  <a href="edit.php?sid=<?php echo $data['id']; ?>">Edit</a> <td>
                
            </tr>

            <?php
        }
/*
        $current_id= $data['id'];
        $current_user= 

        echo "id :" .$current_id;
        echo "name: ".$current_user;

       

        $_SESSION['aid']=$current_id;   //new variable sid 
        $_SESSION['auser']=$current_user; 

        header('location:../admin/dashboard.php');*/

    }   
}
else{


    $query= "SELECT * FROM `sdetails` ";
    
    $res=mysqli_query($con,$query);

    $row = mysqli_num_rows($res);


    if($row < 1){
       
        ?>
        <script>
            alert('no record found');
            window.open('dashboard.php','_self');
        </script>
        <!--window.open('../student/a_login.php','_self');  -->
        <?php
        //header('Location:student/a_login.php');
    }
    else{
        $count=0;
        while($data = mysqli_fetch_assoc($res)){
            $count++;
            ?>

            <tr>
                <td align="center"> <?php echo $count; ?>   </td>
                <td align="center"><img src="../images/<?php echo $data['photo']; ?>" style="height:100px; width:100px;" />  </td>
                <td align="center"> <?php echo $data['name']; ?>    </td>
                <td align="center"> <?php echo $data['branch']; ?>  </td>
                <td align="center">  <a href="edit.php?sid=<?php echo $data['id']; ?>">Edit</a> <td>
            </tr>

            <?php
        }
/*
        $current_id= $data['id'];
        $current_user= 

        echo "id :" .$current_id;
        echo "name: ".$current_user;

       

        $_SESSION['aid']=$current_id;   //new variable sid 
        $_SESSION['auser']=$current_user; 

        header('location:../admin/dashboard.php');*/

    } 
}

?>
        </tr>
    </table>


    </div>
</body>
</html>

