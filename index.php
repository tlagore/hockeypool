<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
	<div class="navbar navbar-default navbar-fixed-top" id="main-navbar">
      <div class="container">
        <div class="navbar-header">
          <a href="../" class="navbar-brand">HockeyPool!</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          	<ul class="nav navbar-nav">
            	<li class="dropdown">
              	<a class="dropdown-toggle" data-toggle="dropdown" href="/pools.php" id="themes">Pools<span class="caret"></span></a>
              	<ul class="dropdown-menu" aria-labelledby="themes">
                	<li><a href="../default/">Default</a></li>
                	<li class="divider"></li>
                	<li><a href="../cerulean/">Dropdown item!</a></li>
              	</ul>
            	</li>
            	<li>
              	<a href="../my_teams.php">My Teams</a>
            	</li>
            	<li>
             		<a href="http://news.bootswatch.com">Owners</a>
            	</li>
          	</ul>

          	<ul class="nav navbar-nav navbar-right">
            	<li><a href="/login.php">Login</a></li>
            	<li><a href="/register.php">Register</a></li>
        	</ul>
    	</div>
	</div>
</div>
 <!--   <a style="display:block; margin-top:60px;" id="menu-btn" href="#"><span class='glyphicon glyphicon-menu-up'></span></a>--> 
    <div class="container">

      <div class="page-header" id="banner">
        <div class="row" style="margin-top:5%">
          <div class="jumbotron"> <!--  col-lg-8 col-md-7 col-sm-6">-->
            <h1>HockeyPool</h1>
            <p class="lead">Is it cold in here?</p>
            <a href="login.php" class="btn btn-primary btn-md">Get started</a>
            <div class="well bs-component">
             	<form class="form-horizontal" action="pool.php" method="post">
                	<fieldset>
                  		<legend>Legend</legend>
                  		<div class="form-group">
                    		<label for="inputEmail" class="col-lg-2 control-label">Email</label>
                   			<div class="col-lg-10">
                     			<input type="text" class="form-control" name="inputUser" placeholder="User">
                   			</div>
                		</div>
                		<div class="form-group">
                    		<label for="inputEmail" class="col-lg-2 control-label">Email</label>
                   			<div class="col-lg-10">
                     			<input type="text" class="form-control" name="inputPool" placeholder="Pool">
                   			</div>
                		</div>
                  		<div class="form-group">
                    		<div class="col-lg-10 col-lg-offset-2">
                      			<button type="reset" class="btn btn-primary btn-md">Cancel</button>
                      			<button type="submit" class="btn btn-primary btn-md">Submit</button>
                    		</div>
                  		</div>	
            		</fieldset>
            	</form>
           	</div>
          </div>
        </div>
      </div>
	</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $('#menu-btn').click(function(){
            var margTop = $('#menu-btn').css('margin-top').toString();
            if (margTop === "0px")
            {
                $('#main-navbar').animate({
                            top: "0px"
                            }, 300, function(){
                    });

                    $('#menu-btn').animate({
                            marginTop: "60px"
                            }, 300, function(){
                    });

                    $('#menu-btn').html("<span class='glyphicon glyphicon-menu-up'></span>");
            }else
            {
                    $('#main-navbar').animate({
                            top: "-60px"
                            }, 300, function(){
                    });

                    $('#menu-btn').animate({
                            marginTop: "0px"
                            }, 300, function(){
                    });

                    $('#menu-btn').html("<span class='glyphicon glyphicon-menu-down'></span>");
            }
    });       			top: "0px"
 
});
</script>

