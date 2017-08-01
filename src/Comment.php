<?php

/**
* File of miniTwitter
*
* @author     	Daniel Plewinski
* @author  		email: dplewinski@gmail.com
* @link     	https://github.com/daniel-plewinski/miniTwitter
* 
*/

class Comment
{
    private $id;
    private $tweetId;
    private $userId;
    private $commentContent;
    private $commentDate;
    private $commentArray;


    public function __construct()
    {
        $this->id = -1;
        $this->tweetId = "";
        $this->userId = "";
        $this->commenContent = "";
        $this->commentDate = date("Y-m-d");
    }

    public static function getCommentsByTweetId($conn, $tweetId)
    {
        $result = $conn->prepare('SELECT * FROM Comments WHERE tweet_id = :id');
        $result->execute(['id' => $tweetId]);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public static function getAuthorIdByCommentID($conn, $id)
    {
        $stmt = $conn->prepare('SELECT user_id FROM Comments WHERE id = :id');
        $stmt->execute([ 'id' => $id ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result["user_id"];
        } else {
            return null;
        }
    }

    public function getId()
    {
        return $this->id;
    }


    public function getUserId()
    {
        return $this->userId;
    }


    public function setUserId($userId)
    {
        $this->userId = $userId;
    }



    public function getTweetId()
    {
        return $this->tweetId;
    }


    public function setTweetId($tweetId)
    {
        $this->tweetId = $tweetId;
    }


    public function setCommentContent($content)
    {
        $this->commentContent = $content;
    }


    public function getCommentContent()
    {
        return $this->commentContent;
    }

    public function getCommentDate()
    {
        return $this->commentDate;
    }

    public function saveCommentToDB(PDO $conn)
    {
        if ($this->id == -1) {
            try {
                $stmt = $conn->prepare('INSERT INTO Comments(tweet_id, user_id, comment_date, comment_content) VALUES (:tweetId, :userId, :commentDate, :commentContent)');
                $result = $stmt->execute([ 'tweetId'=>$this->tweetId, 'userId' => $this->userId, 'commentDate'=> $this->commentDate, 'commentContent' => $this->commentContent]);
            } catch (PDOException $e) {
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
