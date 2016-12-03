<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<TITLE>My pools</TITLE>




<div class = "midTable">

	<table>
		<tr>
			<th>Team Name</th>
			<th>Pool Name</th>
		</tr>
		<?php
		require 'lib.php';
		
		$user = $_POST["name"];
		// Create connection
		$conn = getConn("localhost", "root", "Yaygroup_19", "hockeypool");
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			$sql = "SELECT  t.team_name, p.name FROM pool as p, fantasy_team as t WHERE p.pid = t.pool_id AND t.owner_id = 1";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_row($result))
					{
						echo "<tr>". "<td>" . $row[0] . "</td>" . "<td>" . $row[1] . "</td>" . "</tr>";
					}
				}
		}
		
		?>
	</table>

</div>
</html>