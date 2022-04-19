<?php
session_start();
include_once 'db_conn.php';
$batch_id = $_SESSION['batch_id'];
echo $batch_id;
$clearDeductions = "DELETE FROM deductions WHERE batch_id = $batch_id";
if ($db->query($clearDeductions) == TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $db->error;
  }
  $clearmanhour = "DELETE FROM reg_manhour WHERE batch_id = $batch_id";
if ($db->query($clearmanhour) == TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $db->error;
  }
  $clearpay = "DELETE FROM reg_pay WHERE batch_id = $batch_id";
if ($db->query($clearpay) == TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $db->error;
  }
  $clearrate = "DELETE FROM reg_rate WHERE batch_id = $batch_id";
  if ($db->query($clearrate) == TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $db->error;
  }
  $clearbatch = "DELETE FROM payroll_batch WHERE batch_id = $batch_id";
if ($db->query($clearbatch) == TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $db->error;
  }
  header("Location: ../view/import/regular.php");
?>