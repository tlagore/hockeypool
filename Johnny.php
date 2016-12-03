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
	
}
$conn->close();
?>
</Body>
<form action="Johnny.php" method="post">
Name: <input type="number" name="Sort By"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>
<br>
<Body>
<?php 
/* sort table from server*/
function sortBy($sort, $table, $conn)
{
	$sql = "SELECT name FROM '" . $table. "' WHERE goals > '" . $user . "'";
	$result = mysqli_query($conn, $sql);
}
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

}


$conn->close();
?>
</Body>