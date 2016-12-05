
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
	header('Location: /hockeypool/login.php');
	die();
}

$pool_id = $_GET['pid'];


if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
else {
/*
	$sql = "SELECT  t.team_name, p.name, t.pool_id, t.owner_id
	FROM pool as p, fantasy_team as t WHERE p.pid = t.pool_id
	AND p.pid = '$pool_id'";
	 */
	$sql = "SELECT DISTINCT o.name, p.owner_id, p.team_name, SUM(p.FantasyPoints) AS FantasyPoints FROM
  (SELECT co.owner_id, co.pool_id, ft.team_name, TRUNCATE((nps.goals * pr.goals_val +
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
   AND nps.year = 2016) AS p,
      owner AS o WHERE p.owner_id = o.uid
      GROUP BY p.owner_id, p.pool_id
 UNION SELECT o.name, o.uid AS owner_id, null, 0 as FantasyPoints
    FROM owner AS o 
    JOIN participates_in AS pi ON o.uid = pi.owner_id
    AND pi.pool_id = $pool_id
    AND NOT EXISTS
      (SELECT * FROM 
          fantasy_team WHERE pool_id = $pool_id AND
            owner_id = o.uid)";
	$result = mysqli_query($conn, $sql);

	$params = array(
			'teams_in_pool' => $result,
			'pool_id' => $pool_id,
			'cur_login' => $email
	);
	echo $twig->render('displayPool.twig', $params);

}

?>