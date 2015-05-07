<?php

class NotificationModel{

	private $database;
	private $connexion;

	public function NotificationModel($database)
    {
        $this->database=$database;
        $this->connexion=$database->connexion;
	}

	public function countNotification()
	{
		try {
            $stmt = $this->connexion->prepare("SELECT * FROM survival_guide_pushes");
            $stmt->execute();
            return $stmt->rowcount();
		}
		catch (Exception $e) {
		    die('Erreur : ' . $e->getMessage());
		}
	}

	public function saveNotification($subject,$message,$code_section)
	{
		try {
			$stmt = $this->connexion->prepare("INSERT INTO survival_guide_pushes(subject,message,code_section) VALUES(:subject, :message, :code_section)");
			$stmt->bindParam(':subject',$subject);
			$stmt->bindParam(':message',$message);
			$stmt->bindParam(':code_section',$code_section);
			$stmt->execute();
		}
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	}

	public function addRegId($regId)
	{
		try {
            $stmt = $this->connexion->prepare("SELECT * FROM survival_guide_regids WHERE regid = :regid");
			$stmt->bindParam(':regid',$regId->regid);
			$stmt->execute();
			$data=$stmt->fetch(PDO::FETCH_OBJ);

			if($data) {
                $stmt = $this->connexion->prepare("UPDATE survival_guide_regids SET code_section =:code_section WHERE regid =:regid");
                $stmt->bindParam(':regid',$regId->regid);
                $stmt->bindParam(':code_section',$regId->code_section);
                $stmt->execute();
			} else {
				$stmt = $this->connexion->prepare("INSERT INTO survival_guide_regids(regid,code_section) VALUES(:regid,:code_section)");
				$stmt->bindParam(':regid',$regId->regid);
				$stmt->bindParam(':code_section',$regId->code_section);
				$stmt->execute();
			}
		}
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	}

	public function getLastNotifications($code_section)
	{
		try {
			$stmt = $this->connexion->prepare("SELECT * FROM survival_guide_pushes WHERE code_section = :code_section order by timestamp desc LIMIT 5");
			$stmt->bindParam(':code_section',$code_section);
			$stmt->execute();

			$notifications = array();

			while($data=$stmt->fetch(PDO::FETCH_OBJ))
		    {
                $newNotif = new Pushes($data->subject,$data->message,$data->code_section,$data->timestamp);
                array_push($notifications,$newNotif);
			}
			return $notifications;
		}
		catch (Exception $e) {
		    die('Erreur : ' . $e->getMessage());
		}
	}

    public function countRegIds()
    {
        try {
            $stmt = $this->connexion->prepare("SELECT * FROM survival_guide_regids");
            $stmt->execute();
            return $stmt->rowcount();
        }
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }


    public function getRegIds($code_section)
	{
		try {
			$stmt = $this->connexion->prepare("SELECT regid FROM survival_guide_regids WHERE code_section = :code_section");
			$stmt->bindParam(':code_section',$code_section);
			$stmt->execute();
		
			$ids = array();
		
			while($data=$stmt->fetch(PDO::FETCH_OBJ))
		    {
                array_push($ids,$data->regid);
			}
			return $ids;
		}
		catch (Exception $e) {
		    die('Erreur : ' . $e->getMessage());
		}
	}

	public function sendMessageThroughGCM($registration_ids, $subject, $pushMessage) {
	
		$message = array("m" => $pushMessage, "sbj" => $subject);
		   		
		//Google cloud messaging GCM-API url
		$url = 'https://android.googleapis.com/gcm/send';
		$fields = array(
		    'registration_ids' => $registration_ids,
		    'data' => $message,
		);

		// Update your Google Cloud Messaging API Key
		define("GOOGLE_API_KEY", "AIzaSyARq1v5hjOd16fSBin0DXmG-EX5CeYQS84"); 		
		$headers = array(
		    'Authorization: key=' . GOOGLE_API_KEY,
		    'Content-Type: application/json'
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);				

		if ($result === FALSE) {
		    die('Curl failed: ' . curl_error($ch));
		}

		curl_close($ch);

		return $result;
	}
    
    
}

?>
