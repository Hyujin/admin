<?php
// Load the database configuration file
include_once 'db_conn.php';

$emp_type = "Sales";
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

            //init pay batch 


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

        $type = "Sales";

           //Prepare and bind statements
        $sales_pay_stmt = $db->prepare("INSERT INTO sales_pay (emp_id, batch_id, sales_pay, training_pay, allow_pay, dispute, spl_pay, reg_hol_pay, premium_pay, ot_pay, other_campaign_pay, gross_pay, net_pay) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?) ");
        $sales_pay_stmt->bind_param("issssssssssss",$emp_id, $batch_id, $sales, $training, $allow, $dispute, $spl_hol, $reg_hol, $prem_hol, $ot, $other_campaign_pay, $gross, $net);

        $deductions_stmt = $db->prepare("INSERT INTO deductions(emp_id, batch_id, sss, phic, pagibig, others, ca, total_deductions) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $deductions_stmt->bind_param("isssssss", $emp_id, $batch_id, $sss, $phic, $pagibig, $others, $ca, $total_deductions);

        $sales_manhour_stmt = $db->prepare("INSERT INTO sales_manhour(emp_id, batch_id, total_sales, training_days, reg_hol_hrs, total_num_days, spl_hrs, prem_hrs) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sales_manhour_stmt->bind_param("isssssss", $emp_id, $batch_id, $total_sales, $training_days, $reg_hol_hrs, $total_num_days, $spl_hrs, $prem_hrs);
        
        $sales_rate_stmt = $db->prepare("INSERT INTO sales_rate(emp_id, batch_id, training_rate, sales_rate, allow_hr_rate, nd_rate) VALUES (?, ?, ?, ?, ?, ?)");
        $sales_rate_stmt->bind_param("isssss", $emp_id, $batch_id, $training_rate, $sales_rate, $allow_hr_rate, $nd_rate);
        

            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $fullname                   = $line[0];              
                $role                       = $line[1];
                $training_rate              = $line[2];
                $sales_rate                 = $line[3];
                $allow_hr_rate              = $line[4];
                $nd_rate                    = $line[5];                    
                $total_sales                = $line[6];
                $training_days              = $line[7];
                $reg_hol_hrs                = $line[8];
                $total_num_days             = $line[9];
                $spl_hrs                    = $line[10];
                $prem_hrs                   = $line[11]; 
                $sales                      = $line[12];   //pay
                $training                   = $line[13];   //pay
                $allow                      = $line[14];   //pay
                $dispute                    = $line[15];   //pay
                $spl_hol                    = $line[16];   //pay
                $reg_hol                    = $line[17];   //pay
                $prem_hol                   = $line[18];   //pay
                $ot                         = $line[19];   //pay
                $gross                      = $line[20];   //pay
                $sss                        = $line[21];
                $phic                       = $line[22];
                $pagibig                    = $line[23];
                $others                     = $line[24];
                $ca                         = $line[25];
                $total_deductions           = $line[26];
                $net                        = $line[27];
                $other_campaign_pay         = $line[28];


                    // $queryNameExists = $db->query("SELECT id FROM employees WHERE fullname = '" .$fullname. "' ");
                    // var_dump($queryNameExists);
                    $nameExistResult = $db->query("SELECT id FROM employees WHERE fullname = '" .$fullname. "' ");
                    if ($nameExistResult->num_rows > 0) {
                        // output data of each row
                        while($row = $nameExistResult->fetch_assoc()) {
                            $emp_id = "  $row[id] ";
                        }
                        echo "Existing Employee ID:  "; 
                        echo $emp_id; 
                    
                        $sales_pay_stmt->execute();
                        $deductions_stmt->execute();
                        $sales_rate_stmt->execute();
                        $sales_manhour_stmt->execute();
                    }
                       else {
                        $insertNewNameQuery = "INSERT INTO employees (fullname, role, emp_type) VALUES ('$fullname', '$role', '$type') ";
                        echo ($insertNewNameQuery);
                        if (mysqli_query($db, $insertNewNameQuery)) {
                            echo "New name inserted successfully";
                            $querySelectName = $db->query("SELECT id FROM employees WHERE fullname = '$fullname'  ");
                            if ($querySelectName->num_rows > 0) {
                                // output data of each row
                                while($row = $querySelectName->fetch_assoc()) {
                                    $emp_id = "  $row[id] ";
                                    $sales_pay_stmt->execute();
                                    $deductions_stmt->execute();
                                    $sales_rate_stmt->execute();
                                    $sales_manhour_stmt->execute();
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
}

 //Redirect to the listing page
header("Location: ../view/import/sales.php".$string);