
<?php
/* Login script for MySQL database */
$host = "localhost";
$username = "root";
$password = "Welcome831";
$database = "db";
$table = "users";

/* Connect to mySQL */
$connect = mysqli_connect( $host, $username, $password, $database )
		or die("db.php: Unable to connect to MySQL");
?>



