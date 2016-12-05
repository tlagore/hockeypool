<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem ( './templates' );
$twig = new Twig_Environment ( $loader );


require 'lib.php';
require 'sql_lib.php';

if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
	$pid = $_POST['pid'];
	$oid = $_POST['oid'];
	
	$conn = getConn('localhost', 'root', 'Yaygroup_19', 'hockeypool');
	$rules = $conn->query ( "SELECT num_players FROM pool_rules WHERE pool_id = $pid;" );
	$row = mysqli_fetch_row($rules);
	$num_players = $row [0];
	
	for($x = 1; x <= $num_players; $x++)
	{
		echo $_POST['teamIn'.$x];
	}	
} else {
	$user = $_COOKIE ['cur_login'];
	// if user is logged in, refresh cookie
	if ($user) {
		setcookie ( 'cur_user', $user, time () + 3600, "/" );
	}
	
	$owner_id = $_GET ['oid'];
	$pool_id = $_GET ['pid'];
	// if we didn't get owner id, pool id, or if person logged in is not the owner of the team, redirect to home page
	if (! $owner_id || ! $pool_id) {
		header ( "Location: /hockeypool" );
	} else if ($user != $owner_id) {
		header ( "Location: /hockeypool/login.php?rd=1" );
	}

	$conn = getConn ( "localhost", "root", "Yaygroup_19", "hockeypool" );
	$email = getUser($conn, $user);
	
	$sqlTeams = $getTeam;
	
	if ($conn->connect_error) {
		die ( "cannot connect to server. " . $conn->connect_error );
	}
	
	$result = $conn->query ( $sqlTeams );
	// if team already exists, redirect to view team - only allowed one team per pool.
	if (mysqli_num_rows ( $result ) > 0) {
		header ( "Location: /hockeypool/team.php?oid=" . $owner_id . "&pid=" . $pool_id );
	}
	
	$sqlParticipating = "SELECT * FROM participates_in WHERE pool_id = $pool_id AND owner_id = $owner_id;";
	$result = $conn->query ( $sqlParticipating );
	// if pool owner combination does not exist in participates in, they have not been invited to pool.
	if (mysqli_num_rows ( $result ) == 0) {
		header ( "Location: /hockeypool" );
	}
	
	$sqlPlayers = $getNhlPlayerStats;
	
	$nhlPlayers = $conn->query ( $sqlPlayers );
	$user = $conn->query ( "SELECT name FROM owner WHERE uid = $owner_id;" );
	$rules = $conn->query ( "SELECT num_players FROM pool_rules WHERE pool_id = $pool_id;" );
	$row = mysqli_fetch_row ( $rules );
	$num_players = $row [0];
	
	$params = array (
			'nhl_players' => $nhlPlayers,
			'cur_login' => $email,
			'num_players' => $num_players,
			'pool_id' => $pool_id,
			'owner_id' => $owner_id
	);
	
	echo $twig->render ( 'create_team.twig', $params );
}
?>