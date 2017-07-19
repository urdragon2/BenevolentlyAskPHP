<?php
include '../apicontroller.php';
$login = $_REQUEST['login'];
$new_password = $_REQUEST['password'];
$clear_password = $_REQUEST['clearpassword'];
$query = "Select * from users where email = '$login'";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
			}		
			$results = $mysqli->query("update users set password= '$new_password' where email = '$login'");
			$to = $login;
			$subject = "Benevolently Ask new password";
			$message = "New password is: "  . $clear_password;
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <benevolentlyask@kurfirstcorp.com>' . "\r\n";
			mail($to,$subject,$message,$headers);
		}
		print(json_encode($rows));

	}

?>
