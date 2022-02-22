<?php

var_dump($_POST['Import']);
 if(isset($_POST["Import"])){
    
   

        $servername = "localhost";
        $username = "root";
        $password = "Altria123!@#";
        $db = "auto_api";
        try {
           
            $con = mysqli_connect($servername, $username, $password, $db);
             echo "Connected successfully"; 
            }
        catch(exception $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }

         $filename=$_FILES["file"]["tmp_name"];   
         if($_FILES["file"]["size"] > 0)
         {

        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {
             $sql = "INSERT into calls (answer_time, call_date, talk_time, cx_phone, call_id, acct_id) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."')";
                   $result = mysqli_query($con, $sql);
                   var_dump($result);
        if(!isset($result))
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"\"
              </script>";    
        }
        else {
            echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"\"
          </script>";
        }
           }

      
           fclose($file);  
     }
  }
  else{
    echo "import not set";
  }   

  function get_all_records(){
    $servername = "localhost";
        $username = "root";
        $password = "Altria123!@#";
        $db = "auto_api";
        try {
           
            $con = mysqli_connect($servername, $username, $password, $db);
             //echo "Connected successfully"; 
            }
        catch(exception $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
    $Sql = "SELECT * FROM calls";
    $result = mysqli_query($con, $Sql);  
    if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead><tr><th>API DATA</th>
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
                        </tr></thead><tbody>";
     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr><td>" . $row['emp_id']."</td>
                   <td>" . $row['firstname']."</td>
                   <td>" . $row['lastname']."</td>
                   <td>" . $row['email']."</td>
                   <td>" . $row['reg_date']."</td></tr>";        
     }
    
     echo "</tbody></table></div>";
     
} else {
     echo "you have no records";
}
echo "<script>
function formToggle(myTable){
    var element = document.getElementById(ID);
    if(element.style.display === 'none'){
        element.style.display = 'block';
    }else{
        element.style.display = 'none';
    }
}
</script>
";
}

 ?>