<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
	header('Access-Control-Allow-Methods: GET, POST, PUT');
	
	include_once "connect.php";

	/* Check connection */
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	$username = $_GET['username'];
	$querySelect = "SELECT * FROM users WHERE username = '$username'";
    $result = $db->query($querySelect);
    if($result->fetch_object()){
   		echo "exists";
  	}else{
    	return false;
  	}
?>