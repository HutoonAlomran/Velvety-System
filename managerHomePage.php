<?php
session_start();
include "connection.php";
$id = $_SESSION['id'];
$role = $_SESSION['role'];
if (empty($role)) {
    header('Location: index.php');
}

$sql = "SELECT * FROM manager WHERE id ='$id' ";
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$r = mysqli_fetch_array($query) or die(mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>VELVETY SYSTEM</title>
        <meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/manger_form.css">
<!--===============================================================================================-->
         <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">  
<!--===============================================================================================-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--===============================================================================================-->
        <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>  

        <style>
            .red{
                box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                font-family: Montserrat-Bold;
                margin-top: 1rem;
                display: inline-block;
                font-size: 1rem;
                color: white;
                background: #B22222;
                border-radius: 5rem;
                cursor: pointer;
                padding: 0.8rem 2rem;
                line-height: 1.5;
                height: 30px;
                border-radius: 25px;
                padding: 0 25px;
                display: flex;
                justify-content: center;
                align-items: center;
                text-decoration: none;
            }
            .green{
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
                border-radius: 25px;
                padding: 0 25px;
                display: flex;
                justify-content: center;
                align-items: center;
                text-decoration: none;	}


            .button , #submit {
                box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                font-family: Montserrat-Bold;
                margin-top: 1rem;
                display: inline-block;
                font-size: 1.3rem;
                color: white;
                background: #57b846;
                border-radius: 5rem;
                cursor: pointer;
                padding: 0.8rem 3rem;
                font-size: 15px;
                line-height: 1.5;
                color: #fff;
                text-transform: uppercase;

                height: 50px;
                border-radius: 25px;
                padding: 0 25px;
                display: flex;
                justify-content: center;
                align-items: center;
                text-decoration: none;
            }

            .button:hover{
                box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                color: white;
                background: #333333;
            }


            .invisible{
                visibility: hidden;
                display: none;
            }
            
            .visible{
                visibility: visible;
                display: flex;
            }


        </style>
    </head>

    <body>

        <div class="topnav">
            <a class="active" href="index.php">Home</a>
            <a href="#news">News</a>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>
        </div>
        <div class="container-login100">
            <div class="wrap-login100">
                <?php
                include "connection.php";
                $sql = "SELECT * FROM manager WHERE id='$id'";
                $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $r = mysqli_fetch_array($query);
                ?>
                <span><p style="font-family: Montserrat-Bold; font-size:30px;" ><b>Welcome Manager: </b><?= $r['first_name'] ?> <?= $r['last_name'] ?></p>
                </span>
                <br>
                <br>


                <p>

                    <?php
                    $tquery = mysqli_query($conn, "SELECT * FROM service");


                    while ($tresult = mysqli_fetch_assoc($tquery)) {
                        $serv_id = $tresult['id'];
                        $type = $tresult['type'];
                        $msql = "SELECT service.type,request.status,employee.first_name,employee.last_name,request.id AS rid,service.id AS sid,employee.id AS eid,request.emp_id,request.service_id FROM request JOIN service ON request.service_id=service.id JOIN employee ON employee.id=request.emp_id WHERE request.service_id=$serv_id";
                        $q = mysqli_query($conn, $msql) or die(mysqli_error($conn));
                        ?>


                    <table>	
                        <thead>
                            <tr class="">
                                <th colspan="3"><b><?= $type ?>  Requests</b></th>

                            </tr>
                        </thead>
                        <tr class="">
                            <th>ID- employee Name</th>
                            <th>Status</th>
                            <th></th>
                        </tr>


                        <tbody>

                            <?php
                            while ($s = mysqli_fetch_assoc($q)) {
                                ?>

                                <tr>

                                    <td> 
                                        <a  id="<?= $s['rid'] ?>" class="tooltip-9" href="information.php?bid=<?= $s['rid'] ?>"> <b><?= $s['rid'] ?></b>.  <?= $s['first_name'] ?> <?= $s['last_name'] ?></a> 
                                    </td>

                                    <?php
                                    $status = $s['status'];
                                    if (($status) == 1) {
                                        ?>
                                    <td ><div id="status<?php echo $s['rid']; ?>">Approved</div></td>
                                        <td>

                                            <a id="dec<?php echo $s['rid']; ?>" href="" class="btn red decline-button" decid="<?php echo $s['rid']; ?>">Decline
                                            </a>
                                            <a id="app<?php echo $s['rid']; ?>" href="" class="btn green approve-button invisible" myid="<?php echo $s['rid']; ?>">Approve
                                            </a>

                                        </td>
                                        <?php
                                    }
                                    if (($status) == 0) {
                                        ?>
                                        <td><div id="status<?php echo $s['rid']; ?>">In progress</div></td>
                                        <td>
                                            <a id="dec<?php echo $s['rid']; ?>" href="" class="btn red decline-button" decid="<?php echo $s['rid']; ?>">Decline
                                            </a>
                                            <a id="app<?php echo $s['rid']; ?>" href="" class="btn green approve-button" myid="<?php echo $s['rid']; ?>">Approve
                                            </a>
                                        </td>
                                        <?php
                                    }
                                    if (($status) == 2) {
                                        ?>
                                        <td><div id="status<?php echo $s['rid']; ?>">Declined</div></td>
                                        <td>
                                            <a id="dec<?php echo $s['rid']; ?>" href="" class="btn red decline-button invisible" decid="<?php echo $s['rid']; ?>">Decline
                                            </a>
                                            <a id="app<?php echo $s['rid']; ?>" href="" class="btn green approve-button" myid="<?php echo $s['rid']; ?>">Approve
                                            </a>
                                        </td>
                                    </tr>	 <?php
                                }
                            }
                            ?>

                        </tbody>

                    </table>		




                    <?php
                }
                ?>
                <a class="button"  href = "logout.php">Sign Out</a></p>
            </div>
        </div>

        <footer>
            <div class="credit"> VELVETY SYSTEM 2021 &copy; All Rights reserved</div>
        </footer>
                       
        <script>
            //approve request
            $('.approve-button').click(function () {
                event.preventDefault();
                var myid = $(this).attr("myid");
                $.ajax({
                    url: "approve.php",
                    type: "POST",
                    data: "myid=" + myid,
                    success: function () {
                        $("#app"+myid).addClass('invisible');    
                        $("#app"+myid).removeClass('visible');
                        $("#dec"+myid).removeClass('invisible');
                        $("#dec"+myid).addClass('visible');
                        $("#status"+myid).text("Approved");

                        console.log("AJAX request was successfull");
                    },
                    error: function () {
                        console.log("AJAX request was a failure");
                    }
                });

            });
      
            //decline request
            $('.decline-button').click(function () {
                event.preventDefault();
                var decid = $(this).attr("decid");
                $.ajax({
                    url: "decline.php",
                    type: "POST",
                    data: "decid=" + decid,
                    success: function () {
                        $("#dec"+decid).addClass('invisible');     
                        $("#dec"+decid).removeClass('visible');
                        $("#app"+decid).addClass('visible');
                        $("#app"+decid).removeClass('invisible');
                        $("#status"+decid).text("Declined");
                        
                        console.log("AJAX request was successfull");
                    },
                    error: function () {
                        console.log("AJAX request was a failure");
                    }
                });

            });

             //get description
            $(document).ready(function () {
                $('.tooltip-9').tooltip({
                    items: 'a.tooltip-9',
                    content: function (result) {
           /*ajax*/ $.post('fetch_data.php', {
                            id: $(this).attr('id')
                        }, function (data) {
                            result(data);
                        });
                    }
                    ,
                    show: "slideDown", // show immediately  
                    open: function (event, ui)
                    {
                        ui.tooltip.hover(
                                function () {
                                    $(this).fadeTo("slow", 0.5);
                                });
                    }
                });
            });

        </script>
    </body>
</html>