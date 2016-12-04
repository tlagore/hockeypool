<?php 
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);
?>

<?php
$user = $_COOKIE['cur_login'];

if($user){
	setcookie('cur_user', $user, time() + 1200, "/");
}

$owner_id = $_GET['oid'];
$pool_id = $_GET['pid'];

if(!owner_id || !$pool_id)
{
	header('Location: /hockeypool/login.php');
	die();
}

require 'lib.php';
require 'sql_lib.php';

$conn = getConn("localhost", "root", "Yaygroup_19", "hockeypool");
$sql = $getTeam;

if($conn->connect_error)
{
	die("cannot connect to server. " . $conn->connect_error);
}

$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0)
{
	$fp = 0;
	while($row = mysqli_fetch_row($result))
	{
		$pool_name = $row[0];
		$team_name = $row[1];
		$fp = $fp + $row[13];
	}
}

$params = array(
	'player_stats' => $result,
	'team_name' => $team_name,
	'pool_name' => $pool_name,
	'total_points' => $fp,
	'my_team' => $owner_id == $user,
);

echo $twig->render('team.twig', $params);

?>
