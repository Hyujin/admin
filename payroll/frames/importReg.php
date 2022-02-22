<?php
include("../controllers/getImports.php");
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
            <table class="table table-responsive table-striped table-light">
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
                    <th class="col">Print Status</th>
                    <th class="col-2">Tool</th>
                </thead>
                <tbody>
                    <tr class="table-hover align-bottom">
                        <td class="col">
                            <input type="checkbox" class="radio ms-3">
                        </td>
                        <td class="col">Chelly Ombiga</td>
                        <td class="col">HR</td>
                        <td class="col">148</td>
                        <td class="col">89</td>
                        <td class="col">13, 172</td>
                        <td class="col">0</td>
                        <td class="col">13, 172</td>
                        <td class="col">Printed</td>
                        <td class="col-2">
                            <button class="pr-1 btn btn-sm btn-primary"><i class="fs bi-pencil-square"></i></button>
                            <button class="pr-1 btn btn-sm btn-success"><i class="fs bi-printer"></i></button>
                        </td>
                    </tr>
                    <tr class="table-hover align-bottom">
                        <td class="col">
                            <input type="checkbox" class="radio ms-3">
                        </td>
                        <td class="col">Yujin Yeongssil</td>
                        <td class="col">IT Support</td>
                        <td class="col">129</td>
                        <td class="col">80</td>
                        <td class="col">10, 320</td>
                        <td class="col">0</td>
                        <td class="col">10, 320</td>
                        <td class="col">Not Printed</td>
                        <td class="col-2">
                            <button class="pr-1 btn btn-sm btn-primary"><i class="fs bi-pencil-square"></i></button>
                            <button class="pr-1 btn btn-sm btn-success"><i class="fs bi-printer"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </nav>
        </div>

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