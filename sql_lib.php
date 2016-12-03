<?php 

$getTeam = "SELECT
			ft.team_name,
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
			pool_rules AS pr, fantasy_team AS ft
			WHERE nps.name = co.player_name
			AND nps.team = co.player_team
			AND pr.pool_id = co.pool_id
			AND co.pool_id = ft.pool_id
			AND co.owner_id = ft.owner_id
			AND co.pool_id = $pool_id
			AND co.owner_id = $owner_id
			AND nps.year = 2016;";


?>