<?php
include_once 'db_conn.php';


$sqlreg = "UPDATE reg_pay SET visibility= 1 WHERE 1";
$sqlsales = "UPDATE sales_pay SET visibility= 1 WHERE 1";

if ($db->query($sqlreg) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $db->error;
  }
  
  if ($db->query($sqlsales) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $db->error;
  }


  $db->close();

$qstring = '?status=succ';

// Redirect to the listing page
header("Location: ../view/dashboard.php.$qstring");




?>