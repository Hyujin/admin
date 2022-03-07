<?php
include_once 'db_conn.php';


$id = $_POST['id'];
$fullname = $_POST['fullname'];
$role = $_POST['role'];
$emp_type = $_POST['emp_type'];
$total_worked_hrs = $_POST['total_worked_hrs'];
$total_deductions = $_POST['total_deductions'];
$ot_pay = $_POST['ot_pay'];
$gross_pay = $_POST['gross_pay'];
$pay_sched = $_POST['pay_sched'];

$id = mysqli_real_escape_string($db, $id);
$emp_id = $id;
$fullname = mysqli_real_escape_string($db, $fullname);
$role = mysqli_real_escape_string($db, $role);
$emp_type = mysqli_real_escape_string($db, $emp_type);
$pay_sched = mysqli_real_escape_string($db, $pay_sched);
$emp_type = mysqli_real_escape_string($db, $emp_type);
$total_worked_hrs = mysqli_real_escape_string($db, $total_worked_hrs);
$total_deductions = mysqli_real_escape_string($db, $total_deductions);
$ot_pay = mysqli_real_escape_string($db, $ot_pay);
$gross_pay = mysqli_real_escape_string($db, $gross_pay);




$sqlname = "UPDATE employees SET fullname = '$fullname' WHERE id = $id ";
if ($db->query($sqlname) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $db->error;
  }

  $sql_role = "UPDATE employees SET role = '$role' WHERE id = $emp_id";
  if ($db->query($sql_role) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $db->error;
    }

  $sql_emp_type = "UPDATE employees SET emp_type = '$emp_type' WHERE id = $emp_id";
if ($db->query($sql_emp_type) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $db->error;
  }

  $sql_total_worked_hrs = "UPDATE reg_manhour SET total_worked_hrs = '$total_worked_hrs' WHERE id = $emp_id";
  if ($db->query($sql_total_worked_hrs) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $db->error;
    }

    $sql_total_deductions = "UPDATE deductions SET total_deductions = '$total_deductions' WHERE id = $emp_id";
    if ($db->query($sql_total_deductions) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $db->error;
      }

    
      $sql_ot_pay = "UPDATE reg_pay SET ot_pay = '$ot_pay' WHERE id = $emp_id";
      if ($db->query($sql_ot_pay) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $db->error;
        }

        $sql_gross_pay = "UPDATE reg_pay SET ot_pay = '$gross_pay' WHERE id = $emp_id";
        if ($db->query($sql_gross_pay) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . $db->error;
          }


  $sqlot_pay = "UPDATE reg_pay SET ot_pay = '$ot_pay' WHERE id = $emp_id AND pay_sched = $pay_sched ";
if ($db->query($sqlot_pay) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $db->error;
  }





  header("Location: ../view/import.php");

?>


