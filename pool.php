<?php
$user = "user_id";
$value = "Tyrone";
setcookie($user, $value, time() + 1200, "/");

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$owner_id = $_POST['inputUser'];
	$pool_id = $_POST['inputPool'];
}else
{
	//redirect user, they shouldn't be accessing this page directly!
	header('Location: /hockeypool/login.php');
	die();
}

?>

<head>
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<div class="container">
	 <div class ="row">
	 <h1>Stuff goes here</h1>
	 </div>
	 <div class = "row">

	 </div>	
	<?php 
		require 'lib.php';
		require 'sql_lib.php';
		
		$conn = getConn("localhost", "root", "Yaygroup_19", "hockeypool");
		$sql = $getTeam;
		
		if($conn->connect_error)
		{
			die("cannot connect to server. " . $conn->connect_error);
		}
		
		$result = $conn->query($sql);
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_row($result))
			{
				echo $row[0] . " " . $row[1] . " " . $row[2] . " " . $row[3] . " " . 
	 			$row[4] . " " . $row[5] . " " . $row[6] . " " . $row[7] . " " . 
	 			$row[8] . " " . $row[9] . " " . $row[10] . " " . $row[11] . "<br/>";
			}
		}
	?>
	</div>
</div>