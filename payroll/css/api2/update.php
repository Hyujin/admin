<?php
require_once('db_conn.php');

$call_date = $_POST['call_date'];
$talk_time = $_POST['talk_time'];
$cx_phone = $_POST['cx_phone'];
$answer_time = $_POST['answer_time'];
$acct_id = $_POST['acct_id'];


	$query = "UPDATE calls_temp
              SET call_date = '$call_date', talk_time = '$talk_time', cx_phone = '$cx_phone', answer_time = '$answer_time', agent_name = '$agent_name', acct_id = '$acct_id'
              WHERE answer_time = $answer_time AND talk_time = $talk_time";

if ($db->query($query) === TRUE) {
        header('location: index.php?status=upd');
    } else {
      echo "Error: " . $query . "<br>" . $db->error;
       header('location: index.php?status=updfail');

    }


?>