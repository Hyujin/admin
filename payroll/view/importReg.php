<!DOCTYPE html>
<html>
    <header>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <Title>Altria Payroll</Title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
        <style src='../css/main.css'></style>
        <script src='../js/main.js'></script>
    </header>
    <body>
    <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-primary bg-gradient">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a class="d-flex align-items-center pb-1 mb-md-0 me-md-auto text-dark text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline"><img src='../res/altria.png' height='50' width='90'></span>
                        </a>   
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li class="nav-item">
                                <a href="home.php" class="nav-link text-light align-middle px-0">
                                    <i class="fs-5 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                            <a href="importReg.php" class="nav-link text-light align-middle px-0">
                                <i class="fs-5 bi-file-earmark-plus"></i> <span class="ms-1 d-none d-sm-inline">Import Regular</span>
                                </a>
                            </li>
                            <li class="nav-item">
                            <a href="importComm.php" class="nav-link text-light align-middle px-0">
                                <i class="fs-5 bi-file-earmark-plus"></i> <span class="ms-1 d-none d-sm-inline">Import Commissions</span>
                                </a>
                            </li>
                            <li>
                                <a href="employees.php" class="nav-link text-light px-0 align-middle">
                                    <i class="fs-5 bi-person-plus"></i> <span class="ms-1 d-none d-sm-inline">Add Employees</span></a>
                            </li>
                        </ul>
                        <hr>
                        <div class="dropdown pb-4">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../res/meow.png" alt="meow" width="50" height="50" class="rounded-circle">
                                <span class="d-none d-sm-inline mx-1">chelly</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col py-3">
    <?php
        include("../controllers/db_conn.php");
        // Get status message
        if(!empty($_GET['status'])){
            switch($_GET['status']){
                case 'empty':
                    $statusType = 'alert-danger';
                    $statusMsg = 'Please select atleast one filter parameter in search.';
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
            
            $total_pages_sql = "SELECT COUNT(*) FROM employees";
            $result = mysqli_query($db,$total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            
            
    ?>
    <div class="container-fluid">
       
       <div class="row">
            <div class="col-8 py-2 mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Regular Employees</li>
                </ol>
                </nav>
            </div>
            <div class="col-4 py-2 mb-3">
                <input type="text" class="text" id="search" placeholder=" Search...">
                <button type="submit" class="btn btn-sm btn-primary"> <i class="fs-5 bi-search"></i></button>
            
                    <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Import Payroll CSV">
                        <a href="javascript:void(0);" class="btn btn-success btn-sm import-toggle" onclick="formToggle('importFrm');" ><i class="fs-5 bi-cloud-arrow-up"></i></a>
                    </span>  
                </div>
       </div>

       <div class="row">
        <div class="col-6"></div>
        <div class="col-6 import-toggle" id="importFrm" style="display: none;">
            <div class="input-group input-group-sm position-relative">
                <form action="../controllers/emp_Import.php" method="post" enctype="multipart/form-data">
                    <div class="form-control" style="border: 0;">
                        <input class="form-control form-control-sm" id="formFileSm"  type="file" name="file" />
                        <input type="submit" class="btn btn-primary btn-sm position-absolute top-50 end-0 translate-middle-y" name="importSubmit" value="IMPORT">
                    </div>
                </form>
            </div>  
        </div>
       </div>
        <div class="row">
            <table class="table table-responsive table-striped table-light ms-5">
                <thead class="table-primary">
                    <th class="col">
                        <input type="checkbox" class="radio ms-3" id="allMarked">
                    </th>
                    <th class="col">Name</th>
                    <th class="col">Role</th>
                    <th class="col">Manhour</th>
                    <th class="col">Total Deductions</th>
                    <th class="col">OT Pay</th>
                    <th class="col">Gross Pay</th>
                    <th class="col">Net Pay</th>
                    <th class="col">Date</th>
                    <th class="col">Status</th>
                    <th class="col-2">Tool</th> 
                </thead>
                <tbody>
                <?php        
                $sql = "SELECT employees.fullname, employees.role, reg_manhour.total_worked_hrs, deductions.total_deductions, reg_pay.ot_pay, reg_pay.gross_pay, reg_pay.net_pay, reg_pay.timestamps, reg_pay.visibility
                        FROM reg_pay
                        INNER JOIN employees ON reg_pay.emp_id = employees.id
                        INNER JOIN reg_manhour ON reg_pay.emp_id = reg_manhour.emp_id
                        INNER JOIN deductions ON reg_pay.emp_id = deductions.emp_id
                        ORDER BY fullname ASC LIMIT $offset, $no_of_records_per_page ";

                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                 echo "<tr class='text-center align-middle'>";
                                 echo "<form action='edit.php' method='post'>";
                                 echo "<td scope='col'> <input class='ms-3' type='radio'> </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='16' name='id' class='hidden text-center' disabled value=\"" .$row['fullname']. "\" > </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='8' name='fullname' class='hidden text-center' disabled value=\"" . $row["role"] . "\" > </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' id='order_id' size='14' name='order_id' disabled class='hidden text-center' value=\"" . $row["total_worked_hrs"] . "\" > </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='10' name='cx_phone' class='hidden text-center' disabled value=".$row['total_deductions']." > </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='5' name='disposition' class='hidden text-center' disabled value=\"" . $row["ot_pay"] . "\" > </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='12' name='amount' class='hidden text-center' disabled  value=\"" .$row['gross_pay']. "\"></td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='12' name='amount' class='hidden text-center' disabled value=\"" .$row['net_pay']. "\"></td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='12' name='amount' class='hidden text-center' disabled value=\"" .$row['timestamps']. "\"></td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='12' name='amount' class='hidden text-center' disabled value=\"" .$row['visibility']. "\"></td>";
                                 echo "<td scope='col'> 
                                 <button class='pr-1 btn btn-sm btn-primary'><i class='fs bi-pencil-square'></i></button>
                                 <button class='pr-1 btn btn-sm btn-success'><i class='fs bi-printer'></i></button>
                                 </td>";
                                 echo "</form>";
                                 echo "</tr>";
                                }
                          } 
                          else {
                            echo "<tr><td colspan='12' class='text-center'>No record(s) found...</td></tr>";
                          }

                          $db->close();

                          ?>
                </tbody>
            </table>
        </div>
                        <nav class="container position-relative mb-5">
                                <ul class="pagination position-absolute top-50 start-50 translate-middle mt-4">
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

    <script>

function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
    </body>
    
    </html>