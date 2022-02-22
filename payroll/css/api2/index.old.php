<?php
// Load the database configuration file
include_once 'db_conn.php';

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Calls data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- Bootstrap library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">   
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<style type="text/css">
        html{

        }

        body{

            margin-left: 5%;
            margin-right: 5%;

        }

        thead{
            font-size: 10px;
            font-weight: 100;
            text-align: center;
        }

        label{
            text-align: center;
        }

        td{
            font-size: 12px !important;
        }

        .import-toggle{
            margin-bottom: 1vw;
        }

</style>
<body>



<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="row">
    <!-- Import link -->
    <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success import-toggle" onclick="formToggle('importFrm');"><i class="fa fa-plus"></i>  Import</a>
        </div>
    </div>
    <!-- CSV file upload form -->
    <div class="col-md-12 import-toggle" id="importFrm" style="display: none;">
        <form action="importData.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary btn-sm" name="importSubmit" value="IMPORT">
        </form>
    </div>

    <!-- Data list table --> 
    <table class="table table-striped table-bordered table-responsive">
        <thead class="thead-dark">
            <tr>
                            <th scope='col'><label>Call ID</label></th>
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
                            <th scope='col'> <label>Save Edit</label> </th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Get member rows
        $result = $db->query("SELECT * FROM calls ORDER BY id DESC");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
        ?>
            <tr>
                <?php echo"
                    <td>" . $row['call_id']."</td>
                    <td>" . $row['call_date']."</td>
                    <td>" . $row['talk_time']."</td>
                    <td>" . $row['cx_phone']."</td>
                    <td> 12345 </td>
                    <td> US </td>
                    <td>" . $row['answer_time']."</td>
                    <td> 0 </td>
                    <td> answered </td>
                    <td> sales </td>
                    <td> This Name </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td scope='col'> <button name='reg_user' class='btn btn-sm btn-dark'> save</button> </td>

                    "
                    ?>
            </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>