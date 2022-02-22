<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "Altria123!@#";
$db_name = "auto_api";

mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);


if (!$con) { die('Error: ' . mysql_error()); }


$db = "TRUNCATE table calls_temp";

  if ($con->query($db) === TRUE) {
      $con->close();
	header("Location: index.php?status=cleared");
    } else {
      echo "Error: " . $db . "<br>" . $con->error;
    }


$con->close();




?>