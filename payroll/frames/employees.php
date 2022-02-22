<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>PBS</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.bundle.min.js / bootstrap.bundle.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/splash.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="script" href="../js/import.js">
</head>
<body>
    <div class="container">
       
       <div class="row">
           <div class="col-9 py-1 mb-3">
           <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Add Employees</li>
                </ol>
            </nav>
           </div>
           
           <div class="col-3 py-1 mb-3">
                <input type="text mr-0 pr-0" class="text" id="search" placeholder=" Search...">
                <button type="submit" class="btn btn-sm btn-primary"> <i class="fs-5 bi-search"></i></button>
                <button type="submit" class="btn btn-sm btn-primary"> <i class="fs-5 bi-filter"></i></button>
            </div>      
       </div>
       
       <form class="py-5" action="../controllers/add_Emp.php" method="post">
        <div class="mb-5">
            <h5> Add New Employee </h5>
        </div>
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Role</label>
          <input type="text" class="form-control" name="role" required>
        </div>

          <div class="mb-3">
            <label for="Select" class="form-label">Type</label>
            <select id="Select" class="form-select" name="type" required>
              <option value="reg">Regular Rate</option>
              <option value="comm">Commission Based</option>
            </select>
          </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
       
    </div>

    <!-- Modals -->
    <!-- Modal -->
<div class="modal fade" id="addEmpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Add Employee
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
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