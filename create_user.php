<?php
session_start();
/* db.php resets connection and loses session information */
if( isset( $_SESSION['logged_in'] ) ){
    header("location: profile.php");
}
else if( isset($_POST["first"]) ){                        
    require 'db.php';   

    /* Assign variables from HTML form */
    $first_name = $_POST["first"];
    $last_name = $_POST["last"];
    $user_id = $_POST["uid"];
    $pword = $_POST["pwd"];
                        
    /* Insert new user into database */
    $result = mysqli_query($connect, "INSERT INTO $table (first, last, uid, pwd) 
        VALUES ('$first_name', '$last_name', '$user_id', '$pword');")
        or die("<br>Could not insert data into $table<br>");
                            
    /* Search and print record */   
    $result = mysqli_query($connect, "SELECT * FROM $table WHERE uid='$user_id'");
    $row = mysqli_fetch_array($result);

    // Create new directory for user images
    // mkdir('assets/uploads/'.$user_id.'/');
    shell_exec('mkdir assets/uploads/'.$user_id);
 
    // Re-direct to login page 
    header("location:profile.php");
}             
?>



