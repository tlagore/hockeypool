<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);

$user = $_COOKIE['cur_login'];

if($user){
	setcookie('cur_user', $user,  time() + 1200, "/");
}else{
	header("Location: /hockeypool/login.php?rd=1");
}

//add params as necessary
$params = array(
		'user' => $user
);
echo $twig->render('create_pool.twig', $params);
?>

