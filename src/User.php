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

	static function getIdByEmail($conn, $email) {
		$stmt = $conn->prepare('SELECT id FROM Users WHERE email = :email');
		$stmt->execute([ 'email' => $email ]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
		    return $result["id"];
	    } else {
	    	return null;
	    }
	}

	static function getPasswordHashByID($conn, $userID) {
		$stmt = $conn->prepare('SELECT hash_pass FROM Users WHERE id = :userid');
		$stmt->execute([ 'userid' => $userID ]);
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

	public function validate($conn)
	{
		# if (filter_var($email_a, FILTER_VALIDATE_EMAIL))
		# Czy password ma 8 znakow
		# Czy username ma przynajmniej 3 znaki etc.
		# Czy email sie nie powtarza!!!
		return true;
	}

	public function setUsername($newUsername) {
		$this->username = $newUsername;
	}

	public function saveToDB(PDO $conn)
	{
	    if ($this->id == -1) {
			/* Saving new user to DB */
			$stmt = $conn->prepare('INSERT INTO Users(username, email, hash_pass) VALUES (:username, :email, :pass)');
			$result = $stmt->execute([ 'username' => $this->username, 'email'=> $this->email, 'pass' => $this->hashPass ]);
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

	public function delete(PDO $conn)
	{
	    if ($this->id != -1) {
			$stmt = $conn->prepare('DELETE FROM Users WHERE id=:id'); $result = $stmt->execute(['id' => $this->id]);
			if ($result === true) {
	            $this->id = -1;
	            return true;
	        }
	        return false;
	    }
	    return true;
	}

}


?>