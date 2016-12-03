
<Body>
Welcome <?php echo $_POST["name"];?><br>

<?php
$servername = "localhost";
$username = "root";
$password = "Yaygroup_19";
$dbname = "hockeypool";

$user = $_POST["name"];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
else {
	$sql = "SELECT name FROM nhl_player_statistics WHERE goals > '" . $user . "'";
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result) > 0)
	{
		$count = 1;
		while($row = mysqli_fetch_row($result))
		{
			echo $row[0] .'<br>';
			$count++;
		}
	
	}
	else {
	
		echo "Thanks Tyrone";
	}
	
	
}
$conn->close();

?>
</Body>