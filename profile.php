<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem ( './templates' );
$twig = new Twig_Environment ( $loader );

require 'lib.php';
require_once 'dbconnect.php';

$conn = getConn ( 'localhost', 'root', 'Yaygroup_19', 'hockeypool' );
$email = getUser ( $conn, $_COOKIE ['cur_login'] );

if (! $email) {
	header ( "Location: /hockeypool/" );
} else {
	setcookie ( 'cur_login', $_COOKIE ['cur_login'], time () + 3600, '/' );
}

// //////////////////////////////////////////////////////////////////////
if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
	$email = $_POST ['email'];
	$pass = $_POST ['pass'];
	$newPass = $_POST['newPass'];
	
	$result = $conn->query ( "SELECT password FROM owner WHERE password='$pass' AND email = '$email'" );
	
	if (mysqli_num_rows ( $result ) == 0) {
		
		$errorMessage = " The original password you entered is not correct.";
		$params = array (
				'error' => $errorMessage,
				'cur_login' => $email 
		);
		echo $twig->render ( 'profile.twig', $params );
	} else {
		$changeMessage = " You have changed your password.";
		$params = array (
				'passChanged' => $changeMessage,
				'cur_login' => $email 
		);
		
		$query = "UPDATE owner SET password='$newPass' WHERE email='$email'";
		mysql_query($query);
		echo $twig->render ( 'profile.twig', $params );
	}

} else {
	$params = array (
			'cur_login' => $email 
	);
	
	echo $twig->render ( "profile.twig", $params );
}
?>

