<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "Altria123!@#";
$db_name = "auto_api";

mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);


if (!$con) { die('Error: ' . mysql_error()); }


$db = "INSERT INTO api_logs (answer_time, talk_time, cx_phone, call_date, agent_name, acct_id, call_id, status_of_call, order_status, call_direction)
			SELECT answer_time, talk_time, cx_phone, call_date, agent_name, acct_id, call_id, status_of_call, order_status, call_direction FROM calls_temp";
if ($con->query($db) === TRUE) {
	echo "New record created successfully";
   
	echo $db;
}
$con->close();

header("Location: clear_temp.php");


?>