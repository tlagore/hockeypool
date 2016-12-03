<Title>TEST	</Title>
<Body>
<?php
$servername = "localhost";
$username = "root";
$password = "Yaygroup_19";
$dbname = "hockeypool";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
else {
	$sql = "SELECT player FROM nhl_player_statistics WHERE goals > 30 ";
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_row($result))
		{
			echo $row . '<br>';
		}
		
	}
	else {
		
	echo "Thanks Tyrone";
	}
}
	
?>
</Body>
<form action="test.php" method="post">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>