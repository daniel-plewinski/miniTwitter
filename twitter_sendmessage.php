<?php 

session_start();
ob_start();

include 'config.php';
include 'src/User.php';
include 'src/Comment.php';
include 'src/Tweet.php';
include 'src/Message.php';

include 'template/header.php';

if(!isset($_SESSION["userID"])){
    header("location: twitter_wall.php");
    die();
}

 if (isset($_GET['id']) && is_numeric(($_GET['id']))) {
        $toId = $_GET['id'];
        
    }
    
    if ($toId == $_SESSION['userID']) {
        header("location: twitter_wall.php");
        $_SESSION['selfError'] = true;
    }
?>

<div class="container">
        
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <form action="" method="post" role="form">
                    <legend>Wysyłanie wiadomości</legend>

                    <div class="form-group">
                        <label for="content">Treść:</label>
                        <textarea class="form-control" rows="5" name="content" id="content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </form>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

<?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {

       if (!empty($_POST['content'])) {
            $content = $_POST['content'];                         

            $message = new Message;
            $message->setFromId($_SESSION['userID']);
            $message->setToId($toId);
            $message->setContent($content);
            $message->sendMessage($conn);

            echo "Wiadomość została przesłana";
        } else {
           echo "Wiadomość nie może być pusta";
       }
    }
?>
            </div>
        </div>
    </div>
</body>
</html>