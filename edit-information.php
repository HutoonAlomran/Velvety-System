<?php
session_start();
 include "connection.php";
 $userid=$_SESSION['id'];
 $role=$_SESSION['role'];
 $id=$_GET['id']; 

 if(empty($userid)){
     header('Location: index.php');
 }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Request Information</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min_89.css">

<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome_89.min.css"><!-- comment -->

    
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body class="">
    <div class="topnav">
        <a class="active" href="index.html">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
        </div>

        <div class="container-information">
            <div class="wrap-information" >
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <h4>Edit Request login</h4>
                        
                    </div>
                    <?php
                    include "connection.php";
                        $msql="SELECT * FROM request  JOIN employee ON employee.id=request.emp_id WHERE request.id='$id'";

                        $query=mysqli_query($conn,$msql) or die(mysqli_error($conn));
                        $q=mysqli_fetch_array($query);
                    
                    ?>
                    <div class="card-body">
                         <?php
                                     
                          include "connection.php";
                            $msql="SELECT * FROM service";
                            $quer=mysqli_query($conn,$msql) or die(mysqli_error($conn));
                            $data=mysqli_fetch_array($quer);
                        
                        ?>
                        <form action="edit-request.php" method="post" role="form" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                        <input type="hidden" class="form-control" name="employee_id" value="<?=$q['emp_id']?>">                       
                        

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" aria-describedby="" placeholder="Enter full name" value="<?=$q['first_name']?> <?=$q['last_name']?>" disabled>
                           </div>
                           
                            <div class="form-group">
                                <label for="selectProgress">Progress</label>
                                <?php
                                 if(($role)=="employee"){ ?>
                                <select class="form-control form-select" name="status">
                                    <option value="<?=$q['status']?>"> 
                                    <?php 
                                    $status=$q['status'];
                                        if($status == 0){
                                            echo 'In progress';
                                        }elseif ($status == 1) {
                                             echo 'Approved';
                                        } else {
                                            echo 'declaind';
                                        }
                                    ?> </option>
                                   
                                </select>
                               <?php  } ?>

                            </div>
                            <div class="form-group">
                                <label for="description"></b>Description</b></label>
                                <textarea class="form-control" name="description" aria-describedby="" placeholder="Description" rows="12"><?=$q['description']?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="files"><b>Choose Files</b></label> </br>                              
                                <P style="font-size: 15px">attachment1:</p><input type="file" class="form-control" id="file" name="image" id="image" >
                                <P P style="font-size: 15px">attachment2:</p><input type="file" class="form-control" id="file" name="image2" id="image">
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="submit">
                                    Update Request Information
                                </button>
                            </div>
                        </form>
                    </div>
                </div>              
            </div>
        </div>
    
    <footer>
        <div class="credit"> VELVETY SYSTEM 2021 &copy; All Rights reserved</div>
    </footer><!-- comment -->
    
</body>
</html>