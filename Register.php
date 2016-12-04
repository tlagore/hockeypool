<?php
include_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);

 //ob_start();
 //session_start();
 
 include_once 'dbconnect.php';

 $error = false;

 if ( isset($_POST['btn-signup']) ) {
 	
 
  // clean user inputs to prevent sql injections
  $name = $_POST['name'];

  
  $email = $_POST['email'];

  
  $pass = $_POST['pass'];

  
  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
   
  } else if (strlen($name) < 3) {
   $error = true;
 
   $errorMessage = "Name must have atleat 3 characters.";
   $params = array(
   		'error' => $errorMessage
   );
   echo $twig->render('login.twig', $params);
    
   
   
   
   
   
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT email FROM owner WHERE email='$email'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);

   
   
   
   if($count!=0){
   	echo 'here';
    $error = true;
    $emailError = "Provided Email is already in use.";
    echo $twig->render('Register.twig');
    
   }
  }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 3) {
   $error = true;
   $passError = "Password must have atleast 3 characters.";
  }
  
  // password encrypt using SHA256();
  $password =  $pass;
  
  // if there's no error, continue to signup
  if( !$error ) {
   
   $query = "INSERT INTO owner(name,email,password,is_admin) VALUES('$name','$email','$password', 0)";



   //$query = "INSERT INTO owner(userName,userEmail,userPass) VALUES('$name','$email','$password')";




   $res = mysql_query($query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
    
    echo $twig->render('login.twig');
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..." . "$query"; 
   } 
    
  }
  
  
 }
 
 else{
 	echo $twig->render('Register.twig');
 }
?>