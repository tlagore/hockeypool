<?php
$user = "user_id";
$value = "Tyrone";
setcookie($user, $value, time() + 1200, "/");

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
		$server = "localhost";
		$db = "hockeypool";
		$username = "root";
		$pass = "Yaygroup_19";
		//$command = "SELECT * FROM "
		
		$conn = new mysqli($server, $username, $pass, $db);
		if($conn->connect_error)
		{
			die("cannot connect to server. " . $conn->connect_error);
		}else{
			echo "Connected Successfully";
		}
	?>
	</div>
</div>