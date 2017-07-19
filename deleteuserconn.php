<?php
include '../apicontroller.php';
$id = $_POST['id'];
$askid = $_POST['askid'];
    $query = "update asks set blocked = '1' where id = '$askid'";
    $mysqli->query($query);

$query = "Select * from asks where id = '$askid'";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
}			}
		print(json_encode($rows));

	}

?>
