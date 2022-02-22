<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">   
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="style/admin.css" />

</head>
<body>
    <div id="wrap">
        <div class="container">
            
                <form class="form-horizontal form-control"  action="functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
                    <div class="form">
                        <fieldset>
                        <!-- Form Name -->
                        <div class="form-row">
                            <div class="col-md-5"></div>
                            <legend class="col-md-2">Upload API File</legend>
                            <div class="col-md-5"></div>
                        </div>
                        
                        <!-- File Button -->
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4"></div>
                                <div class="col-md-3 row">
                                    <input type="file" name="file" accept=".csv" id="file" class="form-control-sm">
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" id="submit" name="Import" value="Import" class="btn btn-primary btn-sm button-loading" data-loading-text="Loading...">Import</button>
                                </div> 
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                    </fieldset>
                    </div>
                    
                </form>
        
                <?php
                require 'records.php';
                get_all_records();
                ?>
        </div>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $("#upload_excel").on("submit", function () {

        $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
                $("#response").addClass("error");
                $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</html>