<!DOCTYPE html>
<html lang = 'en'>

<head>
  <title>PHP and Database</title>
  <meta charset="UTF-8">
<style>
.button {
    background-color: #9AF4F3;
    border: none;
    color: black;
    border-radius: 20px;
    padding: 15px 32px;
    text-align: left;
    display: inline-block;
    font-size: 16px;
}
.field {
    background-color: #F27876;
    border: none;
    color: black;
    border-radius: 12px;
    padding: 15px 32px;
    text-align: left;
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

include("dbInfo.inc");

//Print Function
function print_form() 
{
    $time = time();
    echo <<<END

        <form action="$_SERVER[PHP_SELF]" method="post">

        <h3>SportsMan records</h3>
        <h4>Input Form</h4>
        <hr />
	

        <input type="hidden" name="Time" value="$time">
        
        <br /><br/>Name: <br />
        <input class="field" type="text" name="Name" size="40">

	<br /> <br/>Age: <br />
        <input class="field" type="text" name="Age" size="3">

        <br /><br />Sports:<br />
        <input class="field" type="text" name="Sports" size="60">

        <br /><br />Year Joined: <br />
        <input class="field" type="text" name="year" size="4">
        <br /><br />

        <input type="hidden" name="stage" value="process">
        <input class="button" type="submit" value="Enter">

        </form>

        <br/>

        <form action="report.php?sortby=SN">
            <input class="button" type="submit" value="Display the List"/>
        </form>
END;
}

// HTML form function
function process_form() 
{
    $Name = $_POST['Name'];
    $Age = $_POST['Age'];
    $Sports = $_POST['Sports'];
    $year = $_POST['year'];

    try 
    {
        $conn = new PDO("mysql:host=mysql.truman.edu;dbname=bk5782CS315", "bk5782", "aeyiedac");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO games (SN, Name, Age, Sports, year)
                                VALUES (NULL, :Name, :Age, :Sports, :year)");
        $stmt->bindParam(':Name', $Name);
	$stmt->bindParam(':Age', $Age);
        $stmt->bindParam(':Sports', $Sports);
        $stmt->bindParam(':year', $year);

        $stmt->execute();
    }
    catch(PDOException $e)
    {
        echo "Something went wrong: " . $e->getMessage();
    }

// Connection end
$conn = null;
    
print "<br />The given information has been listed in my Sports Table";
print "<br />Please <a href=\"report.php?sortby=SN\">click here</a> to look at the table.";

}


if (isset($_POST['stage']) && ('process' == $_POST['stage'])) {
    process_form();
} else {
    print_form();
}

?>

</body>
</html>
