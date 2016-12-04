<?php 
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);

//ob_start();
//session_start();

require_once 'dbconnect.php';
$user = $_COOKIE['cur_login'];

if($user)
{
	header("Location: /hockeypool");	
}
 
 $error = false;
 //echo 'hello';
 //echo $_SERVER['REQUEST_METHOD'];
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
 	
  // prevent sql injections/ clear user invalid inputs

  $email = $_POST['email'];
  $pass = $_POST['pass'];  

 // echo $email . ' ' . $pass;
 
  // prevent sql injections / clear user invalid inputs

  
  if(empty($pass)){
   $error = True;
   $passError = "Please enter your password.";
  }
  
  // if there's no error, continue to login
  if (!$error) {
   //echo 'in here';
   $password = $pass; // password hashing using SHA256
  
   $res=mysql_query("SELECT uid, name, password FROM owner WHERE email='$email' and password = '$password'");
   $row=mysql_fetch_array($res);
   $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
   
   if( $count == 1 ) {
    setcookie ('cur_login', $row[0], time() + 1200, "/");
    header('Location: /hockeypool/userHomePage.php');
   } else {
    $errorMessage = " Incorrect credentials, please try again...";
    $params = array(
    	'error' => $errorMessage
    );
    echo $twig->render('login.twig', $params);
   }
   
  }
 }else
 {
 	$register_redirect = $_GET['rr'];
 	$redirect = $_GET['rd'];
 	
 	echo $redirect;
 	
 	$params = array(
 			'register_redirect' => $register_redirect,
 			'login_required' => $redirect
 	);
 	echo $twig->render('login.twig', $params);
 }
?>
	
	
	
	
	