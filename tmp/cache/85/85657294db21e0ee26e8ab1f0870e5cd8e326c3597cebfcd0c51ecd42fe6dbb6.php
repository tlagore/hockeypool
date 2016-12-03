<?php

/* base.twig */
class __TwigTemplate_57dfaaa9163d20775222f46394464c7a0fb3710d9d3daf68dfc4aa8b0e427055 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'primary_content' => array($this, 'block_primary_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
    <head>
        <title></title>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"css/bootstrap.css\">
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    </head>
\t<div class=\"navbar navbar-default navbar-fixed-top\" id=\"main-navbar\">
      <div class=\"container\">
        <div class=\"navbar-header\">
          <a href=\"../\" class=\"navbar-brand\">HockeyPool!</a>
          <button class=\"navbar-toggle\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbar-main\">
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
        </div>
        <div class=\"navbar-collapse collapse\" id=\"navbar-main\">
          \t<ul class=\"nav navbar-nav\">
            \t<li class=\"dropdown\">
              \t<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"/pools.php\" id=\"themes\">Pools<span class=\"caret\"></span></a>
              \t<ul class=\"dropdown-menu\" aria-labelledby=\"themes\">
                \t<li><a href=\"../default/\">Default</a></li>
                \t<li class=\"divider\"></li>
                \t<li><a href=\"../cerulean/\">Dropdown item!</a></li>
              \t</ul>
            \t</li>
            \t<li>
              \t<a href=\"../my_teams.php\">My Teams</a>
            \t</li>
            \t<li>
             \t\t<a href=\"http://news.bootswatch.com\">Owners</a>
            \t</li>
          \t</ul>

          \t<ul class=\"nav navbar-nav navbar-right\">
            \t<li><a href=\"/login.php\">Login</a></li>
            \t<li><a href=\"/register.php\">Register</a></li>
        \t</ul>
    \t</div>
\t</div>
</div>
<body style=\"padding-top:65px;\">
 <!--   <a style=\"display:block; margin-top:60px;\" id=\"menu-btn\" href=\"#\"><span class='glyphicon glyphicon-menu-up'></span></a>--> 
    <div class=\"container\">
    \t";
        // line 46
        $this->displayBlock('primary_content', $context, $blocks);
        // line 48
        echo "\t</div>
</body>
</html>

<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js\"></script>
<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>

<script>
\$(document).ready(function(){
    \$('#menu-btn').click(function(){
            var margTop = \$('#menu-btn').css('margin-top').toString();
            if (margTop === \"0px\")
            {
                \$('#main-navbar').animate({
                            top: \"0px\"
                            }, 300, function(){
                    });

                    \$('#menu-btn').animate({
                            marginTop: \"60px\"
                            }, 300, function(){
                    });

                    \$('#menu-btn').html(\"<span class='glyphicon glyphicon-menu-up'></span>\");
            }else
            {
                    \$('#main-navbar').animate({
                            top: \"-60px\"
                            }, 300, function(){
                    });

                    \$('#menu-btn').animate({
                            marginTop: \"0px\"
                            }, 300, function(){
                    });

                    \$('#menu-btn').html(\"<span class='glyphicon glyphicon-menu-down'></span>\");
            }
    });       \t\t\ttop: \"0px\"
 
});
</script>

";
    }

    // line 46
    public function block_primary_content($context, array $blocks = array())
    {
        // line 47
        echo "     \t";
    }

    public function getTemplateName()
    {
        return "base.twig";
    }

    public function getDebugInfo()
    {
        return array (  119 => 47,  116 => 46,  69 => 48,  67 => 46,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "base.twig", "E:\\AppServ\\www\\hockeypool\\templates\\base.twig");
    }
}
