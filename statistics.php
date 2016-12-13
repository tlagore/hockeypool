<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem ( './templates' );
$twig = new Twig_Environment ( $loader );

require 'lib.php';
require 'sql_lib.php';

$user = $_COOKIE ['cur_login'];
// if user is logged in, refresh cookie
if ($user) {
	setcookie ( 'cur_user', $user, time () + 3600, "/" );
}

$conn = getConn ( "localhost", "root", "Yaygroup_19", "hockeypool" );
$email = getUser ( $conn, $user );

$sqlPlayers = "SELECT
		nps.name, nps.team, nps.position, nps.games_played,
		nps.goals, nps.assists, nps.plus_minus,
		nps.penalty_mins, nps.shots_on_goal, nps.pp_goals,
		nps.gw_goals, year
		FROM
		nhl_player_statistics AS nps;";

if ($conn->connect_error) {
	die ( "cannot connect to server. " . $conn->connect_error );
}

$nhlPlayers = $conn->query ( $sqlPlayers );

$params = array (
		'nhl_players' => $nhlPlayers,
		'cur_login' => $email
);

echo $twig->render ( 'statistics.twig', $params );
?>