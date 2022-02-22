
<?php
session_start();
// Load the database configuration file
include_once 'db_conn.php';

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Call data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'sent':
            $statusType = 'alert-success';
            $statusMsg = 'Records sent successfully to client.';
            break;
        case 'failed':
            $statusType = 'alert-danger';
            $statusMsg = 'Records failed to send.';
            break;
        case 'upd':
            $statusType = 'alert-success';
            $statusMsg = 'Row updated successfully.';
            break;
        case 'updfail':
            $statusType = 'alert-danger';
            $statusMsg = 'Records failed to send.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        case 'cleared':
            $statusType = 'alert-success';
            $statusMsg = 'Table successfully cleared';
            break;
        case 'save_loc_fail':
            $statusType = 'alert-danger';
            $statusMsg = 'System was unable to save table data to Altria database. If records were sent successfully to client, please try to manually save the record below by clicking the save to logs button';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">   
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="style/style3.css">

    <title>Rapid Inbound API</title>
  </head>
  <style type="text/css">
        html{
          margin: 0px !important;
  
        }

        body{

        }



        .container{
          max-width: 100%;
          background-color: white !important;
        

        }

        ul{
          margin-left: none !important;
          margin-right: none !important;
        }

        .row{

/*          margin-left: 5%;
            margin-right: 5%;*/
        }

        .button-container{

        }

        .float-right_1{
            background-color: red;
            margin-right: 1vw;
        }

        .float-right_2{
            background-color: blue;
        }

        thead{
            font-size: 10px;
            font-weight: 100;
            text-align: center;
        }

        label{
            text-align: center;
        }

        th{
          text-align: center !important;
        }

        td{
            font-size: 12px !important;
            text-align: center;
        }
        input{
          background-color: transparent;
          border: none;
        }

        .import-toggle{
            margin-bottom: 1vw;
        }

        .responsive {
          width: 100%;
          max-width: 400px;
          height: auto;
        }

        .modal{
          z-index: 1999 !important;
        }

        #double-scroll{
          width: 400px;
        }

</style>
  <body>

    <div class="nav-header">
      
  
      <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">


            <div class="site-logo">
              <a href="index.php" class="text-black"><span class="text-primary responsive"><img src="altria.png" height="70px;" width="120px;"></a>
            </div>

            <div class="col-12">
              <nav class="site-navigation text-right ml-auto " role="navigation">

                <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                  <li><a href="index.php" class="nav-link">API</a></li>
                  <li><a href="logs.php" class="nav-link">Logs</a></li>
                  <li><a href="logout.php" class="nav-link">Logout</a></li>
                </ul>
              </nav>

            </div>

            <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

          </div>
        </div>

      </header>

        </div>
      <!-- IMPORT TABLE -->



<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
<?php
 if (isset($_SESSION['result'])) {
    
    }
   else {
    
   }

   ?>
