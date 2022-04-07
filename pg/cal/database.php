<?php

	$con = mysqli_connect("localhost","root","","tcf");
			mysqli_query($con, "SET NAMES 'utf8'");
			mysqli_query($con, "SET CHARACTER SET 'utf8'");
			mysqli_query($con, "SET character_set_connection = 'utf8'");

	if(!$con)
	{
		die('Error:'.mysqli_error());
	}
?>
