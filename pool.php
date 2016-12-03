<?php
$user = "user_id";
$value = "Tyrone";
setcookie($user, $value, time() + 1200, "/");

//asdasd
//changes
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
		$conn = getConn("localhost", "root", "Yaygroup_19", "hockeypool");
		if($conn->connect_error)
		{
			die("cannot connect to server. " . $conn->connect_error);
		}else{
			echo "Connected Successfully";
		}
	?>
	</div>
</div>