<?php
include '../apicontroller.php';
$login = $_POST['login'];
$password = $_POST['password'];
    $token = $_POST['mytoken'];
    $device = $_POST['device'];
$datetime = date_create()->format('Y-m-d H:i:s');
$query = "Select * from users where email = '$login' and password ='$password'";
	if ($result = $mysqli->query($query)) {
       		if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
			}				
		}
		$query = "UPDATE users set last_login = '$datetime' where email = '$login'";
	$mysqli->query($query);
        $query = "UPDATE users set device = '$device' where email = '$login'";
        $mysqli->query($query);
        $query = "UPDATE users set token = '$token' where email = '$login'";
        $mysqli->query($query);
		print(json_encode($rows));

	}

?>
