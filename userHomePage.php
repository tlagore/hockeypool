<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<TITLE>My pools</TITLE>



<div class = "container">
	<table>
		<tr>
			<th>Team Name</th>
			<th>Pool Name</th>
		</tr>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "Yaygroup_19";
		$dbname = "hockeypool";
		
		$user = $_POST["name"];
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			//$sql = "SELECT * FROM pool p INNER JOIN fantasy_team t ON p.pid = t.pool_id AND t.owner_id = 1";
			$sql = "SELECT p.name, t.team_name FROM pool p, fantasy_team t WHERE p.pid = t.pool_id AND t.owner_id = 1";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_row($result))
					{
						echo "<tr>". "<td>" . $row[1] . "</td>" . "<td>" . $row[0] . "</td>" . "</tr>";
					}
				}
		}
		
		?>
	</table>
</div>