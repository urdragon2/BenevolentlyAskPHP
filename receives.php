<?php
include '../apicontroller.php';
$limit = $_POST['limit'];
$myid = $_POST['id'];
//$myid = "21";
//$limit = 10;
$offset = $_POST['offset'];
//$offset = 0;
$limitstr = $offset . "," . $limit;
$query = "SELECT users.id as userid, asks.id as askid,  ask, username, asks.timedate as date, count(*) as counts
FROM `asks` 
Left join believes on asks.id = believes.askid
inner join users on asks.userid = users.id
where asks.blocked !=1
and users.reported !=1
and asks.received = 1
group by asks.id
order by asks.timedate desc
LIMIT $limitstr
";
//echo $query;
	if ($result = $mysqli->query($query)) {
       		if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
				$askid = $r['askid'];
				$query2 = "Select userid from believes where userid = '$myid' and askid = '$askid'";
				if ($result2 = $mysqli->query($query2)) {
	       				if ($result2->num_rows > 0)
					{
						while($r2 = mysqli_fetch_assoc($result2)) {
	  						$rows2[] = $r2;
							$r["myid"]=$r2["userid"];
						}			
					}else
					{
						$r["myid"]="0";
					}	
				}
  				$rows[] = $r;
			}				
		}
		print(json_encode($rows));

	}

?>