<div class="row">
    <!-- Import link -->
    <div class="col-md-6 head">
        <div class="float-left">
            <a href="javascript:void(0);" class="btn btn-success btn-sm import-toggle" onclick="formToggle('importFrm');"><i class="fa fa-plus"></i>  Import</a>
        </div>       
    </div>
    <div class="col-md-2">
         <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#modalwindow">
            <i class="fa fa-paper-plane" aria-hidden="true"></i>  SEND to CLIENT
          </button>
    </div>
    <div class="col-md-2">
            <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#logwindow">
            <i class="fa fa-save" aria-hidden="true"></i>   SAVE TO ALTRIA
          </button>
    </div>
    <div class="col-md-2">
             <form action="clear_table.php" method="post">
              <button type="submit" class="btn btn-danger btn-sm">
                <i class="fa fa-trash" aria-hidden="true"></i>  Clear Table
              </button>
          </form> 
    </div>
    <div class="col-md-1"></div>
  </div>
  <div class="row">
    
  
    <!-- CSV file upload form -->
    <div class="col-md-12 import-toggle" id="importFrm" style="display: none;">
        <form action="importData.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary btn-sm" name="importSubmit" value="IMPORT">
        </form>

    </div>
  </div>
    <!-- Data list table --> 
    <div class="double-scroll">
    
    <div class="table-responsive">
    <table class="table table-striped table-bordered" id="tableId">
        <thead class="thead-dark">
            <tr>
                            <th scope='col'><label>Call Id</label></th>
                            <th scope='col'><label>Call Date</label></th>
                            <th scope='col'><label>Talk Time</label></th>
                            <th scope='col'><label>CX Phone</label> </th>
                            <th scope='col'> <label>Zip Code</label> </th>
                            <th scope='col'> <label>Country</label> </th>
                            <th scope='col'> <label>Answer Time</label> </th>
                            <th scope='col'> <label>Hold Time</label> </th>
                            <th scope='col'> <label>Status of Call</label> </th>
                            <th scope='col'> <label>Order Status</label> </th>
                            <th scope='col'> <label>Agent Name</label> </th>
                            <th scope='col'> <label>Drop Time</label> </th>
                            <th scope='col'> <label>Wrap up Time</label> </th>
                            <th scope='col'> <label>Call Direction</label> </th>
                            <th scope='col'> <label>Acct ID</label> </th>
                            <th scope='col'> <label>Save Edit</label> </th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Get member rows
        $result = $db->query("SELECT * FROM calls_temp ORDER BY call_date DESC LIMIT 100");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
        ?>
            <tr>
                <?php echo"
                <form action='update.php' method='POST'>
                     <td scope='col'> <input type='text' id='fullname' size='8' name='call_date' class='hidden' value=\"" . $row["call_id"] . "\" required> </td>
                     <td scope='col'> <input type='text' id='fullname' size='17' name='call_date' class='hidden' value=\"" . $row["call_date"] . "\" required> </td>
                     <td scope='col'> <input type='text' id='order_id' size='4' name='talk_time' class='hidden' value=\"" . $row["talk_time"] . "\" required> </td>
                     <td scope='col'> <input type='text id='cx_phone' size='11' name='cx_phone' class='hidden' value=\"".$row['cx_phone']. "\" required></td>
                     <td scope='col'> <input type='text' id='disposition' size='5' name='zipcode' class='hidden' value='12345' required></td>
                     <td scope='col'> <input type='text' id='amount' size='2' name='amount' class='hidden' value='US' required></td>
                     <td scope='col'> <input type='text' id='date' size='3' name='answer_time' class='hidden' value=".$row['answer_time']."  required></td>
                     <td scope='col'> <input type='text' id='time' size='1' name='talk_time' class='hidden' value='0'  required></td>
                     <td scope='col'> <input type='text' id='status_of_call' size='7' name='stat_call' class='hidden' value=\"".$row['status_of_call']. "\" required></td>
                     <td scope='col'> <input type='text' id='order_status' size='18' name='order_stat' class='hidden' value=\"".$row['order_status']. "\"  required></td>
                     <td scope='col'> <input type='text' id='agemt_name' size='18' name='agent_name' class='hidden' value=\"" . $row["agent_name"] . "\"  required></td>
                     <td scope='col'> <input type='text' id='droptime' size='1' name='droptime' class='hidden' value='0'  required></td>
                     <td scope='col'> <input type='text' id='wraptime' size='1' name='wraptime' class='hidden' value='0'  required></td>
                     <td scope='col'> <input type='text' id='call_dir' size='5' name='call-direction' class='hidden' value=\"".$row['call_direction']. "\"  required></td>
                     <td scope='col'> <input type='text' id='acct_id' size='5' name='acct_id' class='hidden' value=".$row['acct_id']."  required></td>
                     <td scope='col'> <button name='reg_user' class='btn btn-sm btn-dark'> save </button> </td>
                </form>
                    "
                    ?>
            </tr>
        <?php } }else{ ?>
            <tr><td colspan="15">No record(s) found...</td></tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
    </div>



      <!-- END OF IMPORT TABLE -->



        <!-- CONFIRM SEND MODAL -->

        <!-- Modal -->
      <div class="modal fade" id="modalwindow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <!-- <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirm sending API data to client?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> -->
            <div class="modal-body">
              Confirm sending API data to client?
            </div>
            
            <div class="modal-footer">
              <form action="index.php" method="post" enctype="multipart/form-data">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </form>
              <form action="api.php" method="post" enctype="multipart/form-data">
                <button type="button" class="btn btn-primary btn-sm"><a href="api.php" target="_blank" id="closemodal" style="color: white" >Confirm</a></button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- CONFIRM SAVE LOCAL MODAL -->

      <div class="modal fade" id="logwindow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <!-- <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirm sending API data to client?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> -->
            <div class="modal-body">
              Confirm saving to logs?
            </div>
            
            <div class="modal-footer">
              <form action="index.php" method="post" enctype="multipart/form-data">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </form>
               <form action="save_local.php" method="post" enctype="multipart/form-data">
                <button type="button" class="btn btn-primary btn-sm"><a href="save_local.php" target="_blank" id="closeLog" style="color: white" >Confirm</a></button>
              </form>
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

      $(document).ready(function(){
        $('#double-scroll').doubleScroll();
      });

      $(function(){
        $('#closemodal').click(function(){
            $('#modalwindow').modal('hide');
        });
      });

        $(function(){
        $('#closeLog').click(function(){
            $('#logwindow').modal('hide');
        });
      });



    </script>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>