<?php 

/*Twig is a templating system and I think it's what I've been looking for. It allows us to encapsulate a more "mvc feel" with
php instead of just slapping some html here, some php there, some of this some of that, it keeps all our php and our html
exclusively separated (which is how it should be). Note that it enables this behavior, but does not force it. Make sure
we're not literring our php with html code.

Go to your php.ini file and add these lines:

//windows
extension=php_twig.dll

//unix (eg mac)
extension=twig.so

Example login.php interaction:
For example if we are directed to localhost/hockeypool/login.php, our files would look like this:

login.php:
*/
//Must be included in every php header that uses the twig constructs
include_once 'vendor/autoload.php';
require_once 'vendor/twig/twig/lib/Twig/Autoloader.php';
$loader = new Twig_Loader_filesystem('./templates');
$twig = new Twig_Environment($loader);

if($SERVER['REQUEST_METHOD'] === 'POST')
{
	//do work of getting POST stuff
	//eg:
	
	$errors = False;
	
	if(empty($_POST['inputEmail']))
	{
		$emailError = "Email cannnot be blank.";
		$errors = True;
	}
	
	$user = $_POST[''];
	$password = $_POST[''];
	$sql = '';
	$result = '';
	
	if($resullt){
		//set user id cookie - we'll check this cookie in any method that requires user authentication, 1200 seconds (20 minutes) expire time
		// '/' means its available on the whole site (bad form but whatever).
		setcookie('user_id', '' , 1200, '/');
		$user_name = '';//get result row[1] or whatever
	}

	$params = array(
		'user_name' => $user_name,
		'emailError' => $emailError,
	);
	
	//since this is a redirect page we must check again to see if the login was successful
	if($result)
	{
		//we will make this file
		echo $twig->render('home.twig', $params);
	}else
	{
		//bad info
		echo $twig->render('login.php', $params);	
	}
}else
{
	//we will make this file
	echo $twig->render('login.twig', $params);
}
?>

login.twig:
Login.twig is our template (our view)
//this is the glorious one line I've been looking for that will incorporate our main layout into this file with no extra hassle
{% extends base.twig %}

//because it extends another template, it has no content of its own - it can only fill out 'blocks' that the template offers 
//(which we specify)
{% block primary_content %}
<form class="form-horizontal" action="login.php" method="post">
	<fieldset>
		<legend>Legend</legend>
		<div class="form-group">
			{% if emailError %}
				<div class="form-group has-error">
					<label for="inputEmail" class="col-lg-2 control-label">Email</label>
					
					{# note the syntax for using a varriable {{ variable }} will insert the contents of variable #}
					<label class="control-label" for="inputEmail">{{ emailError }}</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id=inputEmail" name="inputEmail" placeholder="Email">
					</div>
				</div>
			{% else %}
				<label for="inputEmail" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
					</div>
				</div>
			{% endif %}
			<div class="form-group">
				<label for="inputEmail" class="col-lg-2 control-label">Password</label>
				<div class="col-lg-10">
					<input type="password" class="form-control" id=inputPassword" name="inputPassword" placeholder="Password">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="reset" class="btn btn-primary btn-md">Cancel</button>
					<button type="submit" class="btn btn-primary btn-md">Submit</button>
				</div>
			</div>	
		</div>
	</fieldset>
</form>
{% endblock %}


home.twig:

{% extends base.twig %}
{% block primary_content %}
	<div class="jumbotron">
		<h1>HOCKEY PEWWWLLL</h1>
	</div>
	{% if user_name %}
		<h3>Welcome {{$user_name}}</h3>
	{% endif %}
{% endblock %}


base.twig:

<html>
	<all our glorious styling>
	<nav bar>
	<etc>
	<body>
		<div class="container">
		{% block primary_content %}
			{# all our above twig files that extend THIS twig file are inserting their content here! #}
		{% endblock %}
		</div>
	</body>
</html>








