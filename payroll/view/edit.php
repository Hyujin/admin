<?php
session_start();
    include("../controllers/db_conn.php");
    if(isset($_POST['emp_id-btn'])){
        $emp_id = $_POST['emp_id-btn'];
        $getUser = $db->query("SELECT employees.fullname, employees.role, employees.emp_type, employees.status, users.username, users.password
                                FROM `employees`
                                INNER JOIN users ON employees.id = users.emp_id
                                WHERE employees.id=$emp_id");
                                
        if($getUser->num_rows > 0){
            while($row = $getUser->fetch_assoc()){    
                $fullname = $row['fullname'];   
                $role = $row['role'];
                $emp_type = $row['emp_type'];
                $status = $row['status'];
                $username = $row['username'];
                $password = $row['password'];
        }
        }
        else{
            echo "Error";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style src='../css/main.css'></style>
        <script src='../js/main.js'></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Import</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <img src="../altria.png" alt="altria_logo" height="45vw" class="ms-3 me-5">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="employees.php">Go back</a>
                </li>
            </ul>

            <div class="dropdown me-5">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../res/meow.png" alt="meow" width="35" height="35" class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1">Rochelle</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                    <li><a class="dropdown-item" href="#">Update Username</a></li>
                    <li><a class="dropdown-item" href="#">Change Password</a></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
    </nav>

    <div class="container">

       <div class="row">
           <div class="col-4 py-2 mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page"></li>
                </ol>
              </nav>        
           </div>
           <div class="col-4"></div>
           <!-- <div class="col-4 py-2 mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Show Outbound only
                </label>
              </div>
            </div> -->
           <!-- <div class="col-4 py-2 mb-3">
               <input type="text mr-0 pr-0" class="text" id="search" placeholder=" Search...">
               <button type="submit" class="btn btn-sm btn-primary"><i class="fs-7 bi-search"></i></button>
        
           </div> -->
       </div>
        <div class="row">
            <div class="col-4 mb-3">
                <h4>Update Employee Details</h4>
            </div>
            <div class="col-8"></div>
        </div>
       <div class="row mb-2">
            <div class="col-1">
                <label for="fullname">
                    Fullname: 
                </label>
            </div>
            <div class="col-3">
                <input type="text" name="fullname" id="fullname" <?php echo "value=\"" .$fullname. "\" "?>>
            </div>
            <div class="col-1">
            <label for="role">
                    Role: 
                </label>
            </div>
            <div class="col-3">
            <input type="text" name="fullname" id="fullname" <?php echo "value=\"" .$role. "\" "?>>
            </div>
            <div class="col-4"></div>
       </div>

       <div class="row mb-2">
            <div class="col-1">
                <label for="fullname">
                    Type: 
                </label>
            </div>
            <div class="col-3">
                <input type="text" name="fullname" id="fullname" <?php echo "value=\"" .$emp_type. "\" "?>>
            </div>
            <div class="col-1">
            <label for="role">
                    Status: 
                </label>
            </div>
            <div class="col-3">
            <select >
                <option value="1" <?php echo ($Defaultselection == 1)?"selected":""; ?>>A</option>
                <option value="2" <?php echo ($Defaultselection == 2)?"selected":""; ?>>B</option>
                <option value="3" <?php echo ($Defaultselection == 3)?"selected":""; ?>>C</option>
                <option value="4" <?php echo ($Defaultselection == 4)?"selected":""; ?>>D</option>
            </select> 
            <!-- <input type="text" name="fullname" id="fullname" <?php echo "value=\"" .$status. "\" "?>> -->
            </div>
            <div class="col-4"></div>
       </div>

       <div class="row mb-2">
            <div class="col-1">
                <label for="fullname">
                    Username: 
                </label>
            </div>
            <div class="col-3">
                <input type="text" name="fullname" id="fullname" <?php echo "value=\"" .$username. "\" "?>>
            </div>
            <div class="col-1">
            <label for="role">
                    Password: 
                </label>
            </div>
            <div class="col-3">
            <input type="text" name="fullname" id="fullname" <?php echo "value=\"" .$password. "\" "?>>
            </div>
            <div class="col-4"></div>
       </div>

    <!--
       <div class="row ">
            <div class="ms-5 mb-5 mt-5">
                <label for="fullname">
                    Fullname: 
                </label>
                <input type="text" name="fullname" id="fullname" class="me-5" <?php echo "value=\"" .$fullname. "\" "?>>
                <label for="role">
                    Role: 
                </label>
                <input type="text" name="fullname" id="fullname" <?php echo "value=\"" .$role. "\" "?>>
            </div>
        </div>
        <div class="row">
            <div class="ms-5  mb-5">
                <label for="fullname">
                    Type: 
                </label>
                <input type="text" name="fullname" id="fullname" class="me-5" <?php echo "value=\"" .$emp_type. "\" "?>>
                <label for="role">
                    Status: 
                </label>
                <input type="text" name="fullname" id="fullname" <?php echo "value=\"" .$status. "\" "?>>
            </div>
        </div>
        <div class="row">
            <div class="ms-5  mb-5">
                <label for="fullname">
                    Username: 
                </label>
                <input type="text" name="fullname" id="fullname" class="me-5" <?php echo "value=\"" .$username. "\" "?>>
                <label for="role">
                    Password: 
                </label>
                <input type="text" name="fullname" id="fullname" <?php echo "value=\"" .$password. "\" "?>>
            </div>
        </div>

-->
       
    </div>
        <!-- /* #this entire project is written by
        #author: Euegene Cortes
        #jumior full stack developer
        #eugenecortes.work@gmail.com
        #this is an mvp payslip portal api product from timetrex data
        #you may use, develop, or create a fork copy of this project. */ -->
</body>

</html>