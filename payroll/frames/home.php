<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>PBS</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/splash.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="script" href="../js/import.js">
</head>
<body>
    <div class="container">
       
       <div class="row">
           <div class="col-4 py-2 mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">Home</li>
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
         
           <div class="col-4 py-2 mb-3">
               <input type="text mr-0 pr-0" class="text" id="search" placeholder=" Search...">
               <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i></button>
           </div>
       </div>
        <div class="row">
            <table class="table table-responsive table-light">
                <thead class="table-primary">
                    <th class="col">Schedule</th>
                    <th class="col">Total Pay</th>
                    <th class="col">Printed Payslip</th>
                    <th class="col">Printed Paycheck</th>
                </thead>
                <tbody>
                    <tr class="table-hover align-bottom">
                        <td class="col">2021-11-15</td>
                        <td class="col">230, 320</td>
                        <td class="col">87</td>
                        <td class="col">23</td>
                        
                    </tr>
                    <tr class="table-hover align-bottom">

                        <td class="col">2021-12-01</td>
                        <td class="col">232, 600</td>
                        <td class="col">87</td>
                        <td class="col">20</td>
                       
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
</body>
</html>