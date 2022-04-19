<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../auth/login.php");
}
    include("../controllers/db_conn.php");
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
                    <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="import/regular.php">Regular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="import/sales.php">Sales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="employees.php">Employees</a>
                </li>
            </ul>

            <div class="dropdown me-5">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../res/meow.png" alt="meow" width="35" height="35" class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1">Rochelle</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                    <!-- <li><a class="dropdown-item" href="#">Update Username</a></li>
                    <li><a class="dropdown-item" href="#">Change Password</a></li> -->
                    <li><a class="dropdown-item" href="../controllers/logout.php">Sign out</a></li>
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
         <h6>Recent Payslip Records</h6>
         <form method='POST' action='../controllers/viewer.php'>
            <table class="table table-sm table-responsive table-light">
                <thead class="table-primary">
                    <th class="col">From</th>
                    <th class="col">To Date</th>
                    <th class="col">Type</th>
                    <th class="col">Status</th>
                    <th class="col">Tools</th>
                </thead>
                <tbody>
                <?php        
                    $sql = "SELECT payroll_batch.batch_id, payroll_batch.start_date, payroll_batch.end_date, payroll_batch.status, payroll_batch.type FROM payroll_batch";

                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    if($row['status'] == 1){
                                        $status = "Public";
                                    }
                                else{
                                    $status = "Private";
                                    }
                                    $st_date=date_create($row['start_date']);
                                    $start_date = date_format($st_date,"M/d/Y");
                                    $nd_date=date_create($row['end_date']);
                                    $end_date = date_format($nd_date,"M/d/Y");
                
                                    echo "<tr>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='start_date'  disabled value=\"" .$start_date. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='end_date'  disabled value=\"" .$end_date. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='type'  disabled value=\"" .$row['type']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='status'  disabled value=\"" .$status. "\"></td>";
                                    echo "<td scope='col'> 
                                    <button class='pr-1 btn btn-sm btn-primary hidden' type='submit' placeholder='View' value=\"" .$row['batch_id']. "\" name='view-btn' data-bs-toggle='tooltip' data-bs-placement='left' title='Click to open records on this schedule'>View</button>
                                    </td>";  
                                    echo "</tr>";             
                                    
                                    }
                            } 
                            else {
                                echo "<tr><td colspan='6' class='text-center'>No record(s) found...</td></tr>";
                            }
                            $db->close();
                            ?>
                </tbody>
            </table>
        </form>
        </div>
    </div>
        <!-- /* #this entire project is written by
        #author: Euegene Cortes
        #jumior full stack developer
        #eugenecortes.work@gmail.com
        #this is an mvp payslip portal api product from timetrex data
        #you may use, develop, or create a fork copy of this project. */ -->
</body>

</html>