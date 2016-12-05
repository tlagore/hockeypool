<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem ( './templates' );
$twig = new Twig_Environment ( $loader );

require 'lib.php';
require 'sql_lib.php';

if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
	$pid = $_POST ['pid'];
	$oid = $_POST ['oid'];
	$team_name = $_POST ['team_name'];
	
	$sqlTeams = "SELECT
	p.name, ft.team_name,
	nps.name, nps.team, nps.position, nps.games_played,
	nps.goals, nps.assists, nps.plus_minus,
	nps.penalty_mins, nps.shots_on_goal, nps.pp_goals,
	nps.gw_goals,
	TRUNCATE((nps.goals * pr.goals_val +
	nps.assists * pr.assists_val +
	nps.plus_minus * pr.plus_minus_val +
	nps.penalty_mins * pr.penalty_mins_val +
	nps.shots_on_goal * pr.shots_on_goal_val +
	nps.pp_goals * pr.pp_goals_val +
	nps.gw_goals * pr.gw_goals_val),2) AS FantasyPoints
	FROM
	nhl_player_statistics AS nps, composed_of AS co,
	pool_rules AS pr, fantasy_team AS ft, pool AS p
	WHERE nps.name = co.player_name
	AND nps.team = co.player_team
	AND pr.pool_id = co.pool_id
	AND co.pool_id = ft.pool_id
	AND co.owner_id = ft.owner_id
	AND p.pid = co.pool_id
	AND co.pool_id = $pid
	AND co.owner_id = $oid
	AND nps.year = 2016;";
	
	$conn = getConn ( 'localhost', 'root', 'Yaygroup_19', 'hockeypool' );
	
	if ($conn->connect_error) {
		die ( "cannot connect to server. " . $conn->connect_error );
	}
	
	$result = $conn->query ( $sqlTeams );
	
	// if team already exists, redirect to view team - only allowed one team per pool.
	if ($result) {
		if (mysqli_num_rows ( $result ) > 0) {
			header ( "Location: /hockeypool/team.php?oid=" . $owner_id . "&pid=" . $pool_id );
		}
	}

	$rules = $conn->query ( "SELECT num_players FROM pool_rules WHERE pool_id = $pid;" );
	$row = mysqli_fetch_row ( $rules );
	$num_players = intval ( $row [0] );
	
	$newTeamSql = "INSERT INTO fantasy_team (pool_id, owner_id, team_name) VALUES ($pid, $oid, '$team_name')";
	$conn->query ( $newTeamSql );
	
	for($x = 1; $x <= $num_players; $x ++) {
		$player = explode ( '#', $_POST ['teamIn' . ( string ) $x] );
		$insertPlayerSql = "INSERT INTO composed_of (pool_id, owner_id, player_name, player_team) VALUES ($pid, $oid, '$player[0]', '$player[1]');";
		$conn->query ( $insertPlayerSql );
	}
	
	header ( 'Location: /hockeypool/team.php?oid=' . $oid . '&pid=' . $pid );
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
	$email = getUser ( $conn, $user );
	
	$sqlTeams = "SELECT
			p.name, ft.team_name,
			nps.name, nps.team, nps.position, nps.games_played,
			nps.goals, nps.assists, nps.plus_minus,
			nps.penalty_mins, nps.shots_on_goal, nps.pp_goals,
			nps.gw_goals,
			TRUNCATE((nps.goals * pr.goals_val +
			nps.assists * pr.assists_val +
			nps.plus_minus * pr.plus_minus_val +
			nps.penalty_mins * pr.penalty_mins_val +
			nps.shots_on_goal * pr.shots_on_goal_val +
			nps.pp_goals * pr.pp_goals_val +
			nps.gw_goals * pr.gw_goals_val),2) AS FantasyPoints
		FROM
			nhl_player_statistics AS nps, composed_of AS co,
			pool_rules AS pr, fantasy_team AS ft, pool AS p
			WHERE nps.name = co.player_name
			AND nps.team = co.player_team
			AND pr.pool_id = co.pool_id
			AND co.pool_id = ft.pool_id
			AND co.owner_id = ft.owner_id
      		AND p.pid = co.pool_id
			AND co.pool_id = $pool_id
			AND co.owner_id = $owner_id
			AND nps.year = 2016;";
	
	if ($conn->connect_error) {
		die ( "cannot connect to server. " . $conn->connect_error );
	}
	
	$result = $conn->query ( $sqlTeams );

	// if team already exists, redirect to view team - only allowed one team per pool.
	if ($result) {
		if (mysqli_num_rows ( $result ) > 0) {
			header ( "Location: /hockeypool/team.php?oid=" . $owner_id . "&pid=" . $pool_id );
		}
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