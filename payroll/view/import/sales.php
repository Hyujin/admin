<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../css/login.css">
        <link rel="stylesheet" href="../../css/main.css">
        <title>Import</title>
        <style>
            .table td, 
            .table th {
                white-space: nowrap;
                width: 1%;
            }
        </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <img src="../../altria.png" alt="altria_logo" height="45vw" class="ms-3 me-5">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="regular.php">Regular</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="sales.php">Sales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../employees.php">Employees</a>
                    </li>
                </ul>
                <div class="dropdown me-5">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../../res/meow.png" alt="meow" width="35" height="35" class="rounded-circle">
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

                  



    <?php
        include("../../controllers/db_conn.php");
        // Get status message
        if(!empty($_GET['status'])){
            switch($_GET['status']){
                case 'empty':
                    $statusType = 'alert-danger';
                    $statusMsg = 'Please select at least one filter parameter in search.';
                    break;

                default:
                    $statusType = '';
                    $statusMsg = '';

                }
            }

            if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            }

            $no_of_records_per_page = 18;
            $offset = ($pageno-1) * $no_of_records_per_page;
            $sort = "fullname";
            $visibility = "Hidden";
            
            $total_pages_sql = "SELECT COUNT(*) FROM employees";
            $result = mysqli_query($db,$total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);   
    ?>

    <div class="container-fluid ms-3">
        <div class="row">
                <div class="col-8 py-2 mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                    </nav>
                </div>
                <div class="col-4 py-2 mb-3">
                    <!-- <input type="text" class="text" id="search" placeholder=" Search...">
                    <button type="submit" class="btn btn-sm btn-primary"> <i class="fs-7 bi-search"></i></button> -->
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-success ms-1" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fs-7 bi-cloud-arrow-up"></i> Import</button>
                        
                        <button type="button" class="btn btn-sm btn-danger ms-1" data-bs-toggle="modal" data-bs-target="#clearModal"> <i class="bi bi-trash"></i>Clear</button>
                        
                        <button class="btn btn-sm btn-success ms-4" data-bs-toggle="modal" data-bs-target="#modalPublish"><i class="bi bi-upload"></i> Publish</button> 
                    </div>
        </div>
    </div>    

    
    <!-- Modal -->
    <div class="modal fade" id="importModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Choose Import</h5>
                    
                </div>
                <div class="modal-body">
                <label>Sales Based Employees</label>
                <div class="input-group input-group-sm mt-3 mb-3">
                    <form action="../../controllers/comm_Import.php" method="post" enctype="multipart/form-data">
                        <div class="form-control" style="border: 0;">
                            <input class="form-control form-control-sm" id="formFileSm"  type="file" name="file"  required accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                            <label>Set Start Date: </label>
                            <input class="date mt-3" type="date" name="start_date" id="start_date" required><br>
                            <label>Set End Date: </label>
                            <input class="date mt-3" type="date" name="end_date" id="end_date" required>
                            <input type="submit" class="btn btn-primary btn-sm position-absolute top-100 end-0 translate-middle-y" name="importSubmit" value="IMPORT">
                        </div>
                    </form>
                </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
             <!-- Modal Clear-->
             <div class="modal fade" id="clearModal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Clearing Payslip Records?</h5> 
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p class="text-secondary"><small>Note: This will only affect this instace or imported record. Please re upload another record</small></p>
                    </div>
                    <div class="modal-footer">
                    <form action="../../controllers/clear.php" method="post">
                        <button class="btn btn-sm btn-danger">Clear</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        
                <!-- Modal Publish-->
            <div class="modal fade" id="modalPublish" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Publishing Payslip Records?</h5> 
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p class="text-secondary"><small>Once published. The records will be visible to all employees.</small></p>
                    </div>
                    <div class="modal-footer">
                    <form action="../../controllers/publish.php" method="post">
                        <button class="btn btn-sm btn-success">Publish</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                    </div>
                    </div>
                </div>
            </div>


    <div class="container-fluid">
    <div class="table-responsive">
            <table class="table table-lg table-responsive table-striped table-hover table-light mt-3">
                    <thead class="table-primary">

                        <th class="col text-start"><small>Name</small></th>
                        <th class="col text-center"><small>Role</small></th>

                        <th class="col text-center"><small>Training Rate</small></th>
                        <th class="col text-center"><small>Sales Rate</small></th>
                        <th class="col text-center"><small>Allowance Rate</small></th>
                        <th class="col text-center"><small>ND Rate</small></th>
                        <th class="col text-center"><small>Total Number of Sales</small></th>
                        <th class="col text-center"><small>Total Training Days</small></th>
                        <th class="col text-center"><small>Reg Hol Hrs</small></th>
                        <th class="col text-center"><small>Total Number of Days</small></th>
                        <th class="col  text-center"><small>SPL Hol Hours</small></th> 
                        <th class="col  text-center"><small>Prem Hours</small></th> 

                        <th class="col  text-center"><small>Sales Pay</small></th>
                        <th class="col  text-center"><small>Training Pay</small></th> 
                        <th class="col  text-center"><small>Allowance Pay</small></th> 
                        <th class="col  text-center"><small>Dispute</small></th> 
                        <th class="col  text-center"><small>SPL Hol Pay</small></th> 
                        <th class="col  text-center"><small>Reg Hol Pay</small></th> 
                        <th class="col  text-center"><small>Premium Pay</small></th>
                        <th class="col  text-center"><small>OT Pay</small></th>
                        <th class="col  text-center"><small>Other Campaign Pay</small></th>
                        <th class="col  text-center"><small>Gross Pay</small></th> 

                        <th class="col  text-center"><small>SSS</small></th> 
                        <th class="col  text-center"><small>Phic</small></th> 
                        <th class="col  text-center"><small>PAGIBIG</small></th> 
                        <th class="col  text-center"><small>Others</small></th> 
                        <th class="col  text-center"><small>CA</small></th> 
                        <th class="col  text-center"><small>Total Deductions</small></th> 

                        <th class="col  text-center"><small>Net Pay</small></th>  
                    </thead>
                    <tbody>
                    <?php        
                    $sql = "SELECT  employees.id, employees.fullname, employees.role, employees.emp_type, sales_rate.training_rate,
                    sales_rate.sales_rate, sales_rate.allow_hr_rate, sales_rate.nd_rate, sales_manhour.total_sales, sales_manhour.training_days,
                    sales_manhour.reg_hol_hrs, sales_manhour.total_num_days, sales_manhour.spl_hrs, sales_manhour.prem_hrs, sales_pay.sales_pay,
                    sales_pay.training_pay, sales_pay.allow_pay, sales_pay.dispute, sales_pay.spl_pay, sales_pay.reg_hol_pay,sales_pay.premium_pay,
                    sales_pay.ot_pay, sales_pay.other_campaign_pay, sales_pay.gross_pay, deductions.sss, deductions.phic,deductions.pagibig,
                    deductions.others, deductions.ca, deductions.total_deductions, sales_pay.net_pay, payroll_batch.status,
                    payroll_batch.start_date, payroll_batch.end_date, payroll_batch.batch_id
                    FROM sales_pay
                    INNER JOIN employees ON sales_pay.emp_id = employees.id
                    INNER JOIN sales_manhour ON sales_pay.emp_id = sales_manhour.emp_id
                    INNER JOIN sales_rate ON sales_pay.emp_id = sales_rate.emp_id
                    INNER JOIN deductions ON sales_pay.emp_id = deductions.emp_id
                    INNER JOIN payroll_batch on sales_pay.batch_id = payroll_batch.batch_id
                    WHERE payroll_batch.status = 0
                    GROUP BY employees.id
                    ORDER BY $sort ASC LIMIT $offset, $no_of_records_per_page";

                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    if($row['status'] == 1){
                                        $row['status'] = "Public";
                                    }
                                else{
                                    $row['visibility'] = "Private";
                                    }

                                    $id = $row['id'];
                                    echo "<tr class='text-center align-middle'>";
                                    echo "<form action='../controllers/updateImport.php' method='POST'>";
                                    
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='fullname' class='hidden text-left'  value=\"" . $row["fullname"] . "\" > </td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text'  name='role' class='hidden text-center'  value=\"" . $row["role"] . "\" > </td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='number' id='order_id' size='4' name='total_worked_hrs'  class='hidden text-center' value=\"" . $row["training_rate"] . "\" > </td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='number' name='total_deductions' class='hidden text-center'  value=".$row['sales_rate']." > </td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='number' name='ot_pay' class='hidden text-center'  value=\"" . $row["allow_hr_rate"] . "\" > </td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='number' name='gross_pay' class='hidden text-center'   value=\"" .$row['nd_rate']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='number' name='net_pay' class='hidden text-center'  value=\"" .$row['total_sales']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='start_date' class='hidden text-center'  value=\"" .$row['training_days']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='end_date' class='hidden text-center' disabled value=\"" .$row['reg_hol_hrs']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='ot_hours' class='hidden text-center' disabled value=\"" .$row['total_num_days']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='spl_hol_hrs' class='hidden text-center' disabled value=\"" .$row['spl_hrs']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='prem_hrs' class='hidden text-center' disabled value=\"" .$row['prem_hrs']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='basic_hrs_pay' class='hidden text-center' disabled value=\"" .$row['sales_pay']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='nds_pay' class='hidden text-center' disabled value=\"" .$row['training_pay']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='allow_pay' class='hidden text-center' disabled value=\"" .$row['allow_pay']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='dispute' class='hidden text-center' disabled value=\"" .$row['dispute']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='spl_pay' class='hidden text-center' disabled value=\"" .$row['spl_pay']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='reg_hol_pay' class='hidden text-center' disabled value=\"" .$row['reg_hol_pay']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='prem_hol_pay' class='hidden text-center' disabled value=\"" .$row['premium_pay']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='ot_pay' class='hidden text-center' disabled value=\"" .$row['ot_pay']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='ot_pay' class='hidden text-center' disabled value=\"" .$row['other_campaign_pay']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='gross_pay' class='hidden text-center' disabled value=\"" .$row['gross_pay']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='sss' class='hidden text-center' disabled value=\"" .$row['sss']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='phic' class='hidden text-center' disabled value=\"" .$row['phic']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='pagibig' class='hidden text-center' disabled value=\"" .$row['pagibig']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='others' class='hidden text-center' disabled value=\"" .$row['others']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='ca' class='hidden text-center' disabled value=\"" .$row['ca']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='total_deductions' class='hidden text-center' disabled value=\"" .$row['total_deductions']. "\"></td>";
                                    echo "<td scope='col'> <input style='border: 0;' type='text' name='net_pay' class='hidden text-center' disabled value=\"" .$row['net_pay']. "\"></td>";
                                    $_SESSION['batch_id'] = $row['batch_id'];
                                    echo "</form>";
                                    echo "</tr>";
                                    
                                    }
                            } 
                            else {
                                echo "<tr><td colspan='15' class='text-center'>No record(s) found...</td></tr>";
                            }

                            $db->close();

                            ?>
                    </tbody>
                </table>
   
        </div>

        <p class="text-center">Page <?php echo"$pageno" ?> of <?php echo"$total_pages" ?></p>
        
        <nav class="container d-flex justify-content-center">

                <ul class="pagination  mt-4">
                    <li><a href="?pageno=1" class="btn btn-sm btn-dark ms-3 me-3">First</a></li>
                    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>" class="btn btn-sm btn-dark ms-3 me-3">
                        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="btn btn-sm btn-dark ms-3 me-3">Prev</a>
                    </li>
                    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" class="btn btn-sm btn-dark ms-3 me-3">Next </a>
                    </li>
                    <li><a href="?pageno=<?php echo $total_pages; ?>" class="btn btn-sm btn-dark ms-3 me-3">Last</a></li>
                </ul>
        </nav>

    </div>

 
</body>
</html>