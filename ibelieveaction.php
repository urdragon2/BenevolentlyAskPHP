<?php
include '../apicontroller.php';
$myid = $_POST['id'];
$myaskid = $_POST['myaskid'];
$believeshoice = $_POST['believechoice'];
$datetime = date_create()->format('Y-m-d H:i:s');
if ($believeshoice == "0")
{
$query = "Delete from believes where askid = '$myaskid' and userid = '$myid'";
	$mysqli->query($query);
}
else
{
$query = "INSERT INTO believes (userid,askid,date) 
	VALUES ('$myid','$myaskid', '$datetime')";
	$mysqli->query($query);
	$userid = $mysqli->insert_id;
}




$query = "Select * from users where id = '$myid'";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
}			}
		print(json_encode($rows));

	}

?>
