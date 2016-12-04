<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);

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
			$sql = "SELECT  t.team_name, p.name FROM pool as p, fantasy_team as t WHERE p.pid = t.pool_id AND t.owner_id = $value";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) > 0)
				{
					$params = array(
							'pools_enter' => $result
					);
					echo $twig->render('userHomePage.twig', $params);	
				}
			else
			{
				$params = array(
						'pools_enter' => $result
				);
				echo $twig->render('userHomePage.twig', $params);
			}
		}
		
?>
