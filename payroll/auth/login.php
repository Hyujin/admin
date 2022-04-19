<?php
session_start();
?>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Altria Payroll</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="container" >
  <div class="float-left bg-primary">
    <img class="page-illustration" src="../res/woman-on-a-phone.svg" height="250vw">
    <div class="page-title"> ALTRIA PAYROLL</div>
    <div class="page-subtitle"> for admin </div>
  </div>

  <div class="float-right">
    <div class="login-container">
    <div class="login-form">
      <img class="page-altria-logo mb-4" src="../res/altria.png" height="55px">
      
       <form class="form-group" action="../controllers/login.php onSubmit="return validate();">

        <div class="log-in-text text-center mb-2">Please log in to access Altria Payroll </div>

        <?php 
        if(isset($_SESSION["errorMessage"])) {
        ?>
        <div class="error-message"><?php  echo $_SESSION["errorMessage"]; ?></div>
        <?php 
        unset($_SESSION["errorMessage"]);
        } 
        ?>

        <label id="user_info" class="mx-3 form-label">Username</label><br>
        <input id="user_name" class="mx-3 mb-2 form-control" name="username" type="text"><br>

        <label id="password_info" class="mx-3 form-label">Password</label>
        <input id="password" class="mx-3 mb-5 form-control" name="password" type="password">
        <button type="submit" name="login" value="Login" class="mx-3 btn btn-lg btn-primary form-control">Log in</button>
            
    </form>
    </div>
    <footer class="footer">
      <div class="text-center footer">
        <p><small>Altria Call Center OPC. All Rights Reserved  &#169; 2022 </small></p>
      </div>
    </footer>
  </div>
  
  </div>

</div>
</body>
</html>