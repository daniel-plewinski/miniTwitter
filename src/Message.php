<?php

class Message {
    
    private $fromId;
    private $toId;
    private $messageId;
    private $date;
     private $content;


    public function __construct() {
      $this->messageId = -1;
      $this->fromId = "";
      $this->content = "";
      $this->toId = "";
      $this->date = date("Y-m-d");
    }


    public function setFromId ($fromId) {
        $this->fromId = $fromId;
    }
    
     public function getFromId () {
         return $this->fromId;
    }
    
    public function setToId ($toId) {
        $this->toId = $toId;
    }
    
     public function getToId () {
         return $this->toId;
        
    }
    
     public function setContent ($content) {
        $this->content = $content;
    }
    
     public function getContent () {
         return $this->$content;
        
    }
    
    public static function showInbox ($conn, $toId) {
         
            $stmt = $conn->prepare('SELECT * FROM Messages WHERE to_id = ?');
            $result = $stmt->execute([$toId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            } else {
                return null;
            }
    }
    
    public static function showOutbox ($conn, $fromId) {
         
            $stmt = $conn->prepare('SELECT * FROM Messages WHERE from_id = ?');
            $result = $stmt->execute([$fromId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            } else {
                return null;
            }
    }

    public static function markAsRead ($messageId) {
        
    }
    
    public function sendMessage ($conn) {    
        
	    if ($this->messageId == -1) {
            
            try {
			$stmt = $conn->prepare('INSERT INTO Messages (from_id, to_id, content, message_date) VALUES (:from_id, :to_id, :content, :date)');
            $result = $stmt->execute([ 'from_id' => $this->fromId, 'to_id'=> $this->toId, 'content' => $this->content, 'date' => $this->date ]); }
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

