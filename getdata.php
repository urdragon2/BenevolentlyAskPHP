<?php
include '../apicontroller.php';
$id = $_POST['id'];
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
