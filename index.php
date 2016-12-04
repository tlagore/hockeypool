<?php 
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);

require 'lib.php';

$conn = getConn('localhost', 'root', 'Yaygroup_19', 'hockeypool');
$user = getUser($conn, $_COOKIE['cur_login']);

$params = array(
		'cur_login' => $user
);

echo $twig->render("index.twig", $params);
?>

