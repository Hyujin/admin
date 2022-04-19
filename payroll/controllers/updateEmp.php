<?php
include 'db_conn.php';

$emp_id         = $_POST['emp_id'];
$fullname       = $_POST['fullname'];
$role           = $_POST['role'];
$emp_type       = $_POST['emp_type'];
$status         = $_POST['status'];
$username       = $_POST['username'];
$password       = $_POST['password'];


$isOkay = 1;

$updateEmp = "UPDATE employees SET fullname = '$fullname', role = '$role', emp_type = '$emp_type', status = '$status'  WHERE id = $emp_id";
if ($db->query($updateEmp) === TRUE) {
    echo "Record updated successfully for 1";
  } else {
      $isOkay = 0;
    echo "Error updating record: " . $db->error;
  }


$updateUser = "UPDATE users SET username = '$username', password = '$password' WHERE emp_id = $emp_id";
if ($db->query($updateUser) === TRUE) {
    echo "Record updated successfully for 2";
  } else {
      $isOkay = 0;
    echo "Error updating record: " . $db->error;
  }


  if($isOkay = 0){
      //something went wrong
  }
  else{
      header("Location: ../view/employees.php");
  }

?>