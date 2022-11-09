<?php


function verify_employe_login($emp_no, $password, $conn){
  
    $existed_emp = "select * from employee where emp_number='" . $emp_no ."'";
    
    $query_emp = mysqli_query($conn, $existed_emp);
    
    if($query_emp -> num_rows>0){
       $emp = mysqli_fetch_assoc($query_emp);
       $emp_password = $emp['password'];
       $verify_password = password_verify($password, $emp_password);
        
       if($verify_password){
           $_SESSION['emp_number'] = $emp['id'];
           $_SESSION['emp_name'] = $emp['first_name'].' '.$emp['last_name'];
           $_SESSION['role'] = 'employee';
           return true;
       }  
       return false;
    }
}

function getEmpInfo($id, $conn){
    $employee = "select * from employee where id=" . $id;
    $employee_sql = mysqli_query($conn, $employee);
    $employee_arr = mysqli_fetch_assoc($employee_sql);
    return $employee_arr; 
}

function getprogressrequests($id, $conn){
    
    $all_requests = "select r.id as request_id,service_id,emp_id,s.id,s.type from request r join 
     service s on s.id=r.service_id where r.status='in progress' and r.emp_id=" . $id."";
    $reqs_sql = mysqli_query($conn, $all_requests);
    return $reqs_sql;
}

function getprogressedrequests($id, $conn){
    
    $all_requests = "select r.id as request_id,service_id,emp_id,s.id,s.type from request r join 
     . service s on s.id=r.service_id where r.status<>'in progress' and r.emp_id=" . $id.' ';
    $reqs_sql = mysqli_query($conn, $all_requests);
    return $reqs_sql;
}

function getrequest($id, $conn){
    
    $request = "select * from request where id=" . $id;
    $request_sql = mysqli_query($conn, $request);
    $request_arr = mysqli_fetch_assoc($request_sql);
    return $request_arr;
}

function getservice($conn){
    
    $service = "select * from service";
    $service_sql = mysqli_query($conn, $service);
    return $service_sql;
}

function updateRequest($id, $sid, $desc, $file_name, $file_name2, $conn){
    
    $file_edit='';
    
    if ($file_name != '') {
        $file_edit = ",attachment1='$file_name'";}
    if ($file_name2 != '') {
    $file_edit .= ",attachment2='$file_name2'";}
    
    $update_request = "update request set service_id='$sid' ,description='$desc' ".$file_edit." where id=$id";
    
   // echo $update_request;
    $result = mysqli_query($conn, $update_request);
    
    if($result){
        return true;
    }
    return false;   
}


function addRequest($id, $srid, $des, $filnam, $filnam2, $conn){
    
    $add_request = "INSERT INTO 'request'('emp_id', 'service_id', 'description', 'attachment1', 'attachment2', 'status') VALUES($id, '$srid', '$des', '$filnam', '$filnam2', 'in progress')";
    
    $result = mysqli_query($conn, $add_request);
    
    if($result){
        return mysqli_insert_id($conn);
    }
    return false; 
}