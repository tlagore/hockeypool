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
	
	function getUser($conn, $uid)
	{
		$sql = "SELECT email FROM owner WHERE uid = $uid;";
		$result = $conn->query($sql);
		
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_row($result);
				$user = $row[0];
			}
		}
		
		return $user;
	}
?>