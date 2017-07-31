<?php
session_start();
ob_start();

if(!isset($_SESSION["userID"])){
    header("location: twitter_wall.php");
    die();
}

require 'config.php';
require 'src/User.php';
require 'src/Comment.php';
require 'src/Tweet.php';

include 'template/header.php';

?>

<div class="container">

<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
    if (isset($_GET['twit']) && is_numeric(($_GET['twit']))) {
        $twitId = $_GET['twit'];
        $_SESSION['twitID'] = $twitId;
        $tweet = Tweet::getTweetbyID($conn, $twitId);      

        $tweetAuthorId = Tweet::getAuthorIdByTweetbyID($conn, $twitId);
        $tweetAuthorName = USER::getUsernameByID($conn, $tweetAuthorId);
        $tweetDate = Tweet::getTweetDateByTweetbyID($conn, $twitId);
        
        $commentsAr = Comment::getCommentsByTweetId($conn, $twitId);
        
        echo "<strong>$tweetAuthorName</strong> pisze w dniu $tweetDate:";
        echo "<h3>$tweet</h3>";
        
        echo "<ul>";
     
        foreach ($commentsAr as $comment) {
            $commentAuthorId = Comment::getAuthorIdByCommentID($conn, $comment['id']);
            $commentAuthorName = USER::getUsernameByID($conn, $commentAuthorId);
            echo "<li>" ;
            echo $comment['comment_content'] . "<br>";
            echo "<i>Napisany przez <strong>" . $commentAuthorName . "</strong> w dniu " . $comment['comment_date'] . "</i>";
            echo "</li>";
       }
            echo "</ul>";     
       
    } else {
      header("location: twitter_wall.php");
    }
} else {
    header("location: twitter_wall.php");
    }
?>
    
       <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

            </div>
            <div>
                <form action="" method="post" role="form">
                    <legend>Dodaj komentarz</legend>
                    <div class="form-group">
                        <label for="content">Treść komentarza:</label>
                        <textarea class="form-control" rows="5" name="content" id="content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </form>
            </div>
    
<?php
   if ($_SERVER['REQUEST_METHOD'] === "POST") {

      if (!empty($_POST['content'])) {
           $commentContent = $_POST['content'];
           $comment = new Comment();
           $comment->setCommentContent($commentContent); 
           $comment->setUserId($_SESSION['userID']);
           $comment->setTweetId($_SESSION['twitID']);
           $comment->saveCommentToDB($conn);
           echo "Tweet został opublikowany";
      } else {
          echo "Tweet nie może być pusty";
      }
   }
?>
    </div>
</body>
</html>
