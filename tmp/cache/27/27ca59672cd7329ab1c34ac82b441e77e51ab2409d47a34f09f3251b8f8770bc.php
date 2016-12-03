<?php

/* pool.twig */
class __TwigTemplate_a2d312285a4c224cead92fba5bc7d7ce8988b8525959f01dcfc193b3416c0296 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "pool.twig", 1);
        $this->blocks = array(
            'primary_content' => array($this, 'block_primary_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_primary_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"row\" sylte=\"margin-top:5%;\">
    <table>
    \t<tr>
        \t<th>Name</th>
        \t<th>Team</th>
        \t<th>Position</th>
        \t<th>Games Played</th>
        \t<th>Goals</th>
        \t<th>Assists</th>
        \t<th>+/-</th>
        \t<th>Penalty Mins</th>
        \t<th>Shots on Goal</th>
        \t<th>PP goals</th>
        \t<th>GW goals</th>
        \t<th>Fantasy Points</th>
    \t</tr>
        ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["player_stats"]) ? $context["player_stats"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["player"]) {
            // line 21
            echo "            <tr>
            \t<td>";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute($context["player"], "name", array()), "html", null, true);
            echo "</td>
            \t<td>";
            // line 23
            echo twig_escape_filter($this->env, $this->getAttribute($context["player"], "team", array()), "html", null, true);
            echo "</td>
            \t<td>";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute($context["player"], "position", array()), "html", null, true);
            echo "</td>
            \t<td>";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute($context["player"], "goals", array()), "html", null, true);
            echo "</td>
            \t<td>";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute($context["player"], "assists", array()), "html", null, true);
            echo "</td>
            \t<td>";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($context["player"], "plus_minus", array()), "html", null, true);
            echo "</td>
            \t<td>";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute($context["player"], "penalty_mins", array()), "html", null, true);
            echo "</td>
            \t<td>";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute($context["player"], "shots_on_goal", array()), "html", null, true);
            echo "</td>
            \t<td>";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute($context["player"], "pp_goals", array()), "html", null, true);
            echo "</td>
            \t<td>";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute($context["player"], "gw_goals", array()), "html", null, true);
            echo "</td>
            \t<td>";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute($context["player"], "FantasyPoints", array()), "html", null, true);
            echo "</td>
        \t</tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['player'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "    </table>
</div>
";
    }

    public function getTemplateName()
    {
        return "pool.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  105 => 35,  96 => 32,  92 => 31,  88 => 30,  84 => 29,  80 => 28,  76 => 27,  72 => 26,  68 => 25,  64 => 24,  60 => 23,  56 => 22,  53 => 21,  49 => 20,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "pool.twig", "E:\\AppServ\\www\\hockeypool\\templates\\pool.twig");
    }
}
