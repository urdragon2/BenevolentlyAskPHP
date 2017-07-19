<?php
include '../apicontroller.php';
$limit = $_POST['limit'];
$myid = $_POST['id'];
//$myid = "21";
//$limit = 10;
$offset = $_POST['offset'];
//$offset = 0;
$limitstr = $offset . "," . $limit;
$query = "SELECT users.id as userid, asks.id as askid,  ask, username, asks.timedate as date, count(*) as counts, received
FROM `asks` 
Left join believes on asks.id = believes.askid
inner join users on asks.userid = users.id
where users.id = '$myid'

group by asks.id
order by asks.timedate desc
LIMIT $limitstr
";
//echo $query;
	if ($result = $mysqli->query($query)) {
       		if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
			}				
		}
		print(json_encode($rows));

	}

?>
