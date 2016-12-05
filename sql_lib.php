<?php 

$getTeam = "SELECT
			p.name, ft.team_name, o.name AS owner,
			nps.name, nps.team, nps.position, nps.games_played,
			nps.goals, nps.assists, nps.plus_minus,
			nps.penalty_mins, nps.shots_on_goal, nps.pp_goals,
			nps.gw_goals,
			TRUNCATE((nps.goals * pr.goals_val +
			nps.assists * pr.assists_val +
			nps.plus_minus * pr.plus_minus_val +
			nps.penalty_mins * pr.penalty_mins_val +
			nps.shots_on_goal * pr.shots_on_goal_val +
			nps.pp_goals * pr.pp_goals_val +
			nps.gw_goals * pr.gw_goals_val),2) AS FantasyPoints
		FROM
			nhl_player_statistics AS nps, composed_of AS co,
			pool_rules AS pr, fantasy_team AS ft, pool AS p, owner AS o
			WHERE nps.name = co.player_name
			AND nps.team = co.player_team
      AND o.uid = co.owner_id
			AND pr.pool_id = co.pool_id
			AND co.pool_id = ft.pool_id
			AND co.owner_id = ft.owner_id
      		AND p.pid = co.pool_id
			AND co.pool_id = $pool_id
			AND co.owner_id = $owner_id
			AND nps.year = 2016";

$getNhlPlayerStats = "SELECT name, team, position, games_played, goals, assists, plus_minus, penalty_mins, shots_on_goal, pp_goals, gw_goals
  		FROM nhl_player_statistics WHERE year = 2016 AND games_played > 0;"
?>