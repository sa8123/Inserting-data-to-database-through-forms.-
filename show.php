<!DOCTYPE html>
<html lang = 'en'>

<head>
  <title>Information table </title>
  <meta charset="UTF-8">
<style>
table
{
  border: 12px solid green;
  border-radius: 20px 20px;
 
  width: 80%;
}
th
{
  background: #F2A5E1;
  color: red;
  text-align: center;
  border: solid;
  border-radius: 15px;	
  padding: 12px;
}
td
{
  text-align: center;
  border: solid;
  border-radius: 20px;	
  padding: 12px;
}
 .button {
    background-color: #9AF4F3;
    border: none;
    color: black;
    border-radius: 20px;
    padding: 15px 32px;
    text-align: center;
    display: inline-block;
    font-size: 16px;
}
.button:hover {
    background-color: #EB71F1;
    color: black;
}
</style>
</head>
<body>

<?php

// Function with all definitions
function makeList() 
{

    $sortby = $_GET['sortby'];

    if ($sortby == "") 
    {
        $sortby = "ID";
    }

	
    if (($sortby != "ID") && ($sortby != "FirstName") && ($sortby != "LastName") && ($sortby != "Email"))
    { 
        exit; 
    }

    //Connection Initialization to SQL server
    $connection = new PDO("mysql:host=mysql.truman.edu;dbname=sa8123CS315", "sa8123", "vohxochi");

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //For this table SN is and auto increment ID
    $statement = $connection->prepare("SELECT ID, FirstName, LastName, Email FROM Information ORDER BY $sortby");

    $statement->execute();

    echo <<<END

    <h3>Personal Information</h3>
        <hr />

<br/>
    <form action="insertion.php">
        <input class="button" type="submit"  value="Go Back"/>
    </form>
   <br/>
   <p>The given information has been sorted by $sortby:</p>
   <br/>	


    <table >
    <tr>
      <th><a href="show.php?sortby=ID">ID</a></th>
      <th><a href="show.php?sortby=FirstName">FirstName</a></th>
      <th><a href="show.php?sortby=LastName">LastName</a></th>
      <th><a href="show.php?sortby=Email">Email</a></th>
    </tr>

   
END;

   
    while ( $row = $stmtement->Fetch(PDO::FETCH_ASSOC))
    {

	//This loop sets all the value of the column in given querry
	//Also, mysql_fetch_row returns a regular positional array
	// instead of an associative array.
      
      print "<tr><td>{$row['ID']}</td><td>{$row['FirstName']}</td><td>{$row['LastName']}</td><td>{$row['Email']}</td><td>";
    }
    print "</table>";


}


makeList();
?>
</body>
</html>
