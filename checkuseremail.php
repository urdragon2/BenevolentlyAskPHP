<?php
include '../apicontroller.php';
$email = $_POST['email'];
$query = "Select * from users where email = '$email'";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
}			}
		print(json_encode($rows));

	}

?>