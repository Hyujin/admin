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
                    <!-- CONTENT AREA -->
                   <iframe src="../frames/importComm.php" height="100%" width="100%"  id="home-container">
                    
                
                    </iframe>
                    <!-- END OF CONTENT AREA -->
                </div>
            </div>
        </div>

    
    
     <!-- Bootstrap JS -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
         <!-- Load React. -->
      <!-- Note: when deploying, replace "development.js" with "production.min.js". -->
      <script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
      <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>
    
      <!-- Load our React component. -->
      <script src="like_button.js"></script>
      <script>
            var videoElement = document.getElementById('splash');
            videoElement.stop();
            videoElement.removeAttribute('src'); // empty source
            videoElement.load();
            alert("reading");
    </script>
    </body>
    
    </html>