
<?php
/* Login script for MySQL database */
$host = "localhost";
$username = "brandon";
$password = "Welcome123";
$database = "db";
$table = "users";

/* Connect to mySQL */
$connect = mysqli_connect( $host, $username, $password, $database )
		or die("db.php: Unable to connect to MySQL");
?>
