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
	header( "Location: /hockeypool/login.php?rd=1" );
}
if ($_SERVER ['REQUEST_METHOD'] === 'POST')
{
	$emailToAdd = $_POST['email'];
	$pool_id = $_POST['pool_id'];
	
	
	$isOwner = "select uid from owner where email = '$emailToAdd'";
	$checkOwner = $conn->query($isOwner);	//mysqli_query($conn, $isOwner);
	
	if(mysqli_num_rows($checkOwner) > 0)
	{
		$row = mysqli_fetch_row($checkOwner);
		$addToPool = "Insert into participates_in(pool_id, owner_id, pool_leader) Values($pool_id,$row[0],0)";
		$ownerAddedToPool = $conn->query($addToPool);
		header('Location: /hockeypool/displayPool.php?pid=' . $pool_id);
	}
	else {
		header('Location: /hockeypool/displayPool.php?pid=' . $pool_id);

	}
	
}
else{
	header('Location: /hockeypool/login.php');
	die();
}
?>