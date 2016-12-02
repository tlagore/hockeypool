<Title>TEST	</Title>
<Body>Tyrone is a big scrub</Body>
<?php
$servername = "localhost";
$username = "root";
$password = "Yaygroup_19";

try {
	$conn = new PDO("mysql:host=$servername;dbname=hockeypool", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connected successfully";
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}
?>