<?php
 session_start();
 include "connection.php";
 $userid=$_SESSION['id'];
 $role=$_SESSION['role'];
 
  if(empty($userid)){
     header('Location: index.php');
 }

 $role=$_SESSION['role']; 
 $sql="SELECT * FROM employee WHERE id='$userid'";
 $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
 $r=mysqli_fetch_array($query); 
?>

<!DOCTYPE html>

<html>
    <head>
        
        <title> Employee home page </title>
        
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        
        
        <link rel="stylesheet" type="text/css" href="css.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <script src = "Employeehp.js"></script>
        
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <style>
        .edit{
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            font-family: Montserrat-Bold;
            margin-top: 1rem;
            display: inline-block;
            font-size: 1rem;
            color: white;
            background: #57b846;
            border-radius: 5rem;
            cursor: pointer;
            padding: 0.8rem 2rem;
            line-height: 1.5;
            height: 30px;
            width: 200px;
            border-radius: 25px;
            padding: 0 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
	}
        .edit:hover{
            background-color:#333333;
            color:white;
	}


    </style>
    </head>
    
   <!-- 5- Employee home page that contains their information (first name, last name, ID and job title), 
            a list of their requests, the ability to edit each of the requests, the ability to add a new request,
            and a ‘sign-out’ link that redirects to the system’s home page (see Number 2).
            Each request is displayed as a combination of request’s ID and service type, and it links to 
            ‘request information page’. --> 
  
   
   <body>
       
    <div class="topnav">
      <a class="active" href="index.php">Home</a>
      <a href="#news">News</a>
      <a href="#contact">Contact</a>
      <a href="#about">About</a>
      </div>
  
     <div class="container-login">

     <div class="wrap-login">
                            
   <!--  <img src="" alt="logo" class="logo"> -->

   <div class="h1">  
   <p style="font-family: Montserrat-Bold; font-size:30px; "><b>Welcome</b> <?=$r['first_name']?> <?=$r['last_name']?></p>
   <br>
   <p style="font-family: Montserrat-Bold; font-size:23px; text-align: left;">
       <b>Employee's ID:</b> <?=$r['emp_number']?>
       <br>
       <b>Job Title:</b> <?=$r['job_title']?>
    </p>   
       <p><a class="button" href = "form.php"><i class="fa fas fa-plus"></i>&nbsp;&nbsp;Add New Request</a></p>
   </div>       
   
     <!-- -------------------- table1 ------------------- -->           
    <?php
    include "connection.php";
    $msql="SELECT * FROM request WHERE emp_id='$userid' AND status=0";
    $q=mysqli_query($conn,$msql);
    
    $msql0="SELECT * FROM request WHERE emp_id='$userid' AND (status LIKE '2' OR status LIKE '1')";
    $q0=mysqli_query($conn,$msql0);
    
//  var_dump($q0);
    ?>
                
    <table>
        <thead>
    <tr class="">
     <th colspan="3"><b>In progress Requests</b></th>
    </tr>
    
        <tr class="">
         <th>Request ID - Service type</th>
         <th></th>
         <th>Edit Request</th>
        </tr>
        </thead>
        
        <tbody>
        <?php 
        
        while($rows=mysqli_fetch_assoc($q)){
            ?>
            
             <?php 
                $type = $rows['service_id'];
                if(($type)==1){ 
                     $type ="leave";
                }else{
                    $type ="party";
                }				   
                ?>
            
            <tr class=""> 
             <td> <a href="information.php?bid=<?=$rows['id']?>" class="btn btn-info" role="button"><?=$rows['id']?> - <?=$type?></a></span></td>
             <td></td>
             <td><a   class="edit" href="edit-information.php?id=<?=$rows['id']?>"><span>Edit</span></a></td>
            </tr>
            
       <?php } ?>
            
        </tbody>
        </table>
            
            <br>
            <br>
          <!-- -------------------- table2 ------------------- -->  

        <table>
            <thead>
                <tr class="">
                <th colspan="3"><b>Processed Requests</b></th>
                </tr>
        <tr class="">
          <th>Request ID - Service type</th>
           <th>Status</th>
         <th>Edit Request</th>
        </tr>
           </thead>
           
           <tbody>
        <?php 
        
        while($rows0=mysqli_fetch_assoc($q0)){
            ?>
            <tr class=""> 
                
                <?php 
                $type = $rows0['service_id'];
                if(($type)==1){ 
                     $type ="leave";
                }else{
                    $type ="party";
                }				   
                ?>
                
             <td><a class="" href = "information.php?bid=<?=$rows0['id']?>"><span><?=$rows0['id']?> - <?=$type?></span></a></td>
            
             <?php
					   
							   $status=$rows0['status'];
							   if(($status)==1){ ?>
							       <td>Approved</td>	
							 <?php } 
							   if(($status)==0){ ?>
							       <td>In progress</td> 	
							 <?php } 
							 if(($status)==2){ ?>
							       <td>Declined</td>
							 <?php }  
					   ?>
             <td><a class="edit" href="edit-information.php?id=<?=$rows0['id']?>"><span>Edit</span></a></td>
            </tr>
            
       <?php } ?>   
         
           </tbody>
           
        </table>
            
            
        
        <!---------------------- footer ------------------- --> 
        
    
        <p><a class="button" href = "logout.php">Sign Out</a></p>
                        </div><!-- comment -->
                </div>
       
        <footer>
        <div class="credit"> VELVETY SYSTEM 2021 &copy; All Rights reserved</div>
        </footer><!-- comment -->
    </body>
</html>