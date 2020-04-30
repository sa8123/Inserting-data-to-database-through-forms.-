<?php
	$connection = mysqli_connect('mysql.truman.edu', 'sa8123', 'vohxochi');
	if(!$connection)
	{
		echo "Connection cannot be established";
	}

	if(!mysqli_select_db($connection, 'sa8123CS315'))
	{
		echo "Database cannot be selected";
	}

	$FName = $_POST['FirstName'];
	$LName = $_POST['LastName'];
	$Email = $_POST['Email'];

	// Name of the table is Information. Don't need to insert ID 
	// since it is autoincremented. 
	$sql = "INSERT INTO Information(FirstName, LastName, Email) VALUES ('$FNAME', '$LName', '$Email')";
	if(!mysqli_query($connection, $sql))
	{
		echo "Data not inserted!";
	}
	else
	{
		echo "Data inserted!";
	}
?>