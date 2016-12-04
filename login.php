<?php 
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);

 //ob_start();
 //session_start();
 require_once 'dbconnect.php';
 
 // it will never let you open index(login) page if session is set
 /*if ( isset($_SESSION['user'])!="" ) {
  header("Location: home.php");
  exit;
 }
 */
 $error = false;
 //echo 'hello';
 //echo $_SERVER['REQUEST_METHOD'];
 //if($_SERVER['REQUEST_METHOD'] === 'POST')
 if( isset($_POST['btn-login']) ) 
{
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
 	echo $twig->render('login.twig');
 }
?>
	
	
	
	
	