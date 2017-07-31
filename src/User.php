<?php

class User
{
    private $id;
    private $username;
    private $hashPass;
    private $email;

    public function __construct() {
    	$this->id = -1;
	    $this->username = "";
	    $this->email = "";
	    $this->hashPass = "";
	}

	public function setPassword($newPass) {
		$newHashedPassword = password_hash($newPass, PASSWORD_BCRYPT);
		$this->hashPass = $newHashedPassword;
	}

	public function getUsername() {
		return $this->username;
	}

	static function getUsernameByID($conn, $userID) {
		$stmt = $conn->prepare('SELECT username FROM Users WHERE id = :userid');
		$stmt->execute([ 'userid' => $userID ]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
		    return $result["username"];
	    } else {
	    	return null;
	    }
	}
    
    
    static function checkUsernameIfUnique($conn, $userID, $newName) {
        $result = $conn->query('SELECT username FROM Users');
        if ($result->rowCount() > 0) {
           $ar = [];
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $ar[] = $row["username"];
            }
            if (in_array($newName, $ar)) {
                return false;
            } else {
                return true;
            }
        }
    }
    
    
    static function checkEmailIfUnique($conn, $userID, $newEmail) {
        $result = $conn->query('SELECT email FROM Users');	
        if ($result->rowCount() > 0) {
               $ar = [];
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $ar[] = $row["email"];
                }
                if (in_array($newEmail, $ar)) {
                    return false;
                } else {
                    return true;
                }
            }

    }
    
    
    
    static function getUserEmailByID($conn, $userID) {
		$stmt = $conn->prepare('SELECT email FROM Users WHERE id = :userid');
		$stmt->execute([ 'userid' => $userID ]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
		    return $result["email"];
	    } else {
	    	return null;
	    }
	}
    

	static function getIdByUserName($conn, $username) {
		$stmt = $conn->prepare('SELECT id FROM Users WHERE username = :username');
		$stmt->execute([ 'username' => $username ]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
		    return $result["id"];
	    } else {
	    	return null;
	    }
	}
    
    
    static function getIdByUserEmail($conn, $email) {
		$stmt = $conn->prepare('SELECT id FROM Users WHERE email = :email');
		$stmt->execute([ 'email' => $email]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
		    return $result["id"];
	    } else {
	    	return null;
	    }
	}

	static function getPasswordHashByEmail($conn, $email) {
		$stmt = $conn->prepare('SELECT hash_pass FROM Users WHERE email = :email');
		$stmt->execute([ 'email' => $email ]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
		    return $result["hash_pass"];
	    } else {
	    	return null;
	    }
	}

	public function setEmail($newEmail) {
		$this->email = $newEmail;
	}


	public function setUsername($newUsername) {
		$this->username = $newUsername;
	}
    
    
    public static function saveNewUsername(PDO $conn, $userName, $userID) {
			$stmt = $conn->prepare('UPDATE Users SET username=:username WHERE id= :userId');
			$result = $stmt->execute([ 'username' => $userName, 'userId'=> $userID]);
			if ($result) {
			    return true;
		    } else { 
	       return false;
            }
    }
    
    
     public static function saveNewUserEmail(PDO $conn, $userEmail, $userID) {
			$stmt = $conn->prepare('UPDATE Users SET email=:userEmail WHERE id= :userId');
			$result = $stmt->execute([ 'userEmail' => $userEmail, 'userId'=> $userID]);
			if ($result) {
			    return true;
		    } else { 
	       return false;
            }
    }
    
    
     public static function saveNewUserPassword(PDO $conn, $userPassword, $userID) {
            $newHashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);
            $stmt = $conn->prepare('UPDATE Users SET hash_pass=:userPass WHERE id= :userId');
			$result = $stmt->execute([ 'userPass' => $newHashedPassword, 'userId'=> $userID]);
			if ($result) {
			    return true;
		    } else { 
	       return false;
            }
    }
    
            
    public function saveToDB(PDO $conn)
	{
	    if ($this->id == -1) {
            
            try {
			/* Saving new user to DB */
			$stmt = $conn->prepare('INSERT INTO Users(username, email, hash_pass) VALUES (:username, :email, :pass)');
            $result = $stmt->execute([ 'username' => $this->username, 'email'=> $this->email, 'pass' => $this->hashPass ]); }
            catch (PDOException $e ){
            return false;
            }
            
			if ($result !== false) {
				$this->id = $conn->lastInsertId();
			    return true;
		    } 
		} else {
			$stmt = $conn->prepare('UPDATE Users SET username=:username, email=:email, hash_pass=:hash_pass');
			$result = $stmt->execute([ 'username' => $this->username, 'email' => $this->email, 'hash_pass' => $this->hashPass ] );
	        if ($result === true) {
	            return true;
	     	}
		} 
	    return false;
	}
}