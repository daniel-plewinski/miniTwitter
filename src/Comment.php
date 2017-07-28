<?php

class Comment {

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

    public function saveToDB(PDO $conn) {
        if ($this->id == -1) {
            /* Saving new user to DB */
            $stmt = $conn->prepare('INSERT INTO Users(username, email, hash_pass) VALUES (:username, :email, :pass)');
            $result = $stmt->execute(['username' => $this->username, 'email' => $this->email, 'pass' => $this->hashPass]);
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
            $stmt = $conn->prepare('UPDATE Users SET username=:username, email=:email, hash_pass=:hash_pass');
            $result = $stmt->execute(['username' => $this->username, 'email' => $this->email, 'hash_pass' => $this->hashPass]);
            if ($result === true) {
                return true;
            }
        }
        return false;
    }

}

?>