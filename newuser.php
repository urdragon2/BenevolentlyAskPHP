<?php
include '../apicontroller.php';
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
    $mytoken = $_POST['mytoken'];
    $device = $_POST['device'];

$datetime = date_create()->format('Y-m-d H:i:s');

$query = "Select * from users where email = '$email'";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
			}
			print(json_encode($rows));			
		}else{
	

$query = "INSERT INTO users (username,password,email,first_login,last_login, device, token)
	VALUES ('$username','$password','$email','$datetime','$datetime','$device','$mytoken')";
	$mysqli->query($query);
	$userid = $mysqli->insert_id;

$query = "Select * from users where email = '$email'";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
			}			
		}
		$to = $email;
		$subject = "Benevolently Ask";
		$message = "Thank you and welcome to Benevolently Ask. Please enjoy your time on the app.";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <>' . "\r\n";
		mail($to,$subject,$message,$headers);
		print(json_encode($rows));
	}
}
}
?>
