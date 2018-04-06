<?php

public function login(){
	/* Start session to access $_SESSION global array */
	session_start();

	if( $_SESSION['logged_in'] == null ){
    	require 'db.php'; 
	}
	else{
    	header("location: profile.php");
	}
	/* Assign variables from HTML form */
	$user_id = $_POST["uid"];
	$pword = $_POST["pwd"];

	if( $user_id && $pword ){
		/* Search and print record. mysqli_query returns mysqli object, needing conversion to PHP array with mysqli_fetch_array. */
    	$result = mysqli_query($connect, "SELECT * FROM $table WHERE uid = '$user_id'");
    	$row = mysqli_fetch_array($result);

	    if( $row{'pwd'} != null ){						
    	    $_SESSION['id'] = $row{'id'};
        	$_SESSION['first'] = $row{'first'};
	        $_SESSION['last'] = $row{'last'};
    	    $_SESSION['uid'] = $row{'uid'};
        	$_SESSION['password'] = $row{'pwd'};
       		$_SESSION['logged_in'] = true;
        
	        header("location: profile.php");
		}
		else{
			if( $row{'pwd'} != $pword ){
        		echo "index.php: Error: password incorrect"."<br>";
    		}
		}
	}
}
?>



