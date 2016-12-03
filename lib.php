<?php
	function getConn($server, $usr, $pass, $db)
	{
		$conn = mysqli_connect($server, $usr, $pass, $db);
		if(!$conn)
		{
			die("Connection failed" . mysqli_connect_error());
		}
		
		return $conn;		
	}
?>