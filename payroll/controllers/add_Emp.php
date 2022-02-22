<?php
include_once 'db_conn.php';

$name = $_POST['name'];
$role = $_POST['role'];
$type = $_POST['type'];

$insertNewNameQuery = "INSERT INTO employees (full_name, role, type) VALUES ('$name', '$role', '$type') ";
echo ($insertNewNameQuery);
if (mysqli_query($db, $insertNewNameQuery)) {
    echo "New name inserted successfully";
}
else{
    echo "Query failed";
}


// if ($name != "" && $role !="" && $type != ""){
//     echo "has values";
//     $reg_Emp = new setEmployee($name, $role, $type);
//     }
//     else{
//         echo "missing values";
//     }


// Class setEmployee{

//     function reg_Emp($name, $role, $type){
//         $this->name = $name;
//         $this->role = $role;
//         $this->$type = $type;
//         echo("running reg_emp function");
//         $insertNewNameQuery = "INSERT INTO employees (full_name, role, type) VALUES ('$fullname', '$role', '$type') ";
//         echo ($insertNewNameQuery);
//         if (mysqli_query($db, $insertNewNameQuery)) {
//             echo "New name inserted successfully";
//         }
//         else{
//             echo "Query failed";
//         }
//     }

// }





?>