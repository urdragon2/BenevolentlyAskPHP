<?php
include '../apicontroller.php';
$myid = $_POST['myid'];
$userid = $_POST['userid'];
$reportreason = $_POST['report'];

$query = "Update users SET
reported = '1',
reason = '$reportreason'
Where id = '$userid'"; 
$mysqli->query($query);

$query = "Select * from users where id = '$userid'";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
}			}
		print(json_encode($rows));

	}
?>
