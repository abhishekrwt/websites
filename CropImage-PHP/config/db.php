<?php
	// Create Connection
	$conn = mysqli_connect("localhost","root","","crop");

	// Check Connection
	if(!$conn){
		// Connection Failed
		echo 'Failed to connect to MySQL ';
	}
?>