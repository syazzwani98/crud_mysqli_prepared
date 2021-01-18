<?php
//Step 1. Connect to the database.
//Step 2. Handle connection errors
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	//The mysqli_real_escape_string() function escapes special characters in a string for use in an SQL statement.
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);	
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
	} else {	
		//Step 3. Execute the SQL query.
		//updating the table
		//Prepared Statement: Prepare, bind, execute
		
		$sql = "UPDATE users SET name=?,age=?,email=? WHERE id=?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ssss", $name, $age, $email, $id);
		$stmt->execute();
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
		
		//Step 5: Freeing Resources and Closing Connection using mysqli
		$stmt->close();
		$mysqli->close();
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$age = $res['age'];
	$email = $res['email'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	<!-- The updated form data entered by user is sent using the HTTP POST method -->
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Age</td>
				<td><input type="text" name="age" value="<?php echo $age;?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $email;?>"></td>
			</tr>
			<tr>
				<!-- send hidden data, id using GET method -->
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
