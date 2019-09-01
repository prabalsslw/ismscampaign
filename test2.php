 <?php
	$servername = "192.168.181.17";
	$username = "sslcare_db";
	$password = "Ssl#124ljYfy6";
	$dbname = "sslcare_db";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "INSERT INTO sms_permission_tab (`left_menu_id`, `tab_id`, `user_id`)
	VALUES ('13', '2', '1')";

	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
?> 