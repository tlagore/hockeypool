
<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem ( './templates' );
$twig = new Twig_Environment ( $loader );
require 'lib.php';

$user = $_COOKIE ['cur_login'];

if ($user) {
	setcookie ( 'cur_user', $user, time () + 3600, "/" );
	$conn = getConn ( 'localhost', 'root', 'Yaygroup_19', 'hockeypool' );
	$email = getUser ( $conn, $_COOKIE ['cur_login'] );
} else {
	header ( "Location: /hockeypool/login.php?rd=1" );
}

if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
	$teamName = $_POST['teamName'];
	$poolName = "Insert into pool(name) values($teamName)";
	$createPool = mysqli_query($conn, $poolName);
	$last_id = $conn->insert_id;
	
	$goal = $_POST['goal'] ;
	$assist =$_POST['assist'];
	$plusMinus = $_POST['plusMinus'];
	$PIM = $_POST['PIM'];
	$SOG = $_POST['SOG'];
	$PPG = $_POST['PPG'];
	$GWG = $_POST['GWG'];
	$numPlayers = $_POST['numPlayers'];
	$budget = '1';
	
	$poolRules = "Insert into pool_rules Values ($last_id, $goal, $assist, $plusMinus, $PIM, $SOG, $PPG, $GWG, $budget, $numPlayers)";
	$createPoolRules = $conn->query($poolRules);
	
	//	todo add to particpatews in
	//$participates = "";
	
		//header ( "Location: /hockeypool/create_team.php?pid=$last_id&oid=$user" );
} else {
	
	// add params as necessary
	$params = array (
			'user' => $user,
			'cur_login' => $email 
	);
	echo $twig->render ( 'create_pool.twig', $params );
}
?>

