
<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);
require 'lib.php';
$user = $_COOKIE['cur_login'];

if($user){
	setcookie('cur_user', $user, time() + 1200, "/");
	$conn = getConn ( 'localhost', 'root', 'Yaygroup_19', 'hockeypool' );
	$email = getUser ( $conn, $_COOKIE ['cur_login'] );
}
else {
	header('Location: /hockeypool/login.php?rd=1');
	die();
}

$pool_id = $_GET['pid'];


if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
else {

	$sql = "SELECT DISTINCT o.name, p.owner_id, p.pool_name, p.team_name, TRUNCATE(SUM(p.FantasyPoints),2) AS FantasyPoints, p.pool_leader FROM
  (SELECT co.owner_id, co.pool_id, p.name AS pool_name, ft.team_name, (nps.goals * pr.goals_val +
   nps.assists * pr.assists_val +
   nps.plus_minus * pr.plus_minus_val +
   nps.penalty_mins * pr.penalty_mins_val +
   nps.shots_on_goal * pr.shots_on_goal_val +
   nps.pp_goals * pr.pp_goals_val +
   nps.gw_goals * pr.gw_goals_val) AS FantasyPoints, pi.pool_leader
  FROM
   nhl_player_statistics AS nps, composed_of AS co,
   pool_rules AS pr, fantasy_team AS ft, pool AS p,
   participates_in as pi
   WHERE nps.name = co.player_name
   AND nps.team = co.player_team
   AND pr.pool_id = co.pool_id
   AND co.pool_id = ft.pool_id
   AND co.owner_id = ft.owner_id
        AND p.pid = co.pool_id
   AND co.pool_id = $pool_id
   AND pi.pool_id = co.pool_id AND pi.owner_id = co.owner_id
   AND nps.year = 2016) AS p,
      owner AS o WHERE p.owner_id = o.uid
      GROUP BY p.owner_id, p.pool_id
 UNION SELECT o.name, o.uid AS owner_id, p.name AS team_name, null, 0 as FantasyPoints, pi.pool_leader
    FROM owner AS o 
    JOIN participates_in AS pi ON o.uid = pi.owner_id
    JOIN pool AS p on p.pid = pi.pool_id
    AND pi.pool_id = $pool_id
    AND NOT EXISTS
      (SELECT * FROM 
          fantasy_team WHERE pool_id = $pool_id AND
            owner_id = o.uid);";
	$result = mysqli_query($conn, $sql);
	
	$leaderSql = "SELECT pool_leader FROM participates_in WHERE pool_id = $pool_id AND owner_id = $user";
	$leaderResult = mysqli_query($conn, $leaderSql);
	if(mysqli_num_rows($leaderResult) > 0)
	{
		$row = mysqli_fetch_row($leaderResult);
		$leader = $row[0];
		$leaderID = $row[1];
	}
	
	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_row($result);
		$pool_name = $row[2];
	}

	$params = array(
			'teams_in_pool' => $result,
			'pool_id' => $pool_id,
			'cur_login' => $email,
			'am_leader' => $leader,
			'pool_name' => $pool_name,
			'leader_id' => $leaderID
	);
	echo $twig->render('displayPool.twig', $params);

}

?>