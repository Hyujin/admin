<?php
session_Start();
include_once 'db_conn.php';

if(isset($_POST['view-btn'])){
        echo "button is set <br>";
        $batch_id = $_POST['view-btn'];
        echo "id is set";
}
else{
    header("Locaion: ../view/dashboard.php");

}

$_SESSION['bid'] = $batch_id;

$getType = $db->query("SELECT type FROM payroll_batch WHERE batch_id = '$batch_id'");
if($getType->num_rows > 0){
    while($row = $getType->fetch_assoc()){       
        $type = $row["type"];
}
}
echo $batch_id;
echo "<br>";
echo $type;
echo "<br>";
if($type === "Regular"){
    echo "routing to regular";
    header('location: ../view/regular.php');
}
else if($type === "Sales"){
    echo "routing to sales";
    header('location: ../view/sales.php');
}
else{
    echo "Something went wrong";
}


if(isset($_POST['emp_id'])){
    echo "id button is set <br>";
    $emp_id = $_POST['emp_id'];

    $getUser = "SELECT employees.fullname, employees.role, employees.emp_type, employees.status, users.username, users.password
    FROM `employees`
    INNER JOIN users ON employees.id = users.emp_id
    WHERE employees.id=$emp_id";
    

    
}

?>