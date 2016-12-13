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

			$sql = "SELECT o.name, pi.owner_id, pi.pool_id, p.name AS pool_name, ft.team_name, pi.pool_leader FROM
  					pool AS p 
  					JOIN participates_in AS pi ON p.pid = pi.pool_id
					  JOIN owner AS o on o.uid = pi.owner_id
					  LEFT JOIN fantasy_team AS ft ON ft.pool_id = p.pid AND ft.owner_id = pi.owner_id
					  WHERE pi.owner_id = $user";
			
			$result = mysqli_query($conn, $sql);

					$params = array(
						'pools_enter' => $result,
						'cur_login' => $owner_name
					);
					echo $twig->render('userHomePage.twig', $params);	

		}


		
?>
