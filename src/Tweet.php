<?php

class Tweet {
    
    private $id;
    private $userId;
   // private $username;
    private $content;
    private $creationDate;


    public function __construct()
    {
        $this->id = -1;
        $this->userId = "";
        $this->username ="";
        $this->content = "";
        $this->creationDate = date("Y-m-d");
    }
    
    
     public function getId()
    {
        return $this->id;
    }

    public static function getTweetbyID ($conn, $id){
        $stmt = $conn->prepare('SELECT content FROM Tweets WHERE id = :id');
		$stmt->execute([ 'id' => $id ]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
		    return $result["content"];
	    } else {
	    	return null;
	    }
        
    }
    
     public static function getAuthorIdByTweetbyID ($conn, $id){
        $stmt = $conn->prepare('SELECT user_id FROM Tweets WHERE id = :id');
		$stmt->execute([ 'id' => $id ]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
		    return $result["user_id"];
	    } else {
	    	return null;
	    }
        
    }
    
    public static function getTweetDateByTweetbyID ($conn, $id){
        $stmt = $conn->prepare('SELECT creation_date FROM Tweets WHERE id = :id');
		$stmt->execute([ 'id' => $id ]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
		    return $result["creation_date"];
	    } else {
	    	return null;
	    }
    }
    

        public function getUserId()
    {
        return $this->userId;
    }

    
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    
    
    public function setContent($content)
    {
        $this->content = $content;
    }

    
    public function getContent()
    {
        return $this->content;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

     public function saveTweetToDB(PDO $conn)
	{
	    if ($this->id == -1) {
            
            try {
			$stmt = $conn->prepare('INSERT INTO Tweets(user_id, creation_date, content) VALUES (:user_id, :creation_date, :content)');
            $result = $stmt->execute([ 'user_id' => $this->userId, 'creation_date'=> $this->creationDate, 'content' => $this->content]); }
            catch (PDOException $e ){
            return false;
            }
            
			if ($result !== false) {
				$this->id = $conn->lastInsertId();
			    return true;
		    }
		} 
	    return false;
	}
    
}
