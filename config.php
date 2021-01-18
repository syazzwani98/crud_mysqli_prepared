<?php
/*
// mysql_connect("database-host", "username", "password")
$conn = mysql_connect("localhost","root","root") 
			or die("cannot connected");

// mysql_select_db("database-name", "connection-link-identifier")
@mysql_select_db("test",$conn);
*/

/**
 * mysql_connect is deprecated
 * using mysqli_connect instead
 */
//Step 1: Connecting to a Database using MySQLi API (Object-Oriented approach)
// modify these variables for your installation
$databaseHost = 'localhost';
$databaseName = 'test';
$databaseUsername = 'user1';
$databasePassword = 'user1abc';


//MySQLi Object-Oriented approach
$mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

//MySQLi Procedural
//$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

//Step 2: Handling Connection Errors - mysqli 
// mysqli_connect_errno returns the last error code
if ( mysqli_connect_errno() ) {
	// die() is equivalent to exit()
	die( "Database connection failed: " . mysqli_connect_error() );	
	
}
echo "Database connected successfully <br>";


?>
