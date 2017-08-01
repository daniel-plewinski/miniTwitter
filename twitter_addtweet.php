<?php

/**
* File of miniTwitter
*
* @author     	Daniel Plewinski
* @author  		email: dplewinski@gmail.com
* @link     	https://github.com/daniel-plewinski/miniTwitter
*/

session_start();
ob_start();

if(!isset($_SESSION["userID"])){
    header("location: twitter_login.php");
    die();
}

require 'src/Tweet.php';
require 'src/User.php';
require 'config.php';
include 'template/header.php';

?>
    <div class="container">
        
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <form action="" method="post" role="form">
                    <legend>Dodawnie tweeta</legend>

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
                            $tweet = new Tweet();
                            $tweet->setContent($content); 
                            $tweet->setUserId($_SESSION['userID']);

                            $tweet->saveTweetToDB($conn);

                       echo "Tweet został opublikowany";
                       } else {
                           echo "Tweet nie może być pusty";
                       }
                    }
                ?>
            </div>
        </div>
    </div>

</body>
</html>
