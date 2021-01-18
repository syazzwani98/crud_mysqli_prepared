<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//Step 1. Connect to the database.
//Step 2. Handle connection errors
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	//The mysqli_real_escape_string() function escapes special characters in a string for use in an SQL statement.
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		
	// checking empty fields
	if(empty($name) || empty($age) || empty($email)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
		
		//Step 3. Execute the SQL query.	
		//insert data to database	
		//Prepared Statement: Prepare, bind, execute
		$stmt = $mysqli->prepare("INSERT INTO users(name,age,email) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $name, $age, $email);
		$stmt->execute();
		
		//Step 4. Process the results.
		//display success message & the new data can be viewed on index.php
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	
		//Step 5: Freeing Resources and Closing Connection using mysqli	
		$stmt->close();
		$mysqli->close();
	}
}
?>
</body>
</html>
