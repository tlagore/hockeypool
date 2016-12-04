<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);

if(!$_POST)
{
		/*For Testing */
		$name = "logged_in_user";
		$value = "1"; //ownerid
		setcookie($user, $value, time() + 1200, "/");
		
		require 'lib.php';
		
		$user = $_POST["name"];
		// Create connection
		$conn = getConn("localhost", "root", "Yaygroup_19", "hockeypool");
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			$sql = "SELECT  t.team_name, p.name, t.pool_id, t.owner_id FROM pool as p, fantasy_team as t WHERE p.pid = t.pool_id AND t.owner_id = '$value'";
			$result = mysqli_query($conn, $sql);
					$params = array(
							'pools_enter' => $result
					);
					echo $twig->render('userHomePage.twig', $params);	
		}
}
else {
	
	
}
		
?>
