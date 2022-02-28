<?php
include("../controllers/db_conn.php");

 $limit = 12;
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
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>PBS</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/splash.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="script" href="../js/import.js">
</head>
<body>
    <div class="container">
       
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
                    <th class="col">Hourly Rate</th>
                    <th class="col">Man hour</th>
                    <th class="col">Gross Pay</th>
                    <th class="col">Deductions</th>
                    <th class="col">Net Pay</th>
                    <th class="col">Status</th>
                    <th class="col-2">Tool</th> 
                </thead>
                <tbody>
                <?php        
                        $sql = "SELECT employees.fullname, employees.role, reg_pay.basic_hrs_pay, reg_pay.nds_pay, reg_pay.allow_pay, reg_pay.dispute, reg_pay.spl_hol_pay, reg_pay.reg_hol_pay, reg_pay.prem_hol_pay, reg_pay.ot_pay, reg_pay.gross_pay, reg_pay.net_pay, reg_pay.visibility
                        FROM reg_pay
                        INNER JOIN employees ON reg_pay.emp_id = employees.id ORDER BY fullname ASC LIMIT $offset, $no_of_records_per_page ";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                 echo "<tr class='text-center align-middle'>";
                                 echo "<form action='edit.php' method='post'>";
                                 echo "<td scope='col'> <input class='ms-3' type='radio'> </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='16' name='id' class='hidden text-center' disabled value=\"" .$row['fullname']. "\" > </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='8' name='fullname' class='hidden text-center' disabled value=\"" . $row["role"] . "\" > </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' id='order_id' size='14' name='order_id' disabled class='hidden text-center' value=\"" . $row["basic_hrs_pay"] . "\" > </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='10' name='cx_phone' class='hidden text-center' disabled value=".$row['nds_pay']." > </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='5' name='disposition' class='hidden text-center' disabled value=\"" . $row["allow_pay"] . "\" > </td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='12' name='amount' class='hidden' disabled value=\"" .$row['dispute']. "\"></td>";
                                 echo "<td scope='col'> <input style='border: 0;' type='text' size='12' name='amount' class='hidden text-center' disabled value=\"" .$row['net_pay']. "\"></td>";
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
                            echo "0 results";
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