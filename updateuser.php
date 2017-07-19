<?php
include '../apicontroller.php';
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$query = "Update users SET
username = '$username',
password = '$password',
email = '$email'
Where id = '$id'"; 
$mysqli->query($query);
	
$query = "Select * from users where id = '$id'";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
}			}
		print(json_encode($rows));

	}

?>
