<?php
include '../apicontroller.php';
$myid = $_POST['id'];
$myaskid = $_POST['myaskid'];
$believeshoice = $_POST['believechoice'];
$datetime = date_create()->format('Y-m-d H:i:s');
if ($believeshoice == "0")
{
$query = "update asks set received = '0' where id = '$myaskid' and userid = '$myid'";
	$mysqli->query($query);
}
else
{
$query = "update asks set received = '1' where id = '$myaskid' and userid = '$myid'";
	$mysqli->query($query);
	$userid = $mysqli->insert_id;
}




$query = "Select * from asks where id = '$myaskid'";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
}			}
		print(json_encode($rows));

	}

?>
