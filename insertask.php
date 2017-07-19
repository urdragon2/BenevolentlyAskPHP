<?php
include '../apicontroller.php';
$id= $_POST['id'];
$myask = $_POST['myask'];
$mylimit = "10000";
$query = "Select * from asks where userid = '$id' and TIMESTAMPDIFF(MINUTE, timedate, NOW()) < 30";	
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)

		{

			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
			}
			print(json_encode($rows));			
		}else{



$query = "INSERT INTO asks (userid,ask, timedate)
	VALUES ('$id','$myask',NOW())";
	$mysqli->query($query);
	$userid = $mysqli->insert_id;


            $query = "Select token from users order by rand() limit $mylimit";
            //echo $query;
            if ($result = $mysqli->query($query)) {
                if ($result->num_rows > 0)
                {
                    while($r = mysqli_fetch_assoc($result)) {
                        if ($r['token'] !="0")
                        {
                        //$rows[] = $r;
                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                        
                        //The device token.
                        $token = $r["token"];
                        
                        //Title of the Notification.
                        $title = "A user just created a new ask!";
                        $body = "Please join us in Believing and ask that they receive what they ask.";

                        $priority = "high";
                        $badge = "1";
                        //Creating the notification array.
                        $notification = array('title' =>$title , 'text' => $body, 'badge'=> $badge, 'sound' => 'default');
                        
                        //This array contains, the token and the notification. The 'to' attribute stores the token.
                        $arrayToSend = array('to' => $token, 'priority' =>$priority, 'notification' => $notification);
                        //Generating JSON encoded string form the above array.
                        $json = json_encode($arrayToSend);
                        
                        //Setup headers:
                        $headers = array();
                        $headers[] = 'Content-Type: application/json';
                        $headers[] = 'Authorization: key= AAAAGvNlObU:APA91bEHayoB9ky_vJB9gyRtOqNQUpUR1d6h5mObk3AhBCmftq7mp_f8Hp1pyknix04dJ84hL38_xWLOVNRu6XhJnNo7FgmsB34wcAsSlCePsOjZ1-MOVZzIL84FsHHqy3xip0SKuY-d'; //server key here
                        
                        //Setup curl, add headers and post parameters.
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                        //curl_setopt($ch, CURLOPT_NOBODY,1);
                        //Send the request
                        $response = curl_exec($ch);
                        
                        //Close request
                        curl_close($ch);
                        //return $response;
                        }
                    }
                }
                //print(json_encode($rows));
                
            }
            
            
$query = "Select * from asks where userid = '$id' and TIMESTAMPDIFF(MINUTE, timedate, NOW()) < 30";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
			}			
		}
		print(json_encode($rows));
	}
}
}
?>
