<?php
include '../apicontroller.php';
$myid = $_POST['myid'];
$chatuser = $_POST['chatuser'];
$datetime = $_POST['datetime'];
$message = $_POST['message'];
//$myid = 5;
//$chatuser=8;
//$datetime = "2016-09-10 23:00:00";
//$message = "How are you today?";
$query = "insert into conversations (init_user, acct_user, conversation, curdate)
VALUES ('$myid','$chatuser','$message','$datetime')";
$mysqli->query($query);

$query = "Select id, init_user, conversation, curdate from conversations where init_user = '$myid' and acct_user = '$chatuser'
union
Select id, init_user, conversation, curdate from conversations where init_user = '$chatuser' and acct_user = '$myid'
order by id";
	if ($result = $mysqli->query($query)) {
       	if ($result->num_rows > 0)
		{
			while($r = mysqli_fetch_assoc($result)) {
  				$rows[] = $r;
}			}
        $query = "Select token, device from users where id = '$chatuser'";
        if ($result = $mysqli->query($query)) {
            if ($result->num_rows > 0)
            {
                while($r = mysqli_fetch_assoc($result)) {
                    if ($r['token'] !="0")
                    {
                        $query1 = "Select username from users where id = '$myid'";
                        if ($result1 = $mysqli->query($query1)) {
                            if ($result1->num_rows > 0)
                            {
                                while($r1 = mysqli_fetch_assoc($result1)) {
                                    $username = $r1["username"];
                                }
                            }
                        }
                        //$rows[] = $r;
                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                        
                        //The device token.
                        $token = $r["token"];
                        //$username = $r["username"];
                        $device = $r["device"];
                        //Title of the Notification.
                        $title = "New Chat Message!";
                        $body = $username . " just sent you a new chat message";
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
                            $headers[] = 'Authorization: key= AAAAjt9ZFz8:APA91bGSTHYYJ2QooKTJyghsbBAvS_afYtvgI9IXgncEgHOmiskhxE3RLr6iZvmds9IP_nJXEM8RrvVWBHM57o6omXy_wPxLBANTeVCp0ivBBqLPO-wUlM8SO0_jH6QgaoMYMYDi_cJY'; //server key here
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
        }
        

		print(json_encode($rows));

	}

?>
