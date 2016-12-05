<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);

$user = $_COOKIE['cur_login'];

if($user){
	setcookie('cur_user', $user, time() + 1200, "/");
}else {
	header('Location: /hockeypool/login.php?rd=1');
	die();
}
		require 'lib.php';
		
		
		
		// Create connection
		$conn = getConn("localhost", "root", "Yaygroup_19", "hockeypool");
		$owner_name = getUser($conn, $_COOKIE['cur_login']);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {

			$sql = "SELECT  t.team_name, p.name, t.pool_id, t.owner_id 
			FROM pool as p, fantasy_team as t WHERE p.pid = t.pool_id AND t.owner_id = '$user'";
			$result = mysqli_query($conn, $sql);

					$params = array(
						'pools_enter' => $result,
						'cur_login' => $owner_name
					);
					echo $twig->render('userHomePage.twig', $params);	

		}


		
?>
