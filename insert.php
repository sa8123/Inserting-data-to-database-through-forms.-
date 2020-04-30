<?php
$connection = mysql_connect('mysql.truman.edu', 'sa8123', 'vohxochi'); // Establishing Connection with Server
$db = mysql_select_db("sa8123CS315", $connection); // Selecting Database from Server
if(isset($_POST['Insert']))
{ 
	$FName = $_POST['FirstName'];
	$LName = $_POST['LastName'];
	$Email = $_POST['Email'];
	if($name !=''||$email !='')
	{

	$query = mysql_query("insert into Information(Firstname, Lastname, Email) values ('$name', '$email', '$contact', '$address')");
echo "<br/><br/><span>Data Inserted successfully...!!</span>";
}
else{
echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
}
}
mysql_close($connection); 
?>
