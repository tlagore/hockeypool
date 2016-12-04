<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);

echo $_GET['link'];
//	echo "<script type='text/javascript'>alert('$_GET['link']')</script>";

echo $twig->render('create_team.twig');
?>