
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
	
}

?>
</Body>