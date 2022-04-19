<?php
session_start();
// Load the database configuration file
include_once 'db_conn.php';

$emp_type = "Regular";
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

function cleanString($string) {
    $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
 
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
 }

if(isset($_POST['importSubmit'])){


    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){

        //init batch_id

        $pay_sched_stmt = $db->prepare("INSERT INTO payroll_batch (start_date, end_date, type) VALUES (?,?,?)");
        $pay_sched_stmt->bind_param("sss", $start_date, $end_date, $emp_type);
        
        $pay_sched_stmt->execute();

        //set batch id to session


        $batch_id_sql = $db->query("SELECT MAX(batch_id) AS currentBatchID FROM payroll_batch");
        if($batch_id_sql->num_rows > 0){
            while($row = $batch_id_sql->fetch_assoc()){       
                $batch_id = $row["currentBatchID"];
                $_SESSION['batch_id'] = $batch_id;
        }
        }
        else{
            $batch_id = 1;
            $_SESSION['batch_id']  = $batch_id;
        }
            
        //Prepare and bind statements
        $reg_pay_stmt = $db->prepare("INSERT INTO reg_pay (emp_id, batch_id, basic_hrs_pay, nds_pay, allow_pay, dispute, spl_hol_pay, reg_hol_pay, prem_hol_pay, ot_pay, net_pay, gross_pay) VALUES (?,?,?,?,?,?,?,?,?,?,?,?) ");
        $reg_pay_stmt->bind_param("isssssssssss", $emp_id, $batch_id, $basic_hrs, $nds_pay, $allow, $dispute, $spl_hol, $reg_hol, $prem_hol, $ot, $net_pay, $gross);

        $deductions_stmt = $db->prepare("INSERT INTO deductions(emp_id, batch_id, sss, phic, pagibig, others, ca, total_deductions) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $deductions_stmt->bind_param("isssssss", $emp_id, $batch_id, $sss, $phic, $pagibig, $others, $ca, $total_deductions);

        $reg_rate_stmt = $db->prepare("INSERT INTO reg_rate(emp_id, batch_id, daily_rate, hrly_rate, allow_hr_rate, nd_rate) VALUES (?, ?, ?, ?, ?, ?)");
        $reg_rate_stmt->bind_param("isssss", $emp_id, $batch_id, $daily_rate, $hrly_rate, $allow_hrly_rate, $nd_rate);

       # $update_reg_rate_stmt = $db->prepare("UPDATE reg_rate SET emp_id = ?, daily_rate = ?, hrly_rate = ?, allow_hr_rate = ?, nd_rate = ? WHERE emp_id = ?");
        #$update_reg_rate_stmt->bind_param("issss", $emp_id, $daily_rate, $hrly_rate, $allow_hrly_rate, $nd_rate);
        
        $reg_manhour_stmt = $db->prepare("INSERT INTO reg_manhour(emp_id, batch_id, total_worked_hrs, total_nd_hrs, reg_hol_hrs, ot_hrs, spl_hol_hrs, prem_hrs) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $reg_manhour_stmt->bind_param("isssssss", $emp_id, $batch_id, $total_worked_hrs, $total_nd_hrs, $reg_hol_hrs, $ot_hrs, $spl_hol_hrs, $prem_hrs);
        
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $fullname                   = $line[0];              
                $role                       = $line[1];
                $daily_rate                 = $line[2];
                $hrly_rate                  = $line[3];
                $allow_hrly_rate            = $line[4];
                $nd_rate                    = $line[5];                    
                $total_worked_hrs           = $line[6];
                $total_nd_hrs               = $line[7];
                $reg_hol_hrs                = $line[8];
                $ot_hrs                     = $line[9];
                $spl_hol_hrs                = $line[10];
                $prem_hrs                   = $line[11]; 
                $basic_hrs                  = $line[12];   //reg_pay
                $nds_pay                    = $line[13];   //reg_pay
                $allow                      = $line[14];   //reg_pay
                $dispute                    = $line[15];   //reg_pay
                $spl_hol                    = $line[16];   //reg_pay
                $reg_hol                    = $line[17];   //reg_pay
                $prem_hol                   = $line[18];   //reg_pay
                $ot                         = $line[19];   //reg_pay
                $gross                      = $line[20];   //reg_pay
                $sss                        = $line[21];
                $phic                       = $line[22];
                $pagibig                    = $line[23];
                $others                     = $line[24];
                $ca                         = $line[25];
                $total_deductions           = $line[26];
                $net_pay                    = $line[27];


                    // $queryNameExists = $db->query("SELECT id FROM regloyees WHERE full_name = '" .$fullname. "' ");
                    // var_dump($queryNameExists);
                    $nameExistResult = $db->query("SELECT id FROM employees WHERE fullname = '" .$fullname. "' ");
                    if ($nameExistResult->num_rows > 0) {
                        // output data of each row
                        while($row = $nameExistResult->fetch_assoc()) {
                            $emp_id = "  $row[id] ";
                        }
                        echo "Existing employees ID:  "; 
                        echo $emp_id; 
                       
                        $reg_pay_stmt->execute();
                        $deductions_stmt->execute();
                        $reg_rate_stmt->execute(); //previously update rate stmt
                        $reg_manhour_stmt->execute();
                    }
                       else {
                        $insertNewNameQuery = "INSERT INTO employees (fullname, role, emp_type) VALUES ('$fullname', '$role', '$emp_type') ";
                        if (mysqli_query($db, $insertNewNameQuery)) {
                            echo "New name inserted successfully";

                            $querySelectName = $db->query("SELECT id FROM employees WHERE fullname = '$fullname' ");
                            if ($querySelectName->num_rows > 0) {
                                // output data of each row
                                while($row = $querySelectName->fetch_assoc()) {
                                    $emp_id = " $row[id] ";
                                    echo "employees id: ";
                                    echo $emp_id;
                                    echo "<br>";
                                    $reg_pay_stmt->execute();
                                    $deductions_stmt->execute();
                                    $reg_rate_stmt->execute();
                                    $reg_manhour_stmt->execute();
                                }
                              }

                              //insert users for account log ins after inserting new name records in db
                              $dotName = str_replace(' ', '.', $fullname); 
                              $usernameUpper = str_replace(',', '', $dotName);
                              $username = strtolower($usernameUpper);
                              $inseryUser = "INSERT INTO users (username, emp_id, init_pass) VALUES ('$username', $emp_id, '@ltriapay') ";
                              if (mysqli_query($db, $inseryUser)) {
                                  echo $username;
                              }
                              header("Location: ../view/import/regular.php");
                        
                            } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                          }     
                    }     
        } //end while
            $db->close();
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
            
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
    // Redirect to the listing page
    header("Location: ../view/import/regular.php.$qstring");
}

