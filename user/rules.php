<?php  
	
	session_start();
	if($_SESSION['user']=="")
	{
		header('Location:index.php');
	}

?>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>USER</title>
	<meta name="author" content="AZHAR" />
	<!-- Feather Icons -->
	<link rel="stylesheet" type="text/css" href="fonts/feather/style.css">
	<!-- General demo styles & header -->
	<link rel="stylesheet" type="text/css" href="css/demo.css" />
	<!-- Component styles -->
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<link rel="stylesheet" type="text/css" href="css/mods.css">
	<link rel="stylesheet" type="text/css" href="user.css">
	<script type="text/javascript" src="../admin/jquery-2.1.4.min.js"></script>
	<script src="js/modernizr.custom.js"></script>
</head>

<?php  

	session_start();
	$currentuser = $_SESSION['user'];

	if($_SESSION['user']=='')
	{
		header("Location:index.php");
	}

	//echo "<div class='head'>WELCOME &nbsp; <span class='username'>" . $currentuser . "</span></div><br>";

	require "connectdb.php";
	mysql_select_db("db_tow2015");

	$sql = "SELECT CORRECTANS FROM TUX_PARTICIPANTS WHERE TID='$currentuser';";
	$query = mysql_query($sql,$mysql_conn);
	if(!$query)
	{
		echo "ERROR";
	}

	$row = mysql_fetch_assoc($query);

	$current = $row['CORRECTANS'];

	$result = 0;

	for($i=0;$i<strlen($current);$i++)
	{
		if($current[$i] == '1')
		{
			$result = $result + 1;
		}
	}

	echo "Congratulations! You've answered " . $result . "questions correctly";

	$sql = "UPDATE TUX_PARTICIPANTS SET RESULT = '$result' WHERE TID = '$currentuser';";
	$query = mysql_query($sql,$mysql_conn);
	if(!$query)
	{
		echo "ERROR";
	}

	//session_unset();
	//session_destroy();

?>

</html>