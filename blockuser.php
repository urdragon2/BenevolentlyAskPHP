<?php
include '../apicontroller.php';
$myid = $_POST['myid'];
$chatuser = $_POST['chatuser'];
$datetime = date_create()->format('Y-m-d H:i:s');
$query = "INSERT INTO blocked (userid,blockedid,date) 
	VALUES ('$myid','$chatuser', '$datetime')";
	$mysqli->query($query);
	$userid = $mysqli->insert_id;



$query = "Select * from blocked where id = '$userid'";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
}			}
		print(json_encode($rows));

	}

?>
