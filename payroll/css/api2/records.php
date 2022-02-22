<?php


        $servername = "localhost";
        $username = "root";
        $password = "Altria123!@#";
        $db = "auto_api";
        try {
           
            $con = mysqli_connect($servername, $username, $password, $db);
            /* echo "Connected successfully"; */
            }
        catch(exception $e)
            {
            echo "Connection failed: " . $e->getMessage();
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
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped'>
             <thead><tr>	
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
         echo "<tr>
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


              </tr>";        
     }
    
     echo "</tbody></table></div>";
     
} else {
     echo "you have no records";
}
}

?>