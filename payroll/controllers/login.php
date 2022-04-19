<?php
session_start();
include 'db_conn.php';


$username = $_POST['username'];
$password = $_POST['password'];

echo $username;

if ( !isset($_POST['username'], $_POST['password']) ) {
    // Could not get the data that should have been sent.
    exit('Please fill both the username and password fields!');
  }


if ($stmt = $db->prepare('SELECT username, password FROM admin WHERE username = ?')) {

    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

   if ($stmt->num_rows > 0) {
        $stmt->bind_result($username, $pwd);
        $stmt->fetch();

  
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if ($password == $pwd) {

            // Verification success! User has logged-in! 

            //determin if user or admin
            
            if($username == "admin"){
                // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['admin'] = "true";
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['username'] = $username;
            echo $username;
           header('Location: ../view/dashboard.php');
            $stmt->close();
            }
        } else {
            // Incorrect password
            echo 'Incorrect admin username and/or password!';
            $_SESSION['errorMessage'] = "Incorrect username and password";
            header('location: ../index.php?err=Incorrect username and/or password!');
            $stmt->close();
        }

    
}
else{
             echo 'No user found <br>';
            $_SESSION['errorMessage'] = "No user found. Please check your username and password";
          header('location: ../index.php?err=No result found!. Check your username and/or password!');
            $stmt->close();
}

} else {
    echo 'There was an error dbnecting to database. dbtact your Systems Administrator';
    $_SESSION['errorMessage'] = "There was an error dbnecting to database. dbtact your Systems Administrator";
   header('location: ../index.php?err=No result found!. Check your username and/or password!');
}

?>